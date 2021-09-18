<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicants;
use App\Models\JobsSearch;
use Illuminate\Support\Facades\Hash;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\Arr;

class ApplicantsController extends Controller
{
    public function applicants_login()
    {
        return view('auth.applicants_login');
    }

    // =====================================================================================================================================
    // =====================================================================================================================================

    public function applicants_register()
    {
        return view('auth.applicants_register');
    }

    // =====================================================================================================================================
    // =====================================================================================================================================

    public function applicants_save(Request $request)
    {
        // register
        // validate requests
        $request->validate([
            'app_name' => 'required',
            'app_email' => 'required|email|unique:applicants',
            'app_password' => 'required|min:5|max:12',
        ]);

        // insert data into database
        $app = new Applicants;
        $app->app_name = $request->app_name;
        $app->app_email = $request->app_email;
        $app->app_password = Hash::make($request->app_password);
        $save = $app->save();

        if ($save) {
            return back()->with('success', 'เพิ่มบัญชีใหม่เรียบร้อยแล้ว');
        } else {
            return back()->with('fail', 'เกิดข้อผิดพลาด ลองอีกครั้ง');
        }
    }

    // =====================================================================================================================================
    // =====================================================================================================================================

    public function applicants_check(Request $request)
    {
        // return $request->input();

        // login
        //validate request
        $request->validate([
            'app_email' => 'required|email',
            'app_password' => 'required|min:5|max:12'
        ]);

        $appInfo = Applicants::where('app_email', '=', $request->app_email)->first();

        if (!$appInfo) {
            return back()->with('fail', 'ไม่รู้จักบัญชีนี้');
        } else {
            // check password
            if (Hash::check($request->app_password, $appInfo->app_password)) {
                $request->session()->put('LoggedApp', $appInfo->app_name);
                return redirect('applicants/applicants_home');
            } else {
                return back()->with('fail', 'รหัสผ่านผิด');
            }
        }
    }

    // =====================================================================================================================================
    // =====================================================================================================================================

    // logout
    public function applicants_logout()
    {
        if (session()->has('LoggedApp')) {
            session()->pull('LoggedApp');
            return redirect('/applicants/applicants_home');
        }
    }

    // =====================================================================================================================================
    // =====================================================================================================================================

    // display index page
    public function applicants_index()
    {
        $data = ['LoggedAppInfo' => Applicants::where('app_id', '=', session('LoggedApp'))->first()];
        return view('applicants.applicants_index', $data);
    }

    // =====================================================================================================================================
    // =====================================================================================================================================

    // display my jobs page
    public function applicants_myjobs()
    {
        $data = ['LoggedAppInfo' => Applicants::where('app_id', '=', session('LoggedApp'))->first()];
        return view('applicants.applicants_myjobs', $data);
    }


    // =====================================================================================================================================
    // =====================================================================================================================================

    // search jobs post
    public function test_search(Request $request)
    {
        $hosts = ["http://127.0.0.1:9200"];

        $client = ClientBuilder::create()
            ->setHosts($hosts)
            ->build();

        // ============ get advance query index =============
        if ($request->get('query')) {
            $query = $request->get('query');
            $params = [
                'index' => 'jobs_searches',
                'body' => [
                    // fuzzy
                    'query' => [
                        'multi_match' => [
                            'fields' => [
                                'jobs_name_company',
                                'jobs_name',
                                'jobs_type',
                                'jobs_detail',
                                'jobs_address',
                            ],
                            'query' => "*" . $query . "*",
                            'fuzziness' => 'AUTO'
                        ]
                    ]

                ]
            ];
            $ent_post0 = $client->search($params);
        } else {
            $query = "";
            $params = [
                'index' => 'jobs_searches_1631520417',
                'body' => [
                    'query' => [
                        'wildcard' => [
                            'jobs_name_company' => "*"
                        ]
                    ]
                ]
            ];

            $ent_post0 = $client->search($params);
        }

        $options = array();
        $options = [
            'jobs_name' => [],
            'jobs_type' => [],
            'jobs_name_company' => [],
            'start_post' => []
        ];

        foreach ($ent_post0["hits"]["hits"] as $v) {
            foreach ($options as $key => $b) {
                if (!in_array($v['_source'][$key], $options[$key])) {
                    array_push($options[$key], $v['_source'][$key]);
                }
            }
        }

        $ent_post = array_filter($ent_post0["hits"]["hits"], function ($v)  use ($request) {
            foreach ($request->all() as $query_all => $val) {
                if ($query_all != "query" && trim($v["_source"][$query_all]) != trim($val)) {
                    return false;
                }
            }
            return true;
        });

        // dd($options);

        return view('applicants.applicants_search', compact('ent_post', 'options', 'query'));
    }

    // =====================================================================================================================================
    // =====================================================================================================================================

    // display search/jobs post page
    public function applicants_search(Request $request)
    {
        $query = $request->get('query');
        // dd($request);

        $hosts = ["http://127.0.0.1:9200"];

        $client = ClientBuilder::create()
            ->setHosts($hosts)
            ->build();

        $params = [
            'index' => 'jobs_searches_1631520417',
            'body' => [
                'query' => [
                    'wildcard' => [
                        'jobs_name_company' => "*"
                    ]
                ]
            ]
        ];

        $ent_post0 = $client->search($params);

        $options = array();
        $options = [
            'jobs_name' => [],
            'jobs_type' => [],
            'jobs_name_company' => [],
            'start_post' => []
        ];


        $ent_post = array_filter($ent_post0["hits"]["hits"], function ($v)  use ($request, $options) {
            foreach ($request->all() as $x => $val) {

                foreach ($options as $key => $b) {
                    if (!in_array($v['_source'][$key], $options[$key])) {
                        echo $v['_source'][$key] . '<br/>';
                        array_push($options[$key], $v['_source'][$key]);
                    }
                }

                if ($x != "query" && trim($v["_source"][$x]) != trim($val)) {
                    return false;
                }
            }
            return true;
        });

        return view('applicants.applicants_search', compact('ent_post', 'options', 'query'));
    }

    // ============================================================================================
    // ============================================================================================ 

    // public function jobs_option_search(Request $request)
    // {
    //     $hosts = ["http://127.0.0.1:9200"];

    //     $client = ClientBuilder::create()
    //         ->setHosts($hosts)
    //         ->build();

    //     if ($query_option = $request->get('query_option')) {

    //         $params = [
    //             'index' => 'jobs_searches',
    //             'body' => [
    //                 'query' => [
    //                     'query_string' => [
    //                         'query' => $query_option,
    //                         'fields' => [
    //                             'jobs_name',
    //                             'jobs_type',
    //                             'jobs_name_company',
    //                             'start_post',
    //                         ]
    //                     ]
    //                 ]
    //             ]
    //         ];
    //         $results_query_option = $client->search($params);

    //         // $ent_post = array_filter($results_query_option["hits"]["hits"], function($v){
    //         //     foreach($request as $x => $val)
    //         //     {
    //         //         if  ($x != 'query_option' && $v["_source"][$x] != $val);
    //         //             return false;
    //         //     }
    //         //     return true;
    //         // });

    //         // dd($en)


    //         return view('applicants.applicants_search', ['query' => $query_option, 'results_query_option' => $results_query_option]);
    //     } else {
    //         return view('applicants.applicants_search', ['query' => null]);
    //     }
    // }
}
