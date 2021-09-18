@extends('applicants.layout')
@section('title','งานของฉัน')

@section('content')
<div class="container">
    <div class="row">

        <!-- left side -->
        <div class="col-md-4 left-side" align="center">
            <div class="card">
                <div class="card-header">
                    งานของฉัน
                </div>
                <div class="card-body">
                    <a href="#" class="btn btn-danger">งานทั้งหมด</a>
                </div>
                <div class="card-body">
                    <a href="#" class="btn btn-danger">งานที่สนใจ</a>
                </div>
                <div class="card-body">
                    <a href="#" class="btn btn-danger">งานที่สมัคร</a>
                </div>
                <div class="card-body">
                    <a href="#" class="btn btn-danger">บริษัทที่ดูประวัติ</a>
                </div>
            </div>
        </div>

        <!-- main -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                    <img src="https://www.w3schools.com/images/lamp.jpg" alt="Lamp" width="100" height="100" style="float:left;">

                    <div class="date" style="float: right;">
                        <p>วันที่ลงประกาศ</p>

                        <br><br><br><br><br>

                        <a type="button" href="#" class="btn btn-primary">ดูรายละเอียด</a>
                    </div>

                    <div class="jobs_detail" style="float: left;" align="left">
                        <p>ตำแหน่งงาน : </p>
                        <p>ชื่อบริษัท :</p>
                        <p>ที่อยู่ : </p>
                        <p>จำนวนที่รับ :</p>
                        <p>15,000 บาท :</p>
                    </div>


                </div>
            </div>
            <br>
        </div>
    </div>
</div>
@endsection