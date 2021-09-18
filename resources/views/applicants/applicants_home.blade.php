@extends('applicants.layout')
@section('title','หน้าหลัก')

@section('content')

<body>
    <div class="container col-12" style="margin-top:100px;">
        <div class="row">
            <div class="col-md-3">
                <a type="button" href="{{ route('applicants_show_history') }}" class="btn btn-success" style="width: 100%;">ฝากประวัติ</a>

                <br><br><br>

                <div class="card-header" style="height:43px; background-color:#607D8B; color:white;">
                    <span class="align-top">รายชื่อของคนที่อาจรู้จัก</span>
                </div>
                <div class="card">
                    <div class="card-body" style="width:100%">
                        <table class="table table-hover">
                            <tr>
                                <td>พันธการ ปิงเมือง</td>
                            </tr>
                            <tr>
                                <td>ภาณุวัฒน์ มังสังข์ </td>
                            </tr>
                            <tr>
                                <td>วีรภัทร เยเกอร์</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                @if(isset($jobs))
                @foreach($jobs["hits"]["hits"] as $job)
                <div class="card">
                    <div class="card-body">

                        <img src="{{ asset('uploads/logo/'.$job['_source']['logo']) }}" alt="Lamp" width="100" height="100" style="float:left;">

                        <div class="date" style="float: right;">
                            <p>{{ $job['_source']['start_post'] }} ถึง {{ $job['_source']['stop_post'] }}</p>

                            <br><br><br><br><br><br><br><br><br><br><br>

                            <button type="button" style="margin-left: 0px;" class="btn btn-warning">สนใจ</button>

                            <a type="button" style="margin-left: 0px;" href="{{ route('see_detail',$job['_source']['jobs_id']) }}" class="btn btn-primary">ดูรายละเอียด</a>
                        </div>

                        <div class="jobs_detail" style="float: left; width:450px;" align="left">
                            <p>ตำแหน่งงาน : {{ $job['_source']['jobs_name'] }}</p>
                            <p>ชื่อบริษัท : {{ $job['_source']['jobs_name_company'] }}</p>
                            <p>ที่อยู่ : {{ $job['_source']['jobs_address'] }}</p>
                            <p>จำนวนที่รับ : {{ $job['_source']['jobs_quantity'] }}</p>
                            <p>จำนวนที่รับ : {{ $job['_source']['jobs_salary'] }}</p>
                        </div>
                    </div>
                </div>
                <br>
                @endforeach
                @endif
            </div>

            <div class="col-md-3">
                <div class="card-header" style="background-color:#607D8B; color:white;">
                    <span class="align-top">งานยอดนิยม</span>
                </div>
                <div class="card">
                    <div class="card-body" style="width:100%;">
                        <table class="table table-hover">
                            <tr>
                                <td>Programmer</td>
                            </tr>
                            <tr>
                                <td>Web Programmer</td>
                            </tr>
                            <tr>
                                <td>Design UX/UI</td>
                            </tr>
                            <tr>
                                <td>Tester</td>
                            </tr>
                            <tr>
                                <td>Mobile Developer</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <br>

                <div class="card-header" style="background-color:#607D8B; color:white;">
                    <span class="align-top">งานที่ไม่นิยม</span>
                </div>
                <div class="card">
                    <div class="card-body" style="width:100%;">
                        <table class="table table-hover">
                            <tr>
                                <td>Project Manager</td>
                            </tr>
                            <tr>
                                <td>System Engineer</td>
                            </tr>
                            <tr>
                                <td>System Analyst </td>
                            </tr>
                            <tr>
                                <td>IT Consulting</td>
                            </tr>
                            <tr>
                                <td>IT Support</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <br>
    </div>

</body>


@endsection