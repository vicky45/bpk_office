@foreach( $question_approve as $all)
<div class="card padding-card   ">
    <div class="row">
        <div class="col-sm-8" style="text-align: left;">
            <i class="fa fa-user-circle"></i>
            <span> {{$all->user->name}}</span>
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