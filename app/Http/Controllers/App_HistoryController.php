<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use App\Models\JobsSearch;
use Illuminate\Support\Facades\File;
use Elasticsearch\ClientBuilder;

class App_HistoryController extends Controller
{
    public function applicants_home(Request $request)
    {
        $query = $request->get('query');

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
        $jobs = $client->search($params);
        
        // =================================================================
        // =================================================================

        // $jobs = JobsSearch::all();
        return view('applicants.applicants_home', compact('query','jobs'));
    }

    // ============================================================================================
    // ============================================================================================ 

    public function index_history()
    {
        return view('applicants.applicants_history');
    }

    // ============================================================================================
    // ============================================================================================ 

    public function add_history(Request $request)
    {
        // dd($request->file("portfolio"));

        $history = new History;
        $history->name_prefix = $request->name_prefix;
        $history->first_name = $request->first_name;
        $history->last_name = $request->last_name;
        $history->email = $request->email;
        $history->phone_number = $request->phone_number;
        $history->birthday = $request->birthday;
        $history->year_old = $request->year_old;
        if ($request->hasfile("profile")) {
            $file = $request->file("profile");
            $extention = $file->getClientOriginalName();
            $filename = time() . '.' . $extention;
            $file->move(\public_path("uploads/profile/"), $filename);
            $history->profile = $filename;
        }
        $history->university = $request->university;
        $history->faculty = $request->faculty;
        $history->branch = $request->branch;
        $history->gpa = $request->gpa;
        $history->educational = $request->educational;
        $history->experience = $request->experience;
        $history->dominant_language = $request->dominant_language;
        $history->language_learned = $request->language_learned;
        $history->charisma = $request->charisma;
        if ($request->hasfile("portfolio")) {
            $file = $request->file("portfolio");
            $extention = $file->getClientOriginalName();
            $filename = time() . '.' . $extention;
            $file->move(\public_path("uploads/portfolio/"), $filename);
            $history->portfolio = $filename;
        }
        $history->name_village = $request->name_village;
        $history->home_number = $request->home_number;
        $history->alley = $request->alley;
        $history->road = $request->road;
        $history->district = $request->district;
        $history->canton = $request->canton;
        $history->province = $request->province;
        $history->postal_code = $request->postal_code;
        $history->my_name_village = $request->my_name_village;
        $history->my_home_number = $request->my_home_number;
        $history->my_alley = $request->my_alley;
        $history->my_road = $request->my_road;
        $history->my_district = $request->my_district;
        $history->my_canton = $request->my_canton;
        $history->my_province = $request->my_province;
        $history->my_postal_code = $request->my_postal_code;

        $history->save();


        // image portfolio
        // if ($request->hasFile("portfolio")) {
        //     $file = $request->file("portfolio");
        //     foreach ($file as $file) {
        //         $extention = $file->getClientOriginalName();
        //         $portfolioname = time() . '.' . $extention;
        //         // $request['history_id'] = $history->history_id;
        //         // $request['portfolio'] = $portfolioname;
        //         $file->move(\public_path("/uploads/portfolio"), $portfolioname);
        //         // dd($request);
        //         // $h = $request->get('history_id');
        //         // $p = $request->get('portfolio');
        //         Portfolio::create(['history_id' => $history->history_id, 'portfolio' => $portfolioname]);
        //     }
        // }

        return redirect()->route('applicants_show_history')->with('success', 'เพิ่มข้อมูลฝากประวัติเรียบร้อย');
        // return redirect()->back()->with('success', 'History created successfully.');
    }

    // ============================================================================================
    // ============================================================================================ 

    public function show_history()
    {
        $history = History::all();
        return view('applicants.applicants_show_history', compact('history'));
    }

    // ============================================================================================
    // ============================================================================================ 

    public function edit_history($history_id)
    {
        $history_edit = History::find($history_id);
        return view('applicants.applicants_edit_history', compact('history_edit'));
    }

    // ============================================================================================
    // ============================================================================================ 

    public function update_history($history_id, Request $request)
    {
        $history_edit = History::find($history_id);
        $history_edit->name_prefix = $request->name_prefix;
        $history_edit->first_name = $request->first_name;
        $history_edit->last_name = $request->last_name;
        $history_edit->email = $request->email;
        $history_edit->phone_number = $request->phone_number;
        $history_edit->birthday = $request->birthday;
        $history_edit->year_old = $request->year_old;
        if ($request->hasfile('profile')) {
            $destination = 'uploads/profile/' . $history_edit->profile;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('profile');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move(\public_path("uploads/profile/"), $filename);
            $history_edit->profile = $filename;
        }
        $history_edit->university = $request->university;
        $history_edit->faculty = $request->faculty;
        $history_edit->branch = $request->branch;
        $history_edit->gpa = $request->gpa;
        $history_edit->educational = $request->educational;
        $history_edit->experience = $request->experience;
        $history_edit->dominant_language = $request->dominant_language;
        $history_edit->language_learned = $request->language_learned;
        $history_edit->charisma = $request->charisma;
        if ($request->hasfile('portfolio')) {
            $destination = 'uploads/portfolio/' . $history_edit->portfolio;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('portfolio');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move(\public_path("uploads/portfolio/"), $filename);
            $history_edit->portfolio = $filename;
        }
        $history_edit->name_village = $request->name_village;
        $history_edit->home_number = $request->home_number;
        $history_edit->alley = $request->alley;
        $history_edit->road = $request->road;
        $history_edit->district = $request->district;
        $history_edit->canton = $request->canton;
        $history_edit->province = $request->province;
        $history_edit->postal_code = $request->postal_code;
        $history_edit->my_name_village = $request->my_name_village;
        $history_edit->my_home_number = $request->my_home_number;
        $history_edit->my_alley = $request->my_alley;
        $history_edit->my_road = $request->my_road;
        $history_edit->my_district = $request->my_district;
        $history_edit->my_canton = $request->my_canton;
        $history_edit->my_province = $request->my_province;
        $history_edit->my_postal_code = $request->my_postal_code;

        $history_edit->update();


        // return view('applicants.applicants_edit_history', compact('history_edit'));
        return redirect()->route('applicants_show_history')->with('success', 'แก้ไขข้อมูลฝากประวัติเรียบร้อย');
    }

    // ============================================================================================
    // ============================================================================================ 

    public function delete_history($history_id)
    {
        $history = History::find($history_id);

        $destination = 'uploads/profile/' . $history->profile;
        if (File::exists($destination)) {
            File::delete($destination);
        }


        // $portfolios = Portfolio::where("history_id", $history->history_id)->get();
        // foreach ($portfolios as $key => $portfolio ) {

        //     if (File::exists("uploads/portfolio/" . $portfolio->portfolio)) {
        //         File::delete("uploads/portfolio/" . $portfolio->portfolio);
        //     }
        //     // dd(File::exists("uploads/portfolio/" . $portfolio->portfolio));
        //     $portfolio->delete();
        // }

        $history->delete();

        return redirect()->route('applicants_history')->with('success', 'ลบข้อมูลฝากประวัติเรียบร้อย');
    }

    // ============================================================================================
    // ============================================================================================ 

    public function view_portfolio($history_id)
    {
        $view_portfolio = History::find($history_id);
        return view('applicants.applicants_view_portfolio', compact('view_portfolio'));
    }

    // ============================================================================================
    // ============================================================================================ 

    public function see_detail($jobs_id)
    {
        $jobs = JobsSearch::find($jobs_id);
        return view('applicants.applicants_see_detail', compact('jobs'));
    }
}
