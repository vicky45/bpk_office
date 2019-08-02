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
        <script type="text/javascript">
        var auto_refresh = setInterval(
        function () {
            $('#show_question').load('/validate/{{session()->get('event')}}').fadeIn("slow");
        }, 3000);
        
        </script>
        
        
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
                <a data-toggle="modal" data-target="#update" class=" mx-auto text-center text-dark order-0 order-sm-1 size-roll">
                    @foreach ($event as $ev)
                    <h5><b>{{$ev->name_event}}</b></h5>
                    <h6>{{$ev->date_event}}</h6>
                    <h6>{{$ev->location}}</h6> 
                    <h6>#{{$ev->code_event}}</h6> 
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
                                        <div class="overlay">Admin</div>
                                    </div>
                                </button>
                                @if($ev->status_event == 0)
                                <div id="myDropdown" class="dropdown-content dual-nav">
                                    <span class="dropdown-item-text"><b>{{ Auth::user()->name }}</b></span>
                                    <div class="dropdown-divider"></div>
                                    <a class="text-decoration-none" href="/home">Log Out</a>
                                </div>
                                @else
                                <div id="myDropdown" class="dropdown-content dual-nav">
                                    <span class="dropdown-item-text"><b>{{ Auth::user()->name }}</b></span>
                                    <div class="dropdown-divider"></div>
                                    <a class="text-decoration-none" href="/Out">End Event</a>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="Sheet" role="tablist">
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
            <!--View Question-->
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
                                <input type="text" class="form-control form-speaker" id="speaker" name="speaker" placeholder="Name Speaker" required="required">
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
                            <div class="containeruser col-sm-6">
                                <button class="btn float-sm-right">
                                    <a class="link-icon" href="/delete_speaker/{{$speak->idSpeaker}}">
                                        <i class="fa fa-trash float-sm-right"></i> 
                                    </a>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="row col-md-12">
                    <div class="col-md-4">
                        <span class=" btn btn-outline-primary" onclick="openNav()"><i class="fa fa-users" aria-hidden="true"></i>  Create Speaker's</span>
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
                        
                    </div>
                </div>
                <div id="main">
                    <div class="card-deck">
                        <div class="card card-bg2 padding-card col-sm-6" >
                            <h2>Question List</h2>
                            <hr>
                            <div id="show_question" class="card padding-manual scroll">
                                @if($question_validate->count() > 0 )
                                @foreach( $question_validate as $v)
                                <div class="card">
                                    <div class="card-header-answer">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <img src="asset/img/Logo/user.jpg" alt="Avatar" class="avatar">
                                                <b>{{$v->user->name}}</b>
                                            </div>
                                            <!--aprove-->
                                            <div class="col-md-4">
                                                <a href="/approve/{{($v->idQuestion)}}">
                                                    <button class="btn btn-success float-sm-right">
                                                        <i class="fa fa-check"></i> Approve
                                                    </button>
                                                </a>
                                            </div>
                                            <!--button delete-->
                                            <div class="col-md-1">
                                                <a href="/delete/{{($v->idQuestion)}}">
                                                    <button class="btn btn-danger float-sm-right">
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
                                        <p><b> {{$v->question}} </b></p>
                                    </div>
                                    <div class="card-footer ">
                                        @if($v->Speaker_idSpeaker == 0)
                                        <small class="text-muted"><b>Universal Question</b></small>
                                        @else
                                        <small class="text-muted"><b>{{$v->SpeakerModel->name_speaker}} </b></small>
                                        @endif
                                        <a class="float-sm-right" href="#" style="color:red;"><i class="fa fa-thumbs-o-down"></i><span> <b>{{($v->reaction_dislike)}}&emsp;</b> </span></a>
                                        <a class="float-sm-right" href="#" style="color:green;" ><i class="fa fa-thumbs-o-up"></i><span> <b>{{($v->reaction_like)}}&emsp;</b> </span></a>
                                    </div>
                                </div>
                                <br>
                                @endforeach
                                @else
                                <div class="text-center">
                                    <hr style="width: 50%">
                                    <h4>There's is No Question</h4>
                                    <hr style="width: 50%">
                                </div>
                                @endif 
                            </div>
                        </div>
                        <div class="card card-bg3 padding-card col-sm-6">
                            <h2>Question Approve</h2>
                            <hr>
                            <div class="card padding-manual scroll">
                                @foreach($question_approve as $a)
                                <div class="card" id="question">
                                    <div class="card-header-answer">
                                        <img src="asset/img/Logo/user.jpg" alt="Avatar" class="avatar">
                                        <b>{{$a->user->name}}</b>
                                    </div>
                                    <div class="text-center" >
                                        <hr class="hr-fit">
                                    </div>
                                    <div class="card-body">
                                        <p><b> {{$a->question}} </b></p>
                                        <br>
                                         @if($a->Speaker_idSpeaker == 0)
                                         <small class="text-muted"><b>Universal Question</b></small>
                                         @else
                                        <small class="text-muted"><b>{{$a->SpeakerModel->name_speaker}} </b></small>
                                        @endif
                                    </div>
                                    <div class="card-footer ">
                                        
                                        @if($a->answer === "Not Answered")
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="{{route('question.update',$a->idQuestion)}}" method="POST">
                                                    {{ method_field('PATCH') }}
                                                    {{ csrf_field() }}
                                                    <div class="input-group">
                                                        <input type="text" name="answer" placeholder="{{$a->answer}}" class="form-control">
                                                        @if($errors->has('answer'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('event')}}
                                                        </div>
                                                        @endif
                                                        <span class="input-group-btn">
                                                            <input type="submit"  value="Answer" class="btn btn-success" data-disable-with="Search">
                                                        </span> 
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @else
                                        <p class="font-italic text-sm-center ">{{$a->answer}}</p>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="poll" class=" tab-pane fade">
                <br>
                <div class="row col-md-12">
                    <div class="col-md-6">
                        <button data-toggle="modal" data-target="#polling" type="button" class="btn btn-outline-primary float-sm-left">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                            Create Poll
                        </button>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
                <div id="main">
                    <div class="card-deck">
                        <div class="card card-bg2 padding-card col-sm-6" >
                            <h2>Poll List</h2>
                            <hr>
                            <div id="polling_standby" class="card padding-manual scroll">
                                @foreach($polling_standby as $stand)
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <h4><strong>{{$stand->title_polling}}</strong></h4>
                                                <p>{{$stand->type_polling}}</p>
                                            </div>
                                            <div class="col-md-1">
                                                <a href="activate.html"><i class="fa fa-play"></i></a>
                                            </div>
                                            <div class="col-md-1">
                                                <a href="result.html"><i class="fa fa-lock"></i></a>
                                            </div>
                                            <div class="col-md-1">
                                                <a href="result.html"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @if($stand->type_polling == "multiple")
                                        <ul class="list-styled">
                                        @foreach($stand->MultipleModel as $li)
                                            <li>{{$li->multiple_choice}}</li>
                                        @endforeach
                                        </ul> 
                                        @elseif ($stand->type_polling == "rating")
                                        <div class="stars">
                                            <label class="star star-5" for="star-5"></label>
                                            <label class="star star-4" for="star-4"></label>
                                            <label class="star star-3" for="star-3"></label>
                                            <label class="star star-2" for="star-2"></label>
                                            <label class="star star-1" for="star-1"></label>
                                        </div>
                                        @else
                                        <div class="text-center">
                                            <hr style="width: 50%;">
                                            <h4>There's is No Polling Active</h4>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <br> 
                             @endforeach
                            </div>
                        </div>
                        <div class="card card-bg2 padding-card col-sm-6" >
                            <h2>Result</h2>
                            <hr>
                            <div id="polling_standby" class="card padding-manual scroll">
                                @if($polling_result->count() > 0 )
                                @foreach($polling_result as $pr )
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="col-md-9 text-left">
                                                <h4><strong>{{$pr->title_polling}}</strong></h4>
                                                <p>{{$pr->type_polling}}</p>
                                        </div>
                                       
                                            <div class="h4 col-sm-12 text-left">
                                                A.&nbsp;
                                            </div> 
                                            <div class="progress col-sm-12" style="height:20px;">
                                                <div class="progress-bar" style="width:70%;height:20px;"> 70</div>
                                            </div>
                                        <br>
                                            <div class="h4 col-sm-12 text-left">
                                                B.&nbsp;
                                            </div> 
                                            <div class="progress col-sm-12" style="height:20px;">
                                                <div class="progress-bar" style="width:70%;height:20px;"> 70</div>
                                            </div>
                                        <br>
                                            <div class="h4 col-sm-12 text-left">
                                                C.&nbsp;
                                            </div> 
                                            <div class="progress col-sm-12" style="height:20px;">
                                                <div class="progress-bar" style="width:70%;height:20px;"> 70</div>
                                            </div>
                                        <br>
                                            <div class="h4 col-sm-12 text-left">
                                                D.&nbsp;
                                            </div> 
                                            <div class="progress col-sm-12" style="height:20px;">
                                                <div class="progress-bar" style="width:70%;height:20px;"> 70</div>
                                            </div>

                                    </div>
                                </div>
                                <br> 
                                @endforeach
                                @else
                                <div class="text-center">
                                    <hr style="width: 50%;">
                                    <h4>There's is No Polling Active</h4>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="sum" class="tab-pane fade"><br>
                <div class="row col-md-12">
                    <div class="col-md-6">
                        <button data-toggle="modal" data-target="#polling" type="button" class="btn btn-outline-primary float-sm-left">Create Poll</button>
                    </div>
                    <div class="col-md-6">
                        <a href="/out">
                            <button class="btn btn-outline-danger float-sm-right">
                                End Event
                            </button>
                        </a>
                    </div>
                </div>
                <div id="main">
                    
                </div>
            </div> 
        </div>
    
        <!-- Tab panes -->
        <div clas="container">
            <div class="modal" id="update" style="padding-top: 0px;" >
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
                                    <label> Event Name </label>
                                    <input type="text" class="form-control" name="event" value="{{$ev->name_event}}" required="required">
                                    @if($errors->has('event'))
                                    <div class="text-danger">
                                        {{ $errors->first('event')}}
                                    </div>
                                    @endif
                                </div>
                                <!--form name date-->
                                <label> Date </label>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <input type="date" class="form-control" id="date" name="date" value="{{$ev->date_event}}"required="required" >
                                        @if($errors->has('date'))
                                        <div class="text-danger">
                                            {{ $errors->first('date')}}
                                        </div>
                                        @endif
                                    </div>
                                    <!--form name time-->
                                    <label> at : </label>
                                    <div class="col-md-5" style="padding-right: 50px;">
                                        <input type="time" class="form-control" name="time" value="{{$ev->time_event}}"required="required">
                                        @if($errors->has('location'))
                                        <div class="text-danger">
                                            {{ $errors->first('location')}}
                                        </div>
                                        @endif
                                    </div>

                                </div>

                                <!--form location event-->
                                <div class="form-group">
                                    <label> Place </label>
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
                                    <label> Event Code </label>
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

            <div id="polling" class="modal">
                <div class="modal-content col-md-6" >
                    <div class="modal-header">
                        <div class="col-md-9">
                            <h3>Create Polling</h3>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn close-modal float-sm-right" data-dismiss="modal">&times;</button>
                        </div>
                        <hr>
                    </div>
                    <br>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label> Select poll type : </label>
                            </div>
                            <div class="col-md-5">
                                <select class="form-control" name="type" onchange="showDiv(this.value)">
                                    <option value="no">Select Polling</option>
                                    <option value="rating">Rating</option>
                                    <option value="multiple">Multiple Choice</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div id="form-no">
                            
                        </div>
                        <div id="form-rating" style="display:none">
                            <form class="form-group" method="POST" action="{{route('polling.store')}}">
                                {{ csrf_field() }}
                                 <input type="hidden" name="type" value="rating">
                                 <input class="form-control" name ="title" type="text" placeholder="What would you give to rate today?" required="required">
                                <div class="padding-card">
                                    <h5> Maximal 5 Stars </h5>
                                    <div class="stars">
                                            <input class="star star-5" checked="checked" id="star-5" type="radio" name="star5"/>
                                            <label class="star star-5" for="star-5"></label>
                                            <input class="star star-4" id="star-4" type="radio" name="star"/>
                                            <label class="star star-4" for="star-4"></label>
                                            <input class="star star-3" id="star-3" type="radio" name="star"/>
                                            <label class="star star-3" for="star-3"></label>
                                            <input class="star star-2" id="star-2" type="radio" name="star"/>
                                            <label class="star star-2" for="star-2"></label>
                                            <input class="star star-1" id="star-1" type="radio" name="star"/>
                                            <label class="star star-1" for="star-1"></label>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-primary float-sm-right" type="submit">Create Rate</button>
                            </form>
                        </div>
                        <div id="form-multiple" style="display:none">
                            <form class="form-inline" method="POST" action="{{route('polling.store')}}">
                                {{ csrf_field() }}
                                <input type="hidden" name="type" value="multiple">
                                <input class="form-control pad-mul col-sm-12" name="title" type="text" placeholder="What would you send choice today?">
                                <br>
                                <div class="form-group pad-mul col-sm-12" >
                                    <label>A.&nbsp;</label>
                                    <input type="text" name="A" class=" form-control" placeholder="Choice name 1" required="required" >
                                </div>
                                <div class="form-group pad-mul col-sm-12">
                                    <label>B.&nbsp;</label>
                                    <input type="text" name="B" class=" form-control" placeholder="Choice name 2" required="required" >
                                </div>
                                <div class="form-group pad-mul col-sm-12">
                                    <label>C.&nbsp;</label>
                                    <input type="text" name="C" class=" form-control" placeholder="Choice name 3" >
                                </div>
                                <div class="form-group pad-mul col-sm-12">
                                    <label>D.&nbsp;</label>
                                    <input type="text" name="D" class=" form-control" placeholder="Choice name 4" >
                                </div>
                                <div class="form-group col-sm-8">
                                </div>
                                <div class="form-group col-sm-4">
                                <button class="btn btn-primary float-sm-right" type="submit">Create choice</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        $('#Sheet a').click(function(e) {
          e.preventDefault();
          $(this).tab('show');
        });

        // store the currently selected tab in the hash value
        $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
          var id = $(e.target).attr("href").substr(1);
          window.location.hash = id;
        });

        // on load of the page: switch to the currently selected tab
        var hash = window.location.hash;
        $('#Sheet a[href="' + hash + '"]').tab('show');

        function showDiv(id){
            var idv = "form-"+id;
            document.getElementById('form-no').style.display = 'none';
            document.getElementById('form-rating').style.display = 'none';
            document.getElementById('form-multiple').style.display = 'none';
            document.getElementById(idv).style.display = 'block';
        }
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