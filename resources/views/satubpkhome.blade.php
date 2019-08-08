<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Meta Description -->
        <meta name="description" content="TANYA, BPK Project PKL FilkomUB">
        <meta name="keywords" content="SITANYA, Filkom, UB">
        <meta name="author" content="Ananda Putra Alfa Robby, Cheni Irnandha Sebayang, Apriani Ingin Marito Tampubolon, Bella Nemesias Prasetiyani">
        <!-- Icon tab browser -->
        <link rel="shortcut icon" href="asset/img/Logo/Image-x.png" type="image/x-icon">
        <title>TANYA | Badan Pemeriksa Keuangan Republik Indonesia</title>
        <!-- Equipment -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/font.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/sinarstyle.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/bootstrap.min.css') }}">
        <script src="{{ asset('asset/js/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ asset('asset/js/popper.min.js') }}"></script>
        <script src="{{ asset('asset/js/bootstrap.min.js') }}"></script>
    </head>
    <body class="bg-color">
        <div class="hero-image">
            <!--Tab Menu-->        
            <header>
                <nav>
                    <div class="topnav" id="myTopnav">
                        <a class="active">SatuBPK</a>
                        <a href="{{route('login')}}">Login </a>
                        <a href="{{route('register')}}">Register </a>
                        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                </nav>
            </header>
            <div class="containerimg">
                <img src="asset/img/Bg_Sitanar/Bg_1.jpg" style="width:100%;">
            </div>
            <div class="hero-text">
                <h1 style="font-size:450%;">TANYA</h1>
                <p style="font-size:120%;">Sistem Informasi Penyampaian Pertanyaan<br>Badan Pemeriksa Keuangan Republik Indonesia</p>
                <div class="row">
                    <form class="form-inline">
                        <div class="input-container col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <i class="fa fa-hashtag iconform"></i>
                            <input class="input-field" type="text" placeholder="Code Event" name="join"disabled>
                            <div class="input-group-append">
                                <button class="btn btn-warning " disabled>
                                    <i class="fa fa-check"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1">
                        <h2>or</h2>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                        <button  id="myBtn" type="button" class="btn btn-warning btn-sm" style="height: 49px;">Create Event</button>

                    </div>
                </div>
            </div>
        </div>
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
                        <div class="alert alert-danger">
                            <strong>Log in Required!</strong> You must <a href="/login" class="alert-link">Log in </a>before.
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script>
// ====== javascript Modal ====== //
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
//===== Responsiv TopNav====//
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
