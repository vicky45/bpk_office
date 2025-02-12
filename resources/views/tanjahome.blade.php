<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Meta Description -->
        <meta name="description" content="Tanya, BPK Project PKL FilkomUB">
        <meta name="keywords" content="TANYA, Filkom, UB">
        <meta name="author" content="Ananda Putra Alfa Robby, Cheni Irnandha Sebayang, Apriani Ingin Marito Tampubolon, Bella Nemesias Prasetiyani">
        <!-- Icon tab sinar browser -->
        <link rel="shortcut icon" href="asset/img/Logo/Image-x.png" type="image/x-icon">
        <title>SiTANYA | Badan Pemeriksa Keuangan Republik Indonesia</title>
        <!-- Equipment -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/font.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/sitanyastyle.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/bootstrap.min.css') }}">
        <script src="{{ asset('asset/js/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ asset('asset/js/popper.min.js') }}"></script>
        <script src="{{ asset('asset/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript">
var auto_refresh = setInterval(
        function () {
            $('#event_active').load('{{route('event.create')}}').fadeIn("slow");
        }, 3000);
        </script>
    </head>
    <body class="bg-dark">
        <div class="hero-image">
            <!--Tab Menu-->        
            <header>
                <nav>
                    <div class="topnav fixed" id="myTopnav">
                        <a class="active">
                            <div class="row text-white">
                                <img src="asset/img/Logo/Tanya-icon.png" style="height: 1.5rem;">
                                <h5><strong>&nbsp;SiTANYA</strong></h5>
                            </div>
                        </a>
                        <a href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>Log Out
                        </a>
                        <a class="activeuser">Hi {{ Auth::user()->name }}</a>
                        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                </nav>
            </header>
            <!--View Big Page first TANYA-->
            <div class="containerimg">
                <img src="asset/img/Bg_Sitanar/Bg_1.jpg" style="width:100%;">
            </div>
            <!--h-75 for respons smartphone-->
            <div class="hero-text">
                <h1 style="font-size:450%;">SiTANYA</h1>
                <p style="font-size:120%;">Sistem Informasi Penyampaian Pertanyaan dan Jawaban<br>Badan Pemeriksa Keuangan Republik Indonesia</p>
                <div class="row">
                    <form class="form-inline" method="post" action="{{ route('event.store')}}">
                        {{ csrf_field() }}
                        <div class="input-container col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <i class="fa fa-hashtag iconform"></i>
                            <input class="input-field" type="text" placeholder="Code Event" name="join" maxlength="6" required="required">
                            @if($errors->has('join'))
                            <div class="text-danger">
                                {{ $errors->first('join')}}
                            </div>
                            @endif
                            <div class="input-group-append">
                                <button id="btn-join" class="btn btn-info bg-info " type="submit">
                                    Join
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1">
                        <h2>or</h2>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                        <button  id="myBtn" type="button" class="btn btn-info btn-sm bg-info" style="height: 49px;">Create Event</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        @if ($message = Session::get('warning'))
                        <div class="alert alert-warning alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif
                    </div>
                </div>
                <br>
                <div id="event_active">
                    <!--event_active-->
                </div>
            </div>
        </div>
        <!--Set Modal TANYA-->
        <div class="modal" id="myModal" style="padding-top: 0px;" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Create an Event</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form class="form-horizontal" method="POST" action="{{ route('event.store') }}">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label> Event Name </label>
                                    <!--form name event-->
                                    <input type="text" class="form-control" id="event" name="event" placeholder="Name" required="required">
                                    @if($errors->has('event'))
                                    <div class="text-danger">
                                        {{ $errors->first('event')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label> Date </label>
                                </div>
                                <div class="col-md-5" style="padding-right: 50px;">
                                    <label> Time </label>
                                </div>
                                <!--form name date-->
                                <div class="col-md-6">
                                    <input type="date" class="form-control" id="date" name="date" required="required" >
                                    @if($errors->has('date'))
                                    <div class="text-danger">
                                        {{ $errors->first('date')}}
                                    </div>
                                    @endif
                                </div>
                                <!--form name time-->
                                <div class="col-md-5" style="padding-right: 50px;">
                                    <input type="time" class="form-control" name="time" required="required">
                                    @if($errors->has('location'))
                                    <div class="text-danger">
                                        {{ $errors->first('location')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <!--form name location-->
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label> Place </label>
                                    <input type="location" class="form-control" id="location" name="location" placeholder="Place" required="required">
                                    @if($errors->has('location'))
                                    <div class="text-danger">
                                        {{ $errors->first('location')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary float-sm-right">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
// ====== javascript Modal ====== \\
            var modal = document.getElementById("myModal");
            var btn = document.getElementById("myBtn");
            var span = document.getElementsByClassName("close")[0];
// Button open 
            btn.onclick = function () {
                modal.style.display = "block";
            }
// Button x
            span.onclick = function () {
                modal.style.display = "none";
            }
//Out Box
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
//===== Responsiv TopNav====\\
            function myFunction() {
                var x = document.getElementById("myTopnav");
                if (x.className === "topnav") {
                    x.className += " responsive";
                } else {
                    x.className = "topnav";
                }
            }
        </script>
    </body>
</html>