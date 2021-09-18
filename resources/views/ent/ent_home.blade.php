@extends('ent.layout')
@section('title','หน้าหลัก')

@section('content')

<body>
    <div class="container" align="center" style="margin-top:50px;">
        <div class="row">
            {!! Form::open(['route' => 'ent_search','method' => 'get']) !!}
            <div class="input-group" style="margin-top:20px; width: 100%;">
                <input type="text" class="form-control" name="query" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="search applicants...">
            </div>
            {!! Form::close() !!}

            <div class="col-md-4">
                <div class="card" style="margin-top:50px;">
                    <div class="card bg-secondary text-white">
                        <div class="card bg-secondary text-white" style="height:40px">
                            <div class="card-body" style="position:relative; top:-15px; text-align:center;">ค้นหาประวัติ</div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="dropdown" style="margin:5px;">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="width: 100%;">
                                ตำแหน่งงานด้านไอที
                            </button>
                            <div class="dropdown-menu" style="width: 100%;">
                                <a class="dropdown-item" href="#">Link 1</a>
                                <a class="dropdown-item" href="#">Link 2</a>
                                <a class="dropdown-item" href="#">Link 3</a>
                            </div>
                        </div>


                        <div class="dropdown" style="margin:5px">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="width: 100%;">
                                ระดับการศึกษา
                            </button>
                            <div class="dropdown-menu" style="width: 100%;">
                                <a class="dropdown-item" href="#">Link 1</a>
                                <a class="dropdown-item" href="#">Link 2</a>
                                <a class="dropdown-item" href="#">Link 3</a>
                            </div>
                        </div>


                        <div class="dropdown" style="margin:5px">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="width: 100%;">
                                เพศ
                            </button>
                            <div class="dropdown-menu" style="width: 100%;">
                                <a class="dropdown-item" href="#">Link 1</a>
                                <a class="dropdown-item" href="#">Link 2</a>
                                <a class="dropdown-item" href="#">Link 3</a>
                            </div>
                        </div>


                        <div class="dropdown" style="margin:5px">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="width: 100%;">
                                จังหวัด
                            </button>
                            <div class="dropdown-menu" style="width: 100%;">
                                <a class="dropdown-item" href="#">Link 1</a>
                                <a class="dropdown-item" href="#">Link 2</a>
                                <a class="dropdown-item" href="#">Link 3</a>
                            </div>
                        </div>


                        <div class="dropdown" style="margin:5px">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="width: 100%;">
                                เขต
                            </button>
                            <div class="dropdown-menu" style="width: 100%;">
                                <a class="dropdown-item" href="#">Link 1</a>
                                <a class="dropdown-item" href="#">Link 2</a>
                                <a class="dropdown-item" href="#">Link 3</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card" style="margin-top:50px;">
                    <div class="card-body">

                        <img src="https://www.w3schools.com/images/lamp.jpg" alt="Lamp" width="100" height="100" style="float:left;">

                        <div class="date" style="float: right;" align="right">
                            <p>วันที่ลงประกาศ</p>

                            <br><br><br><br><br>

                            <a type="button" href="#" class="btn btn-warning">เก็บเข้าแฟ้ม</a>
                            <a type="button" href="#" class="btn" style="background-color:#6369ED; color:White;">ดูรายละเอียดผู้สมัคร</a>
                        </div>

                        <div class="jobs_detail" style="float: left;" align="left">
                            <p>นาย ภาณุวัฒน์ มังสังข์</p>
                            <p>ตำแหน่งที่อยากทำ :</p>
                            <p>ระดับการศึกษา : ปริญญาตรี </p>
                            <p>สถานศึกษา : มหาวิทยาลัยพะเยา</p>
                            <p>ประสบการณ์ทำงาน : 1 ปี</p>
                        </div>
                    </div>
                </div>

                <br>

                <div class="card">
                    <div class="card-body">

                        <img src="https://www.w3schools.com/images/lamp.jpg" alt="Lamp" width="100" height="100" style="float:left;">

                        <div class="date" style="float: right;" align="right">
                            <p>วันที่ลงประกาศ</p>

                            <br><br><br><br><br>

                            <a type="button" href="#" class="btn btn-warning">เก็บเข้าแฟ้ม</a>
                            <a type="button" href="#" class="btn" style="background-color:#6369ED; color:White;">ดูรายละเอียดผู้สมัคร</a>
                        </div>

                        <div class="jobs_detail" style="float: left;" align="left">
                            <p>นาย ภาณุวัฒน์ มังสังข์</p>
                            <p>ตำแหน่งที่อยากทำ :</p>
                            <p>ระดับการศึกษา : ปริญญาตรี </p>
                            <p>สถานศึกษา : มหาวิทยาลัยพะเยา</p>
                            <p>ประสบการณ์ทำงาน : 1 ปี</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>


@endsection