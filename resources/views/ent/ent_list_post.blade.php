@extends('ent.layout')
@section('title','สร้างใบประกาศ')

@section('content')

<body>
    <div class="container">
        <div class="row justify-content-center">

            <!-- profile -->
            <div class="card" style="width: 80%; top:100px; height:100%; margin-bottom:50px;">
                <div class="card-header" style="background-color:#6369ED; color:White; height:40px;">
                    <p class="card-text" style="font-size: 18px;">ข้อมูลบริษัท</p>
                </div>

                <div class="card-body">
                    @if ($message = Session::get('success_company_profile'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif

                    <a href="{{ route('ent_profile') }}" class="btn btn-primary mb-2">สร้างข้อมูลบริษัท</a>
                    <br>

                    <table class="table table-bordered">
                        <tr>
                            <th>ชื่อบริษัท</th>
                            <th>ติดต่อ</th>
                            <th>เบอร์โทรศัพท์</th>
                            <th>สถานที่ตั้ง</th>
                            <th>action</th>
                        </tr>

                        @if(isset($ent_profile))
                        @foreach ($ent_profile as $ent_profiles)
                        <tr>
                            <td>{{ $ent_profiles->profile_name_company }}</td>
                            <td>{{ $ent_profiles->profile_company_contact }}</td>
                            <td>{{ $ent_profiles->profile_company_phone }}</td>
                            <td>{{ $ent_profiles->profile_company_address }}</td>
                            <td>
                                <a href="{{ route('ent_show_profile',$ent_profiles->profile_company_id) }}" class="btn btn-primary">แสดง</a>
                                <a href="{{ route('ent_edit_profile',$ent_profiles->profile_company_id) }}" class="btn btn-warning">แก้ไข</a>
                                <form action="{{ route('ent_delete_profile',$ent_profiles->profile_company_id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger" type="submit">ลบ</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">

            <!-- post  -->
            <div class="card" style="width: 80%; margin-top:100px; height:100%">
                <div class="card-header" style="background-color:#6369ED; color:White;height:40px;">
                    <p class="card-text" style="font-size: 18px;">ประกาศรับสมัครพนักงาน</p>
                </div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif

                    <a href="{{ route('ent_post') }}" class="btn btn-primary mb-2">สร้างใบประกาศรับสมัครงาน</a>
                    <br>

                    <table class="table table-bordered">
                        <tr>
                            <th>ชื่องาน</th>
                            <th>จำนวน</th>
                            <th>วันที่เริ่มประกาศ</th>
                            <th>วันที่สิ้นสุดประกาศ</th>
                            <th>action</th>
                        </tr>
                        @foreach ($jobs as $jobs)
                        <tr>
                            <td>{{ $jobs->jobs_name }}</td>
                            <td>{{ $jobs->jobs_quantity }}</td>
                            <td>{{ $jobs->start_post }}</td>
                            <td>{{ $jobs->stop_post }}</td>
                            <td>
                                <a href="{{ route('ent.ent_show_post',$jobs->jobs_id) }}" class="btn btn-primary">แสดง</a>
                                <a href="{{ route('ent.ent_edit_post',$jobs->jobs_id) }}" class="btn btn-warning">แก้ไข</a>
                                <form action="{{ route('ent.ent_delete_post',$jobs->jobs_id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger" type="submit">ลบ</button>
                                </form>
                            </td>

                        </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
</body>
@endsection