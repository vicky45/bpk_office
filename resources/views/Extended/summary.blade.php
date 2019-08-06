@php
    $count_question = 0;
    $count_like = 0;
    $count_dislike = 0;
    $poll_was_held = 0;
    $poll_votes = 0;
    $votes_per_poll = 0;
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
 <!---Polling Count---->
 @foreach($polling as $count_poll)
    @php
        $poll_was_held += count($count_poll->idPolling);
    @endphp 
 @endforeach

 @foreach($count_poll->MultipleModel as $allmulti)
    @php
        $poll_votes += $allmulti->total_multiple_choice;
    @endphp
 @endforeach

 @foreach($count_poll->RatingModel as $allrate)
    @php
        $poll_votes += $allrate->total_rating;
    @endphp
 @endforeach
        @php
            $votes_per_poll = $poll_votes;
        @endphp
 @if($poll_was_held > 1)
        @php
            $votes_per_poll = $poll_votes/$poll_was_held;
        @endphp
 @endif
 
 
 
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
                    <span class="number float-md-right"> {{$poll_was_held}}</span>
                </div>
            </div>
            <hr>
            <div class="body-content">
                <div class="row">
                    <div class="col-md-4">
                        <span class ="fa fa-sitemap"></span>
                        Poll Votes
                    </div>
                    <div class="col-md-8">
                        <span class="float-sm-right">{{$poll_votes}}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <span class ="fa fa-check-square-o"></span>
                        Votes per Poll
                    </div>
                    <div class="col-md-7">
                        <span class="float-sm-right">{{$votes_per_poll}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
    