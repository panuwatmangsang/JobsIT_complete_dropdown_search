<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicantsController;
use App\Http\Controllers\EntController;
use App\Http\Controllers\Ent_PostController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\Ent_CheckController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\profile_Ent;
use App\Http\Controllers\App_HistoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// ent login register logout
Route::post('/auth/ent_save', [EntController::class, 'ent_save'])->name('auth.ent_save');
Route::post('/auth/ent_check', [EntController::class, 'ent_check'])->name('auth.ent_check');
Route::get('/auth/ent_logout', [EntController::class, 'ent_logout'])->name('auth.ent_logout');



// Ent Check login
Route::group(['middleware' => ['EntCheck']], function () {
    Route::get('/auth/ent_login', [EntController::class, 'ent_login'])->name('auth.ent_login');
    Route::get('/auth/ent_register', [EntController::class, 'ent_register'])->name('auth.ent_register');

    // display index page
    Route::get('/ent/ent_index', [EntController::class, 'ent_index'])->name('ent_index');
    Route::get('/ent/layout', [EntController::class, 'ent_layout'])->name('layout');


    // display home page
    // Route::get('/ent/ent_home', [Ent_HomeController::class, 'ent_home'])->name('ent_home');

    // display check page
    Route::get('/ent/ent_check_app', [EntController::class, 'ent_check_app'])->name('ent_check_app');

    // display crud post page
    Route::get('/ent/ent_list_post', [EntController::class, 'list_jobs'])->name('ent_list_post');
    Route::get('/ent/ent_post', [EntController::class, 'ent_post'])->name('ent_post');
    Route::post('/ent_post', [EntController::class, 'add_jobs'])->name('add_jobs');
    Route::get('/ent/ent_edit_post/{jobs_id}', [EntController::class, 'ent_edit_post'])->name('ent.ent_edit_post');
    Route::patch('/ent/ent_edit_post/{jobs_id}', [EntController::class, 'ent_update_post'])->name('ent.ent_update_post');
    Route::get('/ent/ent_show/{jobs_id}', [EntController::class, 'ent_show_post'])->name('ent.ent_show_post');
    Route::delete('ent/{jobs_id}', [EntController::class, 'ent_delete_post'])->name('ent.ent_delete_post');

    // display crud profile
    Route::get('/ent/ent_profile', [profile_Ent::class, 'ent_profile'])->name('ent_profile');
    Route::post('/ent_profile', [profile_Ent::class, 'add_profile_company'])->name('add_profile_company');
    Route::get('/ent/ent_show_profile/{profile_company_id}', [profile_Ent::class, 'ent_show_profile'])->name('ent_show_profile');
    Route::get('/ent/ent_edit_profile/{profile_company_id}', [profile_Ent::class, 'ent_edit_profile'])->name('ent_edit_profile');
    Route::patch('/ent/ent_update_profile/{profile_company_id}', [profile_Ent::class, 'ent_update_profile'])->name('ent_update_profile');
    Route::delete('/ent/ent_show_profile/{profile_company_id}', [profile_Ent::class, 'ent_delete_profile'])->name('ent_delete_profile');


    // display detail page
    Route::get('/ent/ent_see_detail/{history_id}', [EntController::class, 'ent_see_detail'])->name('ent_see_detail');
    Route::get('/ent/ent_view_portfolio/{profile_id}', [EntController::class, 'ent_view_portfolio'])->name('ent_view_portfolio');

    // display search/applicants post page
    // Route::get('/applicants/applicants_search', [EntController::class, 'applicants_search'])->name('applicants_search');

    // search text
    Route::get('/app_search', [JobsController::class, 'app_search'])->name('ent_search');
});


#############################################################################################################
#############################################################################################################
#############################################################################################################
#############################################################################################################



