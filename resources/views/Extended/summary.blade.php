@php
    $count_question = 0;
    $count_like = 0;
    $count_dislike = 0;   
@endphp
<!--Count for Question-->
 @foreach($question as $q)
    @php
        $count_question += count($q->question);
    @endphp
 @endforeach
 <!--Count for Like, Dislike-->
 @foreach($question as $count)
    @php
        $count_like += $count->reaction_like;
        $count_dislike += $count->reaction_dislike;
    @endphp
 @endforeach

 <!------->
 
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
                    
                    <span class="number float-sm-right"> {{$count_question}}</span>
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
                        <span class="float-sm-right">{{$count_like}}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <span class ="fa fa-thumbs-o-down"></span>
                        Dislike
                    </div>
                    <div class="col-md-8">
                        <span class="float-sm-right">{{$count_dislike}}</span>
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
                    <span class="number float-md-right"> 12</span>
                </div>
            </div>
            <hr>
            <div class="body-content">
                <div class="row">
                    <div class="col-md-4">
                        <span class ="fa fa-thumbs-o-up"></span>
                        Poll Votes
                    </div>
                    <div class="col-md-8">
                        <span class="float-sm-right">19</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <span class ="fa fa-thumbs-o-down"></span>
                        Votes per Poll
                    </div>
                    <div class="col-md-7">
                        <span class="float-sm-right">19</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
    