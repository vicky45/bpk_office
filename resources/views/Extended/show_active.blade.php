@foreach( $question_validate as $v)
<div class="card">
    <div class="card-header-answer">
        <div class="row col-md-12">
            <div class="col-md-5">
                <img src="asset/img/Logo/user.jpg" alt="Avatar" class="avatar">
                <b>{{$v->user->name}}</b>
            </div>
            <!--aprove-->
            <div class="col-md-5">
                <a href="/approve/{{($v->idQuestion)}}">
                    <button class="btn btn-success float-sm-right">
                        <i class="fa fa-check"></i> Approve
                    </button>
                </a>
            </div>
            <!--button delete-->
            <div class="col-md-2">
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
        <a class="float-sm-right" href="#" style="color:red;"><i class="fa fa-thumbs-o-down"></i><span> <b>10&emsp;</b> </span></a>
        <a class="float-sm-right" href="#" style="color:green;" ><i class="fa fa-thumbs-o-up"></i><span> <b>15&emsp;</b> </span></a>
    </div>
</div>
<br>
@endforeach