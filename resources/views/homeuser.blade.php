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
        <title>TANJA | Badan Pemeriksa Keuangan Republik Indonesia</title>
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
            $('#show_question').load('{{route('question.show',session()->get('event'))}}').fadeIn("slow");
            $('#polling').load('/showpoll/{{session()->get('event')}}').fadeIn("slow");
        }, 2000);
        </script>

    </head>
    <body class="bg-color"> 
        <nav class="navbar navbar-dark navbar-expand-md bg-warning justify-content-between">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-nav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse w-50 order-1 order-sm-0">
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
                <a  class=" mx-auto text-center text-dark order-0 order-sm-1 size-roll">
                    @foreach ($event as $ev)
                    <h5><b>{{$ev->name_event}}</b></h5>
                    <h6>{{$ev->date_event}}</h6>
                    <h6>{{$ev->location}}</h6> 
                    <h6>#{{$ev->code_event}}</h6> 
                    @endforeach
                </a>
                <div class="navbar-collapse collapse w-50 order-sm-2">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link">
                            </a>
                            <div class="dropdown">
                                <button onclick="myFunction()" class="dropbtnhdr">
                                    <div class="containeruser">
                                        <img src="asset/img/Logo/user.jpg" alt="Avatar" class="imageuser">
                                        <div class="overlay">User</div>
                                    </div>
                                </button>

                                <div id="myDropdown" class="dropdown-content dual-nav">
                                    <span class="dropdown-item-text"><b>{{ Auth::user()->name }}</b></span>
                                    <div class="dropdown-divider"></div>
                                    <a class="text-decoration-none" href="/out">Log Out</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="navbar collapse  dual-nav col-sm-12">

                    <button type="button" class="btn btn-secondary btn-block">
                        <a href="/out" style="color: white;">
                            <i class="fa fa-toggle-off"></i>&nbsp;Switch Event
                        </a>
                    </button>    
                </div>
            </div>
        </nav>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs justify-content-center" id="Sheet" role="tablist">
            <li class="nav-item">
                <a class="a-shet nav-link active" data-toggle="tab" href="#quest"><i class="fa fa-question-circle"></i>&nbsp;<b>Question</b></a>
            </li>
            <li class="nav-item">
                <a class=" a-shet nav-link" data-toggle="tab" href="#poll"><i class="fa fa-check-square"></i>&nbsp;<b>Polling</b></a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content sheet-color">
            <div id="quest" class=" tab-pane active"><br>
                <div class="content sheet-color">
                    <div class="card padding-card" style="background-color:#fbfbfb;">
                        <div class="col-sm-12">
                            <div class="row">
                                <h5><strong>Your Question</strong></h5>
                                <div class="col-sm-12">
                                    <button type="button" id="myBtn" class="btn btn-info float-right">
                                        <i class="fa fa-question-circle-o"></i>&nbsp; Ask Now</button>
                                </div>
                            </div>
                            <br>
                        </div>

                        <div class="card col-sm-12 scroll">
                            <div class="col-sm-12 text-center">
                                <hr style="width: 50%">
                            </div>
                            @foreach($questme as $quest)
                            <div class="row">
                                <div class="col-sm-12">
                                    <span><i> {{$quest->question}}</i></span>
                                    <hr style="width: 50%">
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12 sheet-color">
                        <div class="row">
                            <h5><strong>All Question</strong></h5>
                        </div>
                        <br>
                    </div>
                    <!--All Question-->
                    <div class="card "style="background-color:#fbfbfb;">
                        <div id="show_question" class="col-sm-12 padding-card scroll">
                            
                        </div>
                    </div>
                </div>
            </div>

            <div id="poll" class=" tab-pane fade"><br>
                <div class="col-sm-12" align="center">
                    <div id="polling" class="card padding-card scroll">
                        
                    </div>
                </div>
            </div>
        </div>
           
    <!-- Tab panes -->
    <div clas="container">
        <div class="modal" id="myModal" style="padding-top: 0px;" >
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Ask the Speaker</h4>
                        <button type="button" class="btn close-modal" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form class="form-group" method="POST" action="{{ route('question.store')}}">
                            {{ csrf_field() }}
                            <input type="text" class="form-control" name="ask" placeholder="What would you ask?" required="required"></input>
                            <label></label>
                            <select class="form-control" name="speak">
                                <option>--Select Speaker--</option>
                                @foreach ($ev->SpeakerModel as $speak)
                                <option>{{$speak->name_speaker}}</option>
                                @endforeach
                            </select>
                            <hr>
                            <button type="submit" class="btn btn-primary">Send</button>
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
    
    function reactionL() {
    var x = document.getElementById("tumbsUP");
    x.disabled = true;
    }
    
    function reactionD() {
    var x = document.getElementById("tumbsDWN");
    x.disabled = true;
    var y = document.getElementById("tumbsUP");
    y.disabled = false;
    }
    
    
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }
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
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close-modal")[0];
    btn.onclick = function () {
        modal.style.display = "block";
    }
    span.onclick = function () {
        modal.style.display = "none";
    }
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    var close = document.getElementsByClassName("close");
    var i;
    for (i = 0; i < close.length; i++) {
        close[i].onclick = function () {
            var div = this.parentElement;
            div.style.display = "none";
        }
    }




</script>
</html>