// appkicants login register logout
Route::post('/auth/applicants_save', [ApplicantsController::class, 'applicants_save'])->name('auth.applicants_save');
Route::post('/auth/applicants_check', [ApplicantsController::class, 'applicants_check'])->name('auth.applicants_check');
Route::get('/auth/applicants_logout', [ApplicantsController::class, 'applicants_logout'])->name('auth.applicants_logout');

// Applicants Check login
Route::group(['middleware' => ['ApplicantsCheck']], function () {
    Route::get('/auth/applicants_login', [ApplicantsController::class, 'applicants_login'])->name('auth.applicants_login');
    Route::get('/auth/applicants_register', [ApplicantsController::class, 'applicants_register'])->name('auth.applicants_register');

    // display history crud image page
    Route::get('/applicants/applicants_history', [App_HistoryController::class, 'index_history'])->name('applicants_history');
    Route::post('/applicants_history', [App_HistoryController::class, 'add_history'])->name('add_history');
    Route::get('/applicants/applicants_show_history', [App_HistoryController::class, 'show_history'])->name('applicants_show_history');
    Route::get('/applicants/applicants_edit_history/{history_id}', [App_HistoryController::class, 'edit_history'])->name('applicants_edit_history');
    Route::delete('/applicants/applicants_show_history/{history_id}', [App_HistoryController::class, 'delete_history'])->name('applicants_delete_history');
    Route::patch('/applicants/applicants_update_history/{history_id}', [App_HistoryController::class, 'update_history'])->name('applicants_update_history');
    Route::get('/applicants/applicants_view_portfolio/{history_id}', [App_HistoryController::class, 'view_portfolio'])->name('view_portfolio');


    // display my jobs page
    Route::get('/applicants/applicants_myjobs', [ApplicantsController::class, 'applicants_myjobs'])->name('myjobs');
});

// display home page
Route::get('/applicants/applicants_home', [App_HistoryController::class, 'applicants_home'])->name('applicants_home');

// display search/jobs post page
Route::get('/applicants/applicants_search', [ApplicantsController::class, 'applicants_search'])->name('applicants_search');

// search text
Route::get('/search', [ApplicantsController::class, 'test_search'])->name('search');
// Route::get('/applicants/jobs_option_search', [ApplicantsController::class, 'jobs_option_search'])->name('jobs_option_search');

// see detail
Route::get('/applicants/applicants_see_detail/{jobs_id}', [App_HistoryController::class, 'see_detail'])->name('see_detail');

// Route::get('/add_jobs', [JobsController::class, 'add_jobs']);



// search text
// Route::get('/search', [JobsController::class, 'test_search'])->name('search');
// Route::get('/applicants/jobs_option_search', [JobsController::class, 'jobs_option_search'])->name('jobs_option_search');

// display map
Route::get('ent/map', [MapController::class, 'map'])->name('map');
Route::get('ent/mapData', function () {
    $uname = "root";
    $pass = "";
    $servername = "localhost";
    $dbname = "jobs_it_2";
    $db = new mysqli($servername, $uname, $pass, $dbname);
    $query =  $db->query("SELECT * FROM jobs_searches");
    $resultArray = array();


    while ($row = $query->fetch_assoc()) {
        $jobs_id = $row['jobs_id'];
        $jobs_name_company = $row['jobs_name_company'];
        $logo = $row['logo'];
        $jobs_name = $row['jobs_name'];
        $jobs_quantity = $row['jobs_quantity'];
        $jobs_salary = $row['jobs_salary'];
        $jobs_type = $row['jobs_type'];
        $location_work = $row['location_work'];
        $jobs_detail = $row['jobs_detail'];
        $jobs_contact = $row['jobs_contact'];
        $jobs_address = $row['jobs_address'];
        $lat = $row['lat'];
        $lng = $row['lng'];
        array_push($resultArray, [$jobs_id, $jobs_name_company, $logo, $jobs_name, $jobs_quantity, $jobs_salary, $jobs_type, $location_work, $jobs_detail, $jobs_contact, $jobs_address, $lat, $lng]);
    }

    return ($resultArray);
});
