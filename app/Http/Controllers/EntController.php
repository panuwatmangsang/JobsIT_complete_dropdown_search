<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrepreneu;
use App\Models\JobsSearch;
use App\Models\History;
use App\Models\Ent_Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Elasticsearch\ClientBuilder;

class EntController extends Controller
{
    public function ent_login()
    {
        return view('auth.ent_login');
    }

    // =====================================================================================================================================
    // =====================================================================================================================================

    public function ent_register()
    {
        return view('auth.ent_register');
    }

    // =====================================================================================================================================
    // =====================================================================================================================================

    public function ent_save(Request $request)
    {
        // register
        // validate requests
        $request->validate([
            'ent_name' => 'required',
            'ent_nature_work' => 'required',
            'ent_name_contact' => 'required',
            'ent_phone' => 'required',
            'ent_email' => 'required|email|unique:entrepreneus',
            'ent_password' => 'required|min:5|max:12',
            'ent_location' => 'required',
        ]);

        // insert data into database
        $ent = new Entrepreneu;
        $ent->ent_name = $request->ent_name;
        $ent->ent_nature_work = $request->ent_nature_work;
        $ent->ent_name_contact = $request->ent_name_contact;
        $ent->ent_phone = $request->ent_phone;
        $ent->ent_email = $request->ent_email;
        $ent->ent_password = Hash::make($request->ent_password);
        $ent->ent_location = $request->ent_location;
        $save = $ent->save();

        if ($save) {
            return back()->with('success', 'เพิ่มบัญชีใหม่เรียบร้อยแล้ว');
        } else {
            return back()->with('fail', 'เกิดข้อผิดพลาด ลองอีกครั้ง');
        }
    }

    // =====================================================================================================================================
    // =====================================================================================================================================

    public function ent_check(Request $request)
    {
        // return $request->input();

        // login
        //validate request
        $request->validate([
            'ent_email' => 'required|email',
            'ent_password' => 'required|min:5|max:12'
        ]);

        $entInfo = Entrepreneu::where('ent_email', '=', $request->ent_email)->first();

        if (!$entInfo) {
            return back()->with('fail', 'ไม่รู้จักบัญชีนี้');
        } else {
            // check password
            if (Hash::check($request->ent_password, $entInfo->ent_password)) {
                $request->session()->put('LoggedEnt', $entInfo->ent_name);
                // $request->session()->put('usernameEnt', $entInfo->ent_name);
                // return redirect('ent/layout');
                return redirect('ent/ent_index');
            } else {
                return back()->with('fail', 'รหัสผ่านผิด');
            }
        }
    }

    // =====================================================================================================================================
    // =====================================================================================================================================

    // logout
    public function ent_logout()
    {
        if (session()->has('LoggedEnt')) {
            session()->pull('LoggedEnt');
            return redirect('/auth/ent_login');
        }
    }

    // =====================================================================================================================================
    // =====================================================================================================================================

    // display index page
    public function ent_index(Request $request)
    {
        // search
        $query = $request->get('query');

        $hosts = ["http://127.0.0.1:9200"];

        $client = ClientBuilder::create()
            ->setHosts($hosts)
            ->build();

        $params = [
            'index' => 'histories_1630304117',
            'body' => [
                'query' => [
                    'wildcard' => [
                        'first_name' => "*"
                    ]
                ]
            ]
        ];
        $applicants = $client->search($params);

        // ########################################################################

        // display from database
        // $applicants = History::all();

        $data = ['LoggedEntInfo' => Entrepreneu::where('ent_id', '=', session('LoggedEnt'))->first()];
        $dominant_language = History::select('history_id', 'dominant_language')->get();

        return view('ent.ent_index', $data, compact('applicants', 'dominant_language', 'query'));
    }

    public function ent_layout()
    {
        $data = ['LoggedEntInfo' => Entrepreneu::where('ent_id', '=', session('LoggedEnt'))->first()];
        return view('ent.layout', $data);
    }

    // =====================================================================================================================================
    // =====================================================================================================================================

    // display my jobs page
    public function ent_home()
    {
        $data = ['LoggedEntInfo' => Entrepreneu::where('ent_id', '=', session('LoggedEnt'))->first()];
        return view('ent.ent_home', $data);
    }

    // =====================================================================================================================================
    // =====================================================================================================================================

    // list post page
    public function list_jobs()
    {
        $jobs = JobsSearch::all();
        $ent_profile = Ent_Profile::all();
        return view('ent.ent_list_post', compact('jobs', 'ent_profile'));
    }

    // ============================================================================================
    // ============================================================================================

    // post jobs page
    public function ent_post()
    {
        return view('ent.ent_post');
    }

    // ============================================================================================
    // ============================================================================================

