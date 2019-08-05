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
                <a href="/remove/{{($v->idQuestion)}}">
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
    <hr style="width: 50%;">
    <h4>There's is No Question</h4>
    <hr style="width: 50%;">
</div>
@endif