@foreach( $question_approve as $all)
<div class="card padding-card   ">
    <div class="row">
        <div class="col-sm-8" style="text-align: left;">
            <i class="fa fa-user-circle"></i>
            <span> {{$all->user->name}}</span>
        </div>
        <div id="like" class="col-sm-4" style="text-align:right">
            <!--<small class="text-muted"><b>Kategori </b></small>-->
            <button class="btn">
                <a class="float-sm-right" id="tumbsUP" onclick="reactionL()" href="/like/{{$all->idQuestion}}" style="text-decoration:none"><i class="fa fa-thumbs-o-up"></i><span> <b>{{$all->reaction_like}}&emsp;</b> </span></a>
            </button>
            <button class="btn" id>
            <a class="float-sm-right" href="/dislike/{{$all->idQuestion}}" style="text-decoration:none"><i class="fa fa-thumbs-o-down"></i><span> <b>{{$all->reaction_dislike}}&emsp;</b> </span></a>
            </button>
        </div>
    </div>
    <hr>
    <p>{{$all ->question}}</p>
    <div class="col-sm-12">
         <p class="text-muted text-center">"{{$all->answer}}"</p>
    </div>
</div>
<br>
@endforeach