@extends('ent.layout')
@section('title','แสดงใบประกาศรับสมัครพนักงาน')

@section('content')

<body>
    <div class="container col-10" style="margin-top:100px">
        <div class="row justify-content-center">
            <div class="card" style="width: 80%;height:100%">
                <div class="card-header" style="background-color:#6369ED; color:White;height:40px;">
                    <p class="card-text" style="font-size: 18px;top:2px;text-align:center">แสดงรายละเอียดการฝากประวัติ</p>
                </div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body">

                    @if(isset($history))
                    <form action="#" method="post">

                        <!-- ======================== ประวัติส่วนตัว ======================= -->
                        <div class="head position-relative mt-1">
                            <p class="card-text" style="font-size:18px;">ประวัติส่วนตัว</p>
                        </div>
                        <div class="form-row">

                            <div class="form-row col align-self-center" align="center">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">รูปประจำตัว</label> <br>
                                        <img src="{{ asset('uploads/profile/'.$history->profile) }}" width="100px" height="130px" alt="profile">
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="col-md-12 mt-2">
                                <div class="form-inline form-group ">
                                    <label for="exampleFormControlTextarea1">คำนำหน้า :</label>
                                    <input type="text" class="form-control" name="name_prefix" value="{{ $history->name_prefix }}" placeholder="กรอกชื่อ" style="margin-left: 10px;">

                                    <label for="exampleFormControlTextarea1" style="margin-left: 20px;">ชื่อ :</label>
                                    <input type="text" class="form-control" name="first_name" value="{{ $history->first_name }}" placeholder="กรอกชื่อ" style="margin-left: 10px;">

                                    <label for="exampleFormControlTextarea1" class="ml-4">นามสกุล :</label>
                                    <input type="text" class="form-control" name="last_name" value="{{ $history->last_name }}" placeholder="กรอกนามสกุล" style="margin-left: 10px;">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-inline form-group ">
                                    <label for="exampleFormControlTextarea1">อีเมล :</label>
                                    <input type="text" class="form-control" name="email" value="{{ $history->email }}" placeholder="กรอกอีเมล" style="margin-left: 10px;">

                                    <label for="exampleFormControlTextarea1" class="ml-4">เบอร์โทรศัพท์ :</label>
                                    <input type="text" class="form-control" name="phone_number" value="{{ $history->phone_number }}" placeholder="กรอกเบอร์โทรศัพท์" style="margin-left: 10px;">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-inline form-group ">
                                    <label for="exampleFormControlTextarea1">วันเกิด :</label>
                                    <input id="datepicker" name="birthday" value="{{ $history->birthday }}" style="margin-left: 10px;" width="276" />


                                    <label for="exampleFormControlTextarea1" class="ml-4">อายุ:</label>
                                    <input type="text" class="form-control" name="year_old" value="{{ $history->year_old }}" placeholder="กรอกอายุ" style="margin-left: 10px;">
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="alert alert-danger p-1" role="alert"></div>
                        <br>
                        <!-- ===================================================================================================ประวัติการศึกษา================================================================================ -->
                        <div class="head position-relative mt-1">
                            <p class="card-text" style="font-size:18px;">ประวัติการศึกษา</p>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-inline form-group mt-3">
                                    <label for="exampleFormControlTextarea1">จบจากมหาวิทยาลัย/วิทลัย :</label>
                                    <input type="text" class="form-control" name="university" value="{{ $history->university }}" placeholder="กรอกชื่อมหาวิทยาลัย/วิทลัย" style="margin-left: 10px;">

                                    <label for="exampleFormControlTextarea1" class="ml-4">คณะ :</label>
                                    <input type="text" class="form-control" name="faculty" value="{{ $history->faculty }}" placeholder="กรอกคณะ" style="margin-left: 10px;">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-inline form-group mt-3">
                                    <label for="exampleFormControlTextarea1">สาขา :</label>
                                    <input type="text" class="form-control" name="branch" value="{{ $history->branch }}" placeholder="กรอกชื่อสาขา" style="margin-left: 10px;">

                                    <label for="exampleFormControlTextarea1" class="ml-4">GPA :</label>
                                    <input type="text" class="form-control" name="gpa" value="{{ $history->gpa }}" placeholder="กรอกGPA" style="margin-left: 10px;">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-inline form-group mt-3">
                                    <label for="exampleFormControlTextarea1">วุฒิการศึกษา :</label>
                                    <input type="text" class="form-control" name="educational" value="{{ $history->educational }}" placeholder="กรอกชื่อ" style="margin-left: 10px;">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="alert alert-danger p-1" role="alert"></div>
                        <br>
                        <!-- ===================================================================================================ประสบการณ์ทำงาน================================================================================ -->
                        <div class="head position-relative mt-1">
                            <p class="card-text" style="font-size:18px;">ประสบการณ์ทำงาน</p>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-inline form-group">
                                    <label for="exampleFormControlTextarea1">ประสบการณ์ที่เคยทำงานกับบริษัท (ปี) :</label>
                                    <input type="text" class="form-control" name="experience" value="{{ $history->experience }}" style="width: 50%; margin-left: 10px;" placeholder="กรอกประสบการณ์ที่เคยทำงานกับบริษัท (ปี)">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">ภาษาที่ถนัด</label>
                                    <textarea class="form-control" name="dominant_language" id="exampleFormControlTextarea1" rows="8"> {{ $history->dominant_language }}</textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">ภาษาที่เคยเรียน</label>
                                    <textarea class="form-control" name="language_learned" id="exampleFormControlTextarea1" rows="8">{{ $history->language_learned }}</textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">ความสามารถพิเศษ</label>
                                    <textarea class="form-control" name="charisma" id="exampleFormControlTextarea1" rows="8">{{ $history->charisma }}</textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">ผลงาน</label>
                                    <br>
                                    <embed src="{{ asset('uploads/portfolio/'.$history->portfolio) }}" width="100%" height="1000px" />
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="alert alert-danger p-1" role="alert"></div>
                        <br>
                        <!-- ===================================================================================================ภูมิลำเนา================================================================================ -->
                        <div class="head position-relative mt-1">
                            <p class="card-text" style="font-size:18px;">ภูมิลำเนา</p>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="row">
                                <div class="form-inline form-group mt-6">
                                    <label for="exampleFormControlTextarea1" class="ml-4">หมู่บ้าน :</label>
                                    <input type="text" class="form-control" name="name_village" value="{{ $history->name_village }}" placeholder="กรอกหมู่บ้าน" style="margin-left: 10px;">
                                </div>

                                <div class="form-inline form-group mt-6">
                                    <label for="exampleFormControlTextarea1" class="ml-5">บ้านเลขที่ :</label>
                                    <input type="text" class="form-control" name="home_number" value="{{ $history->home_number }}" placeholder="กรอกบ้านเลขที่" style="margin-left: 10px;">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="row">
                                <div class="form-inline form-group mt-6">
                                    <label for="exampleFormControlTextarea1" class="ml-4">ซอย/ตรอก :</label>
                                    <input type="text" class="form-control" name="alley" value="{{ $history->alley }}" placeholder="กรอกซอย/ตรอก" style="margin-left: 10px;">
                                </div>

                                <div class="form-inline form-group mt-6">
                                    <label for="exampleFormControlTextarea1" class="ml-4">ถนน :</label>
                                    <input type="text" class="form-control" name="road" value="{{ $history->road }}" placeholder="กรอกถนน" style="margin-left: 10px;">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="row">
                                <div class="form-inline form-group mt-6">
                                    <label for="exampleFormControlTextarea1" class="ml-4">ตำบล :</label>
                                    <input type="text" class="form-control" name="district" value="{{ $history->district }}" placeholder="กรอกตำบล" style="margin-left: 10px;">
                                </div>

                                <div class="form-inline form-group mt-6">
                                    <label for="exampleFormControlTextarea1" style="margin-left:58px">อำเภอ :</label>
                                    <input type="text" class="form-control" name="canton" value="{{ $history->canton }}" placeholder="กรอกอำเภอ" style="margin-left: 10px;">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="row">
                                <div class="form-inline form-group mt-6">
                                    <label for="exampleFormControlTextarea1" class="ml-4">จังหวัด :</label>
                                    <input type="text" class="form-control" name="province" value="{{ $history->province }}" placeholder="กรอกจังหวัด" style="margin-left: 10px;">
                                </div>

                                <div class="form-inline form-group mt-6">
                                    <label for="exampleFormControlTextarea1" style="margin-left:50px">รหัสไปรษณีย์ :</label>
                                    <input type="text" class="form-control" name="postal_code" value="{{ $history->postal_code }}" placeholder="กรอกรหัสไปรษณีย์" style="margin-left: 10px;">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="alert alert-danger p-1" role="alert"></div>
                        <br>
                        <!-- ===================================================================================================ที่อยู่ปัจจุบัน================================================================================ -->
                        <div class="head position-relative mt-1">
                            <p class="card-text" style="font-size:18px;">ที่อยู่ปัจจุบัน</p>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="row">
                                <div class="form-inline form-group mt-6">
                                    <label for="exampleFormControlTextarea1" class="ml-4">หมู่บ้าน :</label>
                                    <input type="text" class="form-control" name="my_name_village" value="{{ $history->my_name_village }}" placeholder="กรอกหมู่บ้าน" style="margin-left: 10px;">
                                </div>

                                <div class="form-inline form-group mt-6">
                                    <label for="exampleFormControlTextarea1" class="ml-5">บ้านเลขที่ :</label>
                                    <input type="text" class="form-control" name="my_home_number" value="{{ $history->my_home_number }}" placeholder="กรอกบ้านเลขที่" style="margin-left: 10px;">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="row">
                                <div class="form-inline form-group mt-6">
                                    <label for="exampleFormControlTextarea1" class="ml-4">ซอย/ตรอก :</label>
                                    <input type="text" class="form-control" name="my_alley" value="{{ $history->my_alley }}" placeholder="กรอกซอย/ตรอก" style="margin-left: 10px;">
                                </div>

                                <div class="form-inline form-group mt-6">
                                    <label for="exampleFormControlTextarea1" class="ml-4">ถนน :</label>
                                    <input type="text" class="form-control" name="my_road" value="{{ $history->my_road }}" placeholder="กรอกถนน" style="margin-left: 10px;">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="row">
                                <div class="form-inline form-group mt-6">
                                    <label for="exampleFormControlTextarea1" class="ml-4">ตำบล :</label>
                                    <input type="text" class="form-control" name="my_district" value="{{ $history->my_district }}" placeholder="กรอกตำบล:" style="margin-left: 10px;">
                                </div>

                                <div class="form-inline form-group mt-6">
                                    <label for="exampleFormControlTextarea1" style="margin-left:58px">อำเภอ :</label>
                                    <input type="text" class="form-control" name="my_canton" value="{{ $history->my_canton }}" placeholder="กรอกอำเภอ" style="margin-left: 10px;">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="row">
                                <div class="form-inline form-group mt-6">
                                    <label for="exampleFormControlTextarea1" class="ml-4">จังหวัด :</label>
                                    <input type="text" class="form-control" name="my_province" value="{{ $history->my_province }}" placeholder="กรอกจังหวัด" style="margin-left: 10px;">
                                </div>

                                <div class="form-inline form-group mt-6">
                                    <label for="exampleFormControlTextarea1" style="margin-left:50px">รหัสไปรษณีย์ :</label>
                                    <input type="text" class="form-control" name="my_postal_code" value="{{ $history->my_postal_code }}" placeholder="กรอกรหัสไปรษณีย์" style="margin-left: 10px;">
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="alert alert-danger p-1" role="alert"></div>
                        <br>

                        <a href="{{ route('ent_search') }}" class="btn btn-danger" style="float:right; margin-left:10px">กลับ</a>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

</body>
@endsection