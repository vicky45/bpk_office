<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Meta Description -->
        <meta name="description" content="SITANYA, BPK Project PKL FilkomUB">
        <meta name="keywords" content="SITANYA, Filkom, UB">
        <meta name="author" content="Ananda Putra Alfa Robby, Cheni Irnandha Sebayang, Apriani Ingin Marito Tampubolon, Bella Nemesias Prasetiyani">
        <!-- Icon tab sinar browser -->
        <link rel="shortcut icon" href="asset/img/Logo/logo_bpkri.png" type="image/x-icon">
        <title>SITANYA | Badan Pemeriksa Keuangan Republik Indonesia</title>
        <!-- Equipment -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/font.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/sitanyastyle.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/bootstrap.min.css') }}">
        <script src="{{ asset('asset/js/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ asset('asset/js/popper.min.js') }}"></script>
        <script src="{{ asset('asset/js/bootstrap.min.js') }}"></script>
    </head>
    <body class="bg-color">
        <nav class="navbar navbar-dark navbar-expand-md bg-warning justify-content-between">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-nav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse w-50 order-1 order-sm-0 dual-nav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <div class="navbar-header">
                                <a class="navbar-brand" >
                                    <img src="asset/img/Logo/logo_bpkri.png" style="height: 5.0rem;">
                                    TANJA</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <a id="myBtn" class=" mx-auto text-center text-dark order-0 order-sm-1 size-roll">
                    @foreach ($event as $ev)
                    <h5><b>{{$ev->name_event}}</b></h5>
                    <h6>{{$ev->date_event}}</h6>
                    <h6>{{$ev->location}}</h6> 
                    <h6>#{{$ev->code_event}}</h6> 
                    @endforeach
                </a>
                <div class="navbar-collapse collapse w-50 order-sm-2 dual-nav">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="">
                            </a>
                            <div class="dropdown">
                                <button onclick="myFunction()" class="dropbtnhdr">
                                    <div class="containeruser">
                                        <img src="asset/img/Logo/user.jpg" alt="Avatar" class="imageuser">
                                        <div class="overlay">{{ Auth::user()->name }}</div>
                                    </div>
                                </button>

                                <div id="myDropdown" class="dropdown-content dual-nav">
                                    <span class="dropdown-item-text"><b>{{ Auth::user()->name }}</b></span>

                                    <div class="dropdown-divider"></div>
                                    <a class="text-decoration-none" href="/switch_event">Switch Event</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active"  data-toggle="tab" href="#quest">Question</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  data-toggle="tab" href="#poll">Polling</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  data-toggle="tab" href="#sum">Summary</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div id="quest" class=" tab-pane active"><br>
                <div id="mySidenav" class="sidenav">
                    <div class="card card-bg1 padding-card">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <h2> Speaker</h2>
                        <hr>
                        <br>
                        <form class="form-horizontal" method="POST" action="/speaker">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="text" class="form-control form-speaker" id="speaker" name="speaker" placeholder="Categories" required="required">
                            </div>
                            <button type="submit" class="btn btn-primary float-sm-right">Save</button>
                        </form>
                        <hr>
                        @foreach ($ev->SpeakerModel as $speak)
                        <div class= "row">
                            <div class="containeruser font-weight-bold">
                                <button type="button" class="btn btn-block" >
                                    <p class="text-left">{{$speak->name_speaker}}</p>
                                </button>
                            </div>
                            <div class="containeruser col-sm-5">
                                <button class="btn">
                                    <a class="link-icon" href="/delete_speaker/{{$speak->idSpeaker}}">
                                        <i class="fa fa-trash float-right fa-2x"></i> 
                                    </a>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="row col-md-12">
                    <div class="col-md-4">
                        <span class=" btn btn-primary" onclick="openNav()"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>  Create Speaker's</span>
                    </div>

                    <div class="col-sm-4">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif
                        @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <a href="">
                            <button class="btn btn-outline-danger float-sm-right">
                                End Event
                            </button>
                        </a>
                    </div>
                </div>
                <div id="main">
                    <div class="card-deck">
                        <div class="card card-bg2 padding-card col-sm-6" >
                            <h2>Question List</h2>
                            <hr>
                            <div class="card padding-manual scroll">
                                <div class="card" id="question">
                                    <div class="card-header-answer">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <img src="asset/img/Logo/user.jpg" alt="Avatar" class="avatar">
                                                <b>{{ Auth::user()->name }}</b>
                                            </div>
                                            <!--aprove-->
                                            <div class="col-md-3">
                                                <a href="">
                                                    <button class="btn btn-success float-sm-right">
                                                        <i class="fa fa-check"></i> Approve
                                                    </button>
                                                </a>
                                            </div>
                                            <div class="col-md-1">
                                                <a href="">
                                                    <button class="btn btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center" >
                                        <hr class="hr-fit">
                                    </div>
                                    <div class="card-body">
                                        <p><b> Apa yang dimaksud dengan sistem pertanyaan dalam seminar BPK? </b></p>
                                    </div>
                                    <div class="card-footer ">
                                        <small class="text-muted"><b>Kategori </b></small>
                                        <a class="float-sm-right" href="#" style="color:red;"><i class="fa fa-thumbs-o-down"></i><span> <b>10&emsp;</b> </span></a>
                                        <a class="float-sm-right" href="#" style="color:green;" ><i class="fa fa-thumbs-o-up"></i><span> <b>15&emsp;</b> </span></a>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="card card-bg3 padding-card col-sm-6">
                            <h2>Question Approve</h2>
                            <hr>
                            <div class="card padding-manual scroll">
                                <div class="card" id="question">
                                    <div class="card-header-answer">
                                        <img src="asset/img/Logo/user.jpg" alt="Avatar" class="avatar">
                                        <b>{{ Auth::user()->name }}</b>
                                    </div>
                                    <div class="text-center" >
                                        <hr class="hr-fit">
                                    </div>
                                    <div class="card-body">
                                        <p><b> Apa yang dimaksud dengan sistem pertanyaan dalam seminar BPK? </b></p>
                                    </div>
                                    <div class="card-footer ">
                                        <small class="text-muted"><b>Kategori </b></small>
                                        <a class="float-sm-right" href="#" style="color:red;"><i class="fa fa-thumbs-o-down"></i><span> <b>10&emsp;</b> </span></a>
                                        <a class="float-sm-right" href="#" style="color:green;" ><i class="fa fa-thumbs-o-up"></i><span> <b>15&emsp;</b> </span></a>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="poll" class=" tab-pane fade"><br>
                <h3>Menu 1</h3
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div id="sum" class="tab-pane fade"><br>
                <h3>Menu 2</h3>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
            </div>
        </div>       
        <!-- Tab panes -->
        <div clas="container">
            <div class="modal" id="myModal" style="padding-top: 0px;" >
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Event</h4>
                            <button type="button" class="btn close-modal" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            @foreach ($event as $ev)
                            <form id="form-modal" class="form-horizontal" method="POST" action="{{route('event.update',$ev->idEvent)}}">
                                {{ method_field('PATCH') }}
                                {{ csrf_field() }}
                                <!--form name event-->
                                <div class="form-group">
                                    <label><strong> Event Name </strong></label>
                                    <input type="text" class="form-control" name="event" value="{{$ev->name_event}}" required="required">
                                    @if($errors->has('event'))
                                    <div class="text-danger">
                                        {{ $errors->first('event')}}
                                    </div>
                                    @endif
                                </div>
                                <!--form name date-->
                                <label><strong> Date </strong></label>
                                <div class="form-group row">
                                    <div class="col-md-6" style="padding-left: 0px;">
                                        <input type="date" class="form-control" id="date" name="date" value="{{$ev->date_event}}" required="required" >
                                        @if($errors->has('date'))
                                        <div class="text-danger">
                                            {{ $errors->first('date')}}
                                        </div>
                                        @endif
                                    </div>
                                    <!--form name time-->
                                    <label><strong>  at : </strong></label>
                                    <div class="col-md-5" style="padding-right: 50px;">
                                        <input type="time" class="form-control" name="time" value="{{$ev->time_event}}" required="required">
                                        @if($errors->has('location'))
                                        <div class="text-danger">
                                            {{ $errors->first('location')}}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <!--form location event-->
                                <div class="form-group">
                                    <label><strong> Place </strong></label>
                                    <input type="text" class="form-control" name="location" value="{{$ev->location}}" required="required">
                                    @if($errors->has('location'))
                                    <div class="text-danger">
                                        {{ $errors->first('location')}}
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="id" value="{{ $ev->idEvent }}">
                                    <!--form code event-->
                                    <label><strong> Event Code </strong></label>
                                    <input type="text" class="form-control" name="code" value="{{$ev->code_event}}" minlength="6" maxlength="6" required="required">
                                    @if($errors->has('event'))
                                    <div class="text-danger">
                                        {{ $errors->first('code')}}
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                                <label><strong> Add Admin </strong></label>
                                <div class="form-group">
                                    <div class="row">
                                        <div id="myDIV">
                                            <input type="text" id="myInput" class=" form-control" placeholder="name employee" size="50">
                                        </div>
                                        <span onclick="newElement()" id="add" class="addBtn btn fa fa-plus float-right fa-2x"></span>
                                    </div>
                                </div>
                                <ul id="myUL">
                                </ul>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        /* When the user clicks on the button, 
         toggle between hiding and showing the dropdown content */
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }
// Close the dropdown menu if the user clicks outside of it
        window.onclick = function (event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
        function openNav() {
            document.getElementById("mySidenav").style.width = "350px";
            document.getElementById("main").style.marginLeft = "350px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
        }
// Get the modal
        var modal = document.getElementById("myModal");
// Get the button that opens the modal
        var btn = document.getElementById("myBtn");
// Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close-modal")[0];
// When the user clicks the button, open the modal 
        btn.onclick = function () {
            modal.style.display = "block";
        }
// When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }
// When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
// Click on a close button to hide the current list item
        var close = document.getElementsByClassName("close");
        var i;
        for (i = 0; i < close.length; i++) {
            close[i].onclick = function () {
                var div = this.parentElement;
                div.style.display = "none";
            }
        }
// Create a new list item when clicking on the "Add" button
        function newElement() {
            var li = document.createElement("li");
            var inputValue = document.getElementById("myInput").value;
            var t = document.createTextNode(inputValue);
            li.appendChild(t);
            if (inputValue === '') {
                alert("You must write something!");
            } else {
                document.getElementById("myUL").appendChild(li);
            }
            document.getElementById("myInput").value = "";

            var span = document.createElement("SPAN");
            var txt = document.createTextNode("\u00D7");
            span.className = "close";
            span.appendChild(txt);
            li.appendChild(span);

            for (i = 0; i < close.length; i++) {
                close[i].onclick = function () {
                    var div = this.parentElement;
                    div.style.display = "none";
                }
            }
        }
    </script>
</html>