@extends('ent.layout')
@section('title','ตรวจสอบผู้สมัคร')

@section('content')

<body>
    <div class="container">
        <div class="row justify-content-center">
           

            <div class="col-md-6">
                <div class="card" style="margin-top:100px;">
                    <div class="card-header" style="background-color:#6369ED; color:White;">ตรวจสอบผู้สมัคร</div>

                    <div class="card-body">

                        <div class="col-md-12">
                            <div class="detail" style="padding-top: 15px; ">
                                <img src="https://www.w3schools.com/images/lamp.jpg" width="80" height="80" style="float:left;">

                                <div class="jobs_detail" style="float:left; font-size:14px;">
                                    <p>ชื่อ - นามสกุล : นาย ภาณุวัฒน์ มังสังข์</p>
                                    <p>เพศ : ชาย </p>
                                    <p>อายุ : 22 ปี</p>
                                    <p>ตำแหน่งงาน : Programmer</p>
                                    <p>ระดับการศึกษา : ปริญญาตรี</p>
                                    <p>สถานศึกษา :มหาวิทยาลัยพะเยา</p>
                                    <p>ประสบการณ์ทำงาน : 1 ปี</p>
                                    <p>เงินเดือนที่ต้องการ :155,000 บาท</p>
                                </div>

                                <div class="date" style="float: right;" align="right">
                                    <p>วันที่</p>
                                </div>

                                <div class="btn_select" style="float:left;" align="left">
                                    <a href="#" class="btn btn-success">ยอมรับ</a>
                                    <a href="#" class="btn btn-danger">ปฏิเสธ</a>
                                    <a href="#" class="btn btn-primary">ดูรายละเอียด</a>
                                </div>
                            </div>

                            <br>


                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card" style="top:100px">
                    <div class="card-header" style="background-color:#6369ED; color:White;">แฟ้มที่บันทึก</div>

                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="detail" style="padding-top: 15px; ">
                                <img src="https://www.w3schools.com/images/lamp.jpg" width="80" height="80" style="float:left;">

                                <div class="jobs_detail" style="float:left; font-size:14px;">
                                    <p>ชื่อ - นามสกุล : นาย ภาณุวัฒน์ มังสังข์</p>
                                    <p>เพศ : ชาย </p>
                                    <p>อายุ : 22 ปี</p>
                                    <p>ตำแหน่งงาน : Programmer</p>
                                    <p>ระดับการศึกษา : ปริญญาตรี</p>
                                    <p>สถานศึกษา :มหาวิทยาลัยพะเยา</p>
                                    <p>ประสบการณ์ทำงาน : 1 ปี</p>
                                    <p>เงินเดือนที่ต้องการ :155,000 บาท</p>
                                </div>

                                <div class="date" style="float: right;" align="right">
                                    <p>วันที่</p>
                                </div>

                                <div class="btn_select" style="float:left;" align="left">
                                    <a href="#" class="btn btn-success">ยอมรับ</a>
                                    <a href="#" class="btn btn-danger">ปฏิเสธ</a>
                                    <a href="#" class="btn btn-primary">ดูรายละเอียด</a>
                                </div>
                            </div>

                            <br>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>
@endsection