<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ent_Profile;
use Illuminate\Support\Facades\File;

class profile_Ent extends Controller
{
    public function ent_profile()
    {
        return view('/ent/ent_profile');
    }
    // ============================================================================================
    // ============================================================================================

    // add data into database and kibana
    public function add_profile_company(Request $request)
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

        $ent_profile = new Ent_Profile;
        $ent_profile->profile_name_company = $request->profile_name_company;
        if ($request->hasfile("profile_logo")) {
            $file = $request->file("profile_logo");
            $extention = $file->getClientOriginalName();
            $filename = time() . '.' . $extention;
            $file->move(\public_path("uploads/profile_logo/"), $filename);
            $ent_profile->profile_logo = $filename;
        }
        $ent_profile->profile_company_contact = $request->profile_company_contact;
        $ent_profile->profile_company_phone = $request->profile_company_phone;
        $ent_profile->profile_email = $request->profile_email;
        $ent_profile->profile_company_address = $request->profile_company_address;
        $ent_profile->profile_lat = $request->profile_lat;
        $ent_profile->profile_lng = $request->profile_lng;
        $ent_profile->save();

        return redirect()->route('ent_list_post')->with('success_company_profile', 'สร้างข้อมูลบริษัทเรียบร้อย.');
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


    public function ent_show_profile($profile)
    {
        $profiles = Ent_Profile::find($profile);
        return view('ent.ent_show_profile', compact('profiles'));
    }

    // ============================================================================================
    // ============================================================================================ 

    public function ent_edit_profile($profile_company_id)
    {
        $profile_edit = Ent_Profile::find($profile_company_id);
        return view('ent.ent_edit_profile', compact('profile_edit'));
    }

    // ============================================================================================
    // ============================================================================================ 

    public function ent_update_profile($profile_company_id, Request $request)
    {
        $profile_edit = Ent_Profile::find($profile_company_id);

        // $request->validate([
        //     'jobs_name_company' => 'required',
        //     'jobs_name' => 'required',
        //     'jobs_quantity' => 'required',
        //     'jobs_salary' => 'required',
        //     'jobs_detail' => 'required',
        //     'jobs_contact' => 'required',
        //     'jobs_address' => 'required',
        // ]);

        $profile_edit->profile_name_company = $request->profile_name_company;
        if ($request->hasfile("profile_logo")) {
            $destination = 'uploads/profile_logo/' . $profile_edit->logo;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("profile_logo");
            $extention = $file->getClientOriginalName();
            $filename = time() . '.' . $extention;
            $file->move(\public_path("uploads/profile_logo/"), $filename);
            $profile_edit->logo = $filename;
        }
        $profile_edit->profile_company_contact = $request->profile_company_contact;
        $profile_edit->profile_company_phone = $request->profile_company_phone;
        $profile_edit->profile_email = $request->profile_email;
        $profile_edit->profile_company_address = $request->profile_company_address;
        $profile_edit->profile_lat = $request->profile_lat;
        $profile_edit->profile_lng = $request->profile_lng;

        $profile_edit->update();

        return redirect()->route('ent_list_post')->with('success_company_profile', 'แก้ไขข้อมูลบริษัทเรียบร้อย.');
    }

    // ============================================================================================
    // ============================================================================================ 

    public function ent_delete_profile($profile_company_id)
    {
        $profiles = Ent_Profile::find($profile_company_id);
        $destination = 'uploads/profile_logo/' . $profiles->profile;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $profiles->delete();
        return redirect()->route('ent_list_post')->with('success_company_profile', 'ลบข้อมูลบริษัทเรียบร้อย');
    }

}
