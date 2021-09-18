@extends('ent.layout')
@section('title','หน้าหลัก')

@section('content')

<body>
    <div class="container" align="center" style="margin-top:50px;">
        <div class="row">

            <!-- text search -->
            <div class="col-md-12" style="margin-top:20px;">
                {!! Form::open(['route' => 'ent_search','method' => 'get']) !!}
                <div class="input-group" style="margin-top:20px;">
                    <input type="text" value="{{$query}}" class="form-control" name="query" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="search jobs...">
                </div>
                {!! Form::close() !!}
            </div>
            <div class="col-md-12" align="center">
                @if(isset($results))
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">นามสกุล</th>
                            <th scope="col">สาขา</th>
                            <th scope="col">มหาวิทยาลัยพะเยา</th>
                            <th scope="col">ประสบการณ์ทำงาน</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($results["hits"]["hits"] as $result)
                        <!-- echo ($result); -->
                        <tr>
                            <th scope="row">{{ $result['_source']['history_id']}}</th>
                            <td>{{ $result['_source']['first_name'] }}</td>
                            <td>{{ $result['_source']['last_name'] }}</td>
                            <td>{{ $result['_source']['branch'] }}</td>
                            <td>{{ $result['_source']['university'] }}</td>
                            <td>{{ $result['_source']['experience'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>

            <div class="col-md-4">
                <div class="card" style="margin-top:50px;">
                    <div class="card bg-secondary text-white">
                        <div class="card bg-secondary text-white" style="height:40px">
                            <div class="card-body" style="position:relative;top:-15px;text-align:center;">ค้นหาประวัติ</div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="dropdown" style="margin:5px;">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="width: 100%;">
                                ภาษาที่ถนัด
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

            <!-- main -->
            <div class="col-md-8">
                @if(isset($results))
                @foreach($results["hits"]["hits"] as $result)

                <div class="card">
                    <div class="card-body">

                        <img src="{{ asset('uploads/profile/'.$result['_source']['profile']) }}" alt="profile" width="100" height="100" style="float:left;">

                        <div class="date" style="float: right;">
                            

                            <br><br><br><br><br>

                            <a type="button" href="{{ route('ent_see_detail',$result['_source']['history_id']) }}" class="btn btn-primary">ดูรายละเอียด</a>
                        </div>

                        <div class="jobs_detail" style="float: left;" align="left">
                            <p>ชื่อ : {{ $result['_source']['first_name'] }}</p>
                            <p>นามสกุล : {{ $result['_source']['last_name'] }}</p>
                            <p>สาขา : {{ $result['_source']['branch'] }}</p>
                            <p>สถานศึกษา : {{ $result['_source']['university'] }}</p>
                            <p>ประสบการณ์ทำงาน : {{ $result['_source']['experience'] }}</p>
                        </div>
                    </div>
                </div>
                <br>
                @endforeach
                @endif


                <!-- display data from elasticsearch kibana -->
                
                @if(isset($applicants))
                @foreach($applicants["hits"]["hits"] as $applicant)

                <div class="card" style="margin-top:50px;">
                    <div class="card-body">

                        <img src="{{ asset('uploads/profile/'.$applicant['_source']['profile']) }}" alt="profile" width="100" height="100" style="float:left;">

                        <div class="date" style="float: right;">
                          

                            <br><br><br><br><br>

                            <a type="button" href="{{ route('ent_see_detail',$applicant['_source']['history_id']) }}" class="btn btn-primary">ดูรายละเอียด</a>
                        </div>

                        <div class="jobs_detail" style="float: left;" align="left">
                            <p>ลำดับ : {{ $applicant['_source']['history_id'] }}</p>
                            <p>ชื่อ : {{ $applicant['_source']['first_name'] }}</p>
                            <p>นามสกุล : {{ $applicant['_source']['last_name'] }}</p>
                            <p>สาขา : {{ $applicant['_source']['branch'] }}</p>
                            <p>สถานศึกษา : {{ $applicant['_source']['university'] }}</p>
                            <p>ประสบการณ์ทำงาน : {{ $applicant['_source']['experience'] }}</p>
                        </div>
                    </div>
                </div>
                <br>
                @endforeach
                @endif
            </div>
        </div>
    </div>

</body>


@endsection