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
        <!-- Icon tab sinar browser -->
        <link rel="shortcut icon" href="asset/img/Logo/Tanya-icon.png" type="image/x-icon">
        <title>TANYA | Badan Pemeriksa Keuangan Republik Indonesia</title>
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
            $('#polling_result').load('{{route('polling.show',session()->get('event'))}}').fadeIn("slow");
            $('#summary').load('{{route('event.show',session()->get('event'))}}').fadeIn("slow");
        }, 5000);
        
         $(window).on('load', function(){ 
             $(".se-pre-con").fadeOut("slow");
         });
            
        </script>
        
        
    </head>  
    <body class="bg-color">  
        <nav class="navbar navbar-dark navbar-expand-md bg-info justify-content-between">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-nav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse w-50 order-1 order-sm-0 dual-nav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <div class="row text-white">
                              <div class="navbar-header ">
                                    <img src="asset/img/Logo/Tanya-icon.png" style="height: 3.0rem;">
                              </div>  
                                <h1><strong>TANYA</strong></h1>
                            </div>
                        </li>
                    </ul>
                </div>
                <a data-toggle="modal" data-target="#update" class=" mx-auto text-center text-white order-0 order-sm-1 size-roll">
                    @foreach ($event as $ev)
                    <h5><b>{{$ev->name_event}}</b></h5>
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
                <a class="nav-link active"  data-toggle="tab" href="#quest"><strong> QUESTION</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  data-toggle="tab" href="#poll"><strong>POLLING</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  data-toggle="tab" href="#sum"><STRONG>SUMMARY</strong></a>
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
                        <span class=" btn btn-info bg-info" onclick="openNav()"><i class="fa fa-users" aria-hidden="true"></i>  Create Speaker's</span>
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
                        <a href="/out">
                        <button  class="btn btn-outline-danger float-sm-right">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                            End Event
                        </button>
                        </a>
                    </div>
                </div>
                <div id="main">
                    <div class="card-deck">
                        <div class="card card-bg2 padding-card col-sm-6" >
                            <div class ="row">
                                <div class="col-md-5">
                                    <h2>Question List</h2>
                                </div>
                                <div class="col-md-4">
                                    <a href="">
                                        <button class="btn btn-warning float-sm-right">
                                             Need Approve
                                        </button>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="/approveall/{{session()->get('event')}}">
                                        <button class="btn btn-success">
                                            Approve All
                                        </button>
                                    </a>
                                </div>
                                
                                
                            </div>
                            <br>
                            <div id="show_question" class="card padding-manual scroll">
                                <div class="justify-content-center">
                                <div class="loader"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-bg3 padding-card col-sm-6">
                            <h2>Question Approve</h2>
                            <hr>
                            <div class="card padding-manual scroll">
                                
                                @if($question_approve->count() > 0)
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
                                        <div class="col-md-12">
                                                <a href="#">
                                                    <button data-toggle="modal" data-target="#edit{{$a->idQuestion}}" type="button" class="btn btn-success float-sm-right">
                                                        <i class="fa fa-comment"></i> Answer
                                                    </button>
                                                </a>
                                        </div>
                                        @else
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="font-italic text-sm-center ">{{$a->answer}}</p>
                                            </div>
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-5">
                                                <a href="#">
                                                    <button data-toggle="modal" data-target="#edit{{$a->idQuestion}}" type="button" class="btn btn-info float-sm-right">
                                                        <i class="fa fa-check"></i> Edit Answer
                                                    </button>
                                                </a>
                                            </div>
                                            <div class="col-md-1">
                                                <a href="/remove_ans/{{$a->idQuestion}}">
                                                    <button class="btn btn-danger float-sm-right">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                @endforeach
                                @else
                                <div class="text-center">
                                    <hr style="width: 50%;">
                                    <h4>There's is No Question Show</h4>
                                    <hr style="width: 50%;">
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="poll" class=" tab-pane fade">
                <br>
                <div class="row col-md-12">
                    <div class="col-md-4">
                        <button data-toggle="modal" data-target="#polling" type="button" class="btn btn-info bg-info float-sm-left">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                            Create Poll
                        </button>
                    </div>
                    <div class="col-sm-4">
                        @if ($message = Session::get('warning'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <a href="/out">
                        <button  class="btn btn-outline-danger float-sm-right">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                            End Event
                        </button>
                        </a>
                    </div>
                </div>
                <div id="main">
                    <div class="card-deck">
                        <div class="card card-bg2 padding-card col-sm-6" >
                            <h2>Poll List</h2>
                            <hr>
                            <div class="card padding-manual scroll">
                                @if($polling_ready->count() > 0)
                                @foreach($polling_ready as $stand)
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <h5>{{$stand->title_polling}}</h5>
                                                <hr>
                                                <p class="text-muted">{{$stand->type_polling}}</p>
                                            </div>
                                            @if($stand->status_polling == 0)
                                            <div class="col-md-1">
                                                <div class="tooltip">
                                                    <a href="/show/{{$stand->idPolling}}"><i class="fa fa-play fa-size" ></i></a>
                                                </div> 
                                            </div>
                                            <div class="col-md-1">
                                                <div class="tooltip">
                                                    <a href="#Poll"><i class="fa fa-lock fa-size" ></i></a>
                                                    <span class="tooltiptext"> Polling not active!</span>
                                                </div> 
                                            </div>
                                            <div class="col-md-1">
                                               <div class="tooltip">
                                                   <a href="/delete/{{$stand->idPolling}}"><i class="fa fa-trash fa-size" ></i></a>
                                               </div> 
                                            </div>
                                            @elseif($stand->status_polling == 1)
                                            <div class="col-md-1">
                                                <div class="tooltip">
                                                    <a href="#Poll"><i class="fa fa-check fa-size" ></i></a>
                                                    <span class="tooltiptext"> Polling was active!</span>
                                                </div> 
                                            </div>
                                            <div class="col-md-1">
                                                <div class="tooltip">
                                                    <a href="/stop/{{$stand->idPolling}}"><i class="fa fa-lock fa-size" ></i></a>
                                                </div> 
                                            </div>
                                            <div class="col-md-1">
                                               <div class="tooltip">
                                                   <a href="#Poll"><i class="fa fa-trash fa-size" ></i></a>
                                                   <span class="tooltiptext"> Stop before Delete!</span>
                                               </div> 
                                            </div>
                                            @else
                                            <div class="col-md-1">
                                                <div class="tooltip">
                                                    <a href="#Poll"><i class="fa fa-check fa-check fa-size" ></i></a>
                                                    <span class="tooltiptext"> Polling has ben held!</span>
                                                </div> 
                                            </div>
                                            <div class="col-md-1">
                                                <div class="tooltip">
                                                    <a href="#Poll"><i class="fa fa-lock fa-size" ></i></a>
                                                    <span class="tooltiptext"> Polling has ben stop!</span>
                                                </div> 
                                            </div>
                                            <div class="col-md-1">
                                               <div class="tooltip">
                                                   <a  href="/delete/{{$stand->idPolling}}"><i class="fa fa-trash fa-size" ></i></a>
                                                </div> 
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @if($stand->type_polling == "Multiple")
                                        <ul class="list-styled">
                                        @foreach($stand->MultipleModel as $li)
                                            <li>{{$li->multiple_choice}}</li>
                                        @endforeach
                                        </ul> 
                                        @else
                                        <div class="stars">
                                            <label class="star star-5" for="star-5"></label>
                                            <label class="star star-4" for="star-4"></label>
                                            <label class="star star-3" for="star-3"></label>
                                            <label class="star star-2" for="star-2"></label>
                                            <label class="star star-1" for="star-1"></label>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <br> 
                                @endforeach
                                @else
                                <div class="text-center">
                                    <hr style="width: 50%;">
                                    <h4>No Polling be Ready</h4>
                                     <hr style="width: 50%;">
                                </div>
                                @endif
                                
                            </div>
                        </div>
                        <div class="card card-bg2 padding-card col-sm-6" >
                            <h2>Result</h2>
                            <hr>
                            <div id="polling_result" class="card padding-manual scroll">
                                @if($polling_result->count() > 0 )
                                <div class="justify-content-center">
                                <div class="loader"></div>
                                </div>
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
                        <!--<a href="/download/{{$ev->idEvent}}">-->
                        <button data-toggle="modal" type="button" class="btn btn-info bg-info float-sm-left">Download Summary</button>
                        </a>
                    </div>
                </div>
                <div id="main">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card padding-card">
                                    @php
                                        $countall = 0;
                                    @endphp
                                    @foreach($ev->AdminModel as $count_admin)
                                        @php
                                            $countall += count($count_admin->Name_Admin);
                                        @endphp
                                    @endforeach
                                    
                                    @foreach($ev->User_has_EventModel as $count_user)
                                        @php
                                             $countall += count($count_user->User_NIP);
                                        @endphp
                                    @endforeach
                                    <div class="row head">
                                        <div class="col-md-2">
                                            <i class="fa fa-users fa-2x"></i>  
                                        </div>
                                        <div class="col-md-6">
                                            <h4>Active User</h4>          
                                        </div>
                                        <div class="col-md-4">
                                            <span class="number"> {{$countall}}</span>
                                        </div>
                                    </div>
                                    <hr>
                                    @foreach($ev->AdminModel as $admin)
                                    <div class="row">
                                        <div class="col-md-2">
                                            <span class="question-user">
                                                <i class="fa fa-user-circle fa-2x"></i>
                                            </span>
                                        </div>
                                        <div class="col-md-6">
                                            <span>{{$admin->Name_Admin}} </span>
                                        </div>
                                        <div class="col-md-4">
                                            <span>Admin</span>
                                        </div>
                                    </div>
                                    <hr>
                                    @endforeach
                                    @foreach($used as $user)
                                    <div class="row">
                                        <div class="col-md-2">
                                            <span class="question-user">
                                                <i class="fa fa-user-circle fa-2x"></i>
                                            </span>
                                        </div>
                                        <div class="col-md-6">
                                            <span>{{$user->User->name}} </span>
                                        </div>
                                        <div class="col-md-4">
                                            <span>User</span>
                                        </div>
                                    </div>
                                   @endforeach
                                </div>
                            </div>
                            <br>
                            <div class="col-md-8">
                                <div id="summary">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card padding-card">
                                                <div class="row head">
                                                    <div class="col-md-2">
                                                        <i class="fa fa-comment fa-2x"></i>  
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h4>Question</h4>          
                                                    </div>
                                                    <div class="col-md-4">

                                                        <span class="number float-sm-right">0</span>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="body-content">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <span class ="fa fa-thumbs-o-up"></span>
                                                            Like
                                                        </div>
                                                        <div class="col-md-8">
                                                            <span class="float-sm-right">0</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <span class ="fa fa-thumbs-o-down"></span>
                                                            Dislike
                                                        </div>
                                                        <div class="col-md-8">
                                                            <span class="float-sm-right">0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="card padding-card">
                                                <div class="row head">
                                                    <div class="col-md-2">
                                                        <i class="fa fa-bar-chart fa-2x"></i>  
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h4>Polling</h4>          
                                                    </div>
                                                    <div class="col-md-4">
                                                        <span class="number float-md-right">0</span>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="body-content">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <span class ="fa fa-sitemap"></span>
                                                            Poll Votes
                                                        </div>
                                                        <div class="col-md-7">
                                                            <span class="float-sm-right">0</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <span class ="fa fa-check-square-o"></span>
                                                            Votes per Poll
                                                        </div>
                                                        <div class="col-md-7">
                                                            <span class="float-sm-right">0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>    
                                </div>
                                <div class="col-md-12">
                                    <h3>Polling Result</h3>
                                    <div id="card-polling" class="card">
                                       
                                        <div class="row">
                                            <div class="tab">
                                                
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach($summary_poll as $poll_view)
                                                @php
                                                    $i++;
                                                @endphp
                                                @if($i == 1)
                                                    <button class="tablinks" onclick="openPoll(event, '{{$poll_view->idPolling}}')"  id="defaultOpen">{{$poll_view->title_polling}}</button>
                                                @else
                                                    <button class="tablinks" onclick="openPoll(event, '{{$poll_view->idPolling}}')">{{$poll_view->title_polling}}</button>
                                                @endif
                                            @endforeach
                                            </div>
                                            
                                            @foreach($summary_poll as $poll_view)
                                            <div id="{{$poll_view->idPolling}}" class="tabcontent scroll">
                                                <h3>{{$poll_view->title_polling}}</h3>
                                                <hr>
                                                @if($poll_view->type_polling === "Multiple")
                                                    @foreach($poll_view->MultipleModel as $show_multiple)
                                                    <div class="h4 col-sm-12 text-left">
                                                        {{$show_multiple->multiple_choice}}
                                                    </div> 
                                                    <!-- Variabel $n_choice_multi from controller C_Polling-->
                                                    <div class="progress col-sm-12" style="height:20px;">
                                                        <div class="progress-bar progress-bar-striped" 
                                                             style="width:{{$show_multiple->total_multiple_choice}}%;height:20px;">{{$show_multiple->total_multiple_choice}}</div>
                                                    </div>
                                                    <br>
                                                    @endforeach
                                                @else
                                                    @foreach($poll_view->RatingModel as $show_rating)
                                                    <div class="h4 col-sm-12 text-left">
                                                        @if($show_rating->rating === 5)
                                                        <input class="star star-4" checked="checked" type="radio">
                                                        <label class="star star-5" for="star-5"></label>
                                                        <label class="star star-4" for="star-4"></label>
                                                        <label class="star star-3" for="star-3"></label>
                                                        <label class="star star-2" for="star-2"></label>
                                                        <label class="star star-1" for="star-1"></label>
                                                        @elseif($show_rating->rating === 4)
                                                        <input class="star star-4" checked="checked" type="radio">
                                                        <label class="star star-4" for="star-4"></label>
                                                        <label class="star star-3" for="star-3"></label>
                                                        <label class="star star-2" for="star-2"></label>
                                                        <label class="star star-1" for="star-1"></label>
                                                        @elseif($show_rating->rating === 3)
                                                        <input class="star star-3" checked="checked" type="radio">
                                                        <label class="star star-3" for="star-3"></label>
                                                        <label class="star star-2" for="star-2"></label>
                                                        <label class="star star-1" for="star-1"></label>
                                                        @elseif($show_rating->rating === 2)
                                                        <input class="star star-3" checked="checked" type="radio">
                                                        <label class="star star-2" for="star-2"></label>
                                                        <label class="star star-1" for="star-1"></label>
                                                        @else
                                                        <input class="star star-3" checked="checked" type="radio">
                                                        <label class="star star-1" for="star-1"></label>
                                                        @endif
                                                    </div>
                                                    <div class="h4 col-sm-12 text-left">
                                                        {{$show_rating->rating}}&nbsp;Star
                                                    </div>
                                                    <!-- Variabel $n_choice_rate from controller C_Polling-->
                                                    <div class="progress col-sm-12" style="height:20px;">
                                                        <div class="progress-bar progress-bar-striped" style="width:{{$show_rating->total_rating}}%;height:20px;"> {{$show_rating->total_rating}}</div>
                                                    </div>
                                                    <br>
                                                    @endforeach                 
                                                <!--end views-->
                                                @endif


                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                 </div>
            </div> 
        </div>
    
        <!-- Modal panes -->
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
            
            @foreach($question_approve as $a)
            <div id="edit{{$a->idQuestion}}" class="modal">
                <div class="modal-content col-md-6">
                    <div class="modal-header">
                        @if($a->answer === "Not Answered")
                        <div class="col-md-9">
                            <h3>Answer Question</h3>
                        </div>
                        @else
                        <div class="col-md-9">
                            <h3>Edit Answer</h3>
                        </div>
                        @endif
                        
                        <div class="col-md-3">
                            <button type="button" class="btn close-modal float-sm-right" data-dismiss="modal">&times;</button>
                        </div>
                        <hr>
                    </div>
                    <br>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="text-muted text-center font-italic">Question</div>
                             <hr style="width: 50%;">
                            <h5 class="text-sm-center "><strong>{{$a->question}}</strong></h5>
                             <hr style="width: 50%;">
                        </div>
                        <div class="col-md-12">
                            <form action="{{route('question.update',$a->idQuestion)}}" method="POST">
                                {{ method_field('PATCH') }}
                                {{ csrf_field() }}
                                <div class="input-group">
                                    <textarea class="form-control" rows="4" name="answer" placeholder="{{$a->answer}}" required="required"></textarea>
                                    @if($errors->has('answer'))
                                    <div class="text-danger">
                                        {{ $errors->first('event')}}
                                    </div>
                                    @endif
                                </div>
                                <br>
                                <div class="col-md-12 float-sm-right">
                                    @if($a->answer === "Not Answered")
                                    <span class="input-group-btn float-sm-right">
                                        <input type="submit"  value="Send Answer" class="btn btn-info">
                                    </span> 
                                    @else
                                    <span class="input-group-btn float-sm-right">
                                        <input type="submit"  value="Edit Answer" class="btn btn-info">
                                    </span> 
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
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
                                    <option value="Rating">Rating</option>
                                    <option value="Multiple">Multiple Choice</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div id="form-no">
                        <!--as none-->    
                        </div>
                        <div id="form-Rating" style="display:none">
                            <form class="form-group" method="POST" action="{{route('polling.store')}}">
                                {{ csrf_field() }}
                                 <input type="hidden" name="type" value="Rating">
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
                        <div id="form-Multiple" style="display:none">
                            <form class="form-inline" method="POST" action="{{route('polling.store')}}">
                                {{ csrf_field() }}
                                <input type="hidden" name="type" value="Multiple">
                                <input class="form-control pad-mul col-sm-12" name="title" type="text" placeholder="What would you send choice today?" required="required">
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
        
    </body>
    <script>
        $('a[data-toggle="tab"]').click(function (e) {
            e.preventDefault();
               $(this).tab('show');
        });

        $('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
                var id = $(e.target).attr("href");
                localStorage.setItem('Sheet', id)
        });

        var selectedTab = localStorage.getItem('Sheet');
        if (selectedTab != null) {
            $('a[data-toggle="tab"][href="' + selectedTab + '"]').tab('show');
        }
        
        function openPoll(evt, Pollid) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
              tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
              tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(Pollid).style.display = "block";
            evt.currentTarget.className += " active";
        }
        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
      
      
        
        
        function showDiv(id){
            var idv = "form-"+id;
            document.getElementById('form-no').style.display = 'none';
            document.getElementById('form-Rating').style.display = 'none';
            document.getElementById('form-Multiple').style.display = 'none';
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
        };
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
            };
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
                };
            }
        }
        
    </script>
</html>