    // add data into database and kibana
    public function add_jobs(Request $request)
    {

        // insert data into database and kibana

        // $jobs = new JobsSearch();
        // $jobs->jobs_name_company = "mangsang company";
        // $jobs->jobs_name = "mobile application";
        // $jobs->jobs_quantity = "5";
        // $jobs->jobs_salary = "22000";
        // $jobs->jobs_detail = "more and more";
        // $jobs->jobs_contact = "tel 0912345678";
        // $jobs->jobs_address = "lamphun";

        // $jobs->save();
        // dd('เพิ่มข้อมูลเรียบร้อย');

        // dd($request->hasfile("logo"));

        $jobs = new JobsSearch;
        $jobs->jobs_name_company = $request->jobs_name_company;
        if ($request->hasfile("logo")) {
            $file = $request->file("logo");
            $extention = $file->getClientOriginalName();
            $filename = time() . '.' . $extention;
            $file->move(\public_path("uploads/logo/"), $filename);
            $jobs->logo = $filename;
        }
        $jobs->jobs_name = $request->jobs_name;
        $jobs->jobs_quantity = $request->jobs_quantity;
        $jobs->jobs_salary = $request->jobs_salary;
        $jobs->jobs_type = $request->jobs_type;
        $jobs->location_work = $request->location_work;
        $jobs->start_post = $request->start_post;
        $jobs->stop_post = $request->stop_post;
        $jobs->jobs_detail = $request->jobs_detail;
        $jobs->jobs_contact = $request->jobs_contact;
        $jobs->jobs_address = $request->jobs_address;
        $jobs->lat = $request->lat;
        $jobs->lng = $request->lng;
        $jobs->save();

        return redirect()->route('ent_list_post')->with('success', 'สร้างประกาศรับสมัครเรียบร้อย.');
        // return redirect()->back();

        // ============================================================================================
        // ============================================================================================ 

        // update data fron database and kibana
        // $jobs = JobsSearch::find(1);
        // $jobs->jobs_name_company = "Mangsang";

        // $jobs->save();
        // dd('อัพเดทข้อมูลเรียบร้อย');

        // ============================================================================================
        // ============================================================================================ 

        // delete from database 
        // $jobs = JobsSearch::find(1);

        // $jobs->delete();
        // dd('อัพเดทข้อมูลเรียบร้อย');
    }

    // ============================================================================================
    // ============================================================================================ 


    public function ent_show_post($jobs)
    {
        $jobs_post = JobsSearch::find($jobs);
        return view('ent.ent_show', compact('jobs_post'));
    }

    // ============================================================================================
    // ============================================================================================ 

    public function ent_edit_post($jobs_id)
    {
        $jobs_edit = JobsSearch::find($jobs_id);
        return view('ent.ent_edit_post', compact('jobs_edit'));
    }

    // ============================================================================================
    // ============================================================================================ 

    public function ent_update_post($jobs, Request $request)
    {
        $jobs_edit = JobsSearch::find($jobs);

        // $request->validate([
        //     'jobs_name_company' => 'required',
        //     'jobs_name' => 'required',
        //     'jobs_quantity' => 'required',
        //     'jobs_salary' => 'required',
        //     'jobs_detail' => 'required',
        //     'jobs_contact' => 'required',
        //     'jobs_address' => 'required',
        // ]);

        $jobs_edit->jobs_name_company = $request->jobs_name_company;
        if ($request->hasfile("logo")) {
            $destination = 'uploads/logo/' . $jobs_edit->logo;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("logo");
            $extention = $file->getClientOriginalName();
            $filename = time() . '.' . $extention;
            $file->move(\public_path("uploads/logo/"), $filename);
            $jobs_edit->logo = $filename;
        }
        $jobs_edit->jobs_name = $request->jobs_name;
        $jobs_edit->jobs_quantity = $request->jobs_quantity;
        $jobs_edit->jobs_salary = $request->jobs_salary;
        $jobs_edit->jobs_type = $request->jobs_type;
        $jobs_edit->location_work = $request->location_work;
        $jobs_edit->start_post = $request->start_post;
        $jobs_edit->stop_post = $request->stop_post;
        $jobs_edit->jobs_detail = $request->jobs_detail;
        $jobs_edit->jobs_contact = $request->jobs_contact;
        $jobs_edit->jobs_address = $request->jobs_address;
        $jobs_edit->lat = $request->lat;
        $jobs_edit->lng = $request->lng;

        $jobs_edit->update();

        return redirect()->route('ent_list_post')->with('success', 'แก้ไขใบประกาศรับสมัครเรียบร้อย.');
    }

    // ============================================================================================
    // ============================================================================================ 

    public function ent_delete_post($jobs)
    {
        $jobs = JobsSearch::find($jobs);
        $destination = 'uploads/logo/' . $jobs->profile;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $jobs->delete();
        return redirect()->route('ent_list_post')->with('success', 'ลบใบประกาศรับสมัครงานเรียบร้อย');
    }

    // ============================================================================================
    // ============================================================================================ 

    public function ent_check_app()
    {
        return view('ent.ent_check_app');
    }

    // ============================================================================================
    // ============================================================================================ 

    public function ent_see_detail($history_id)
    {
        $history = History::find($history_id);
        return view('ent.ent_see_detail', compact('history'));
    }

    // ============================================================================================
    // ============================================================================================ 

    public function ent_view_portfolio($profile_id)
    {
        $ent_view_portfolio = History::find($profile_id);
        return view('ent.ent_view_portfolio', compact('ent_view_portfolio'));
    }
}
