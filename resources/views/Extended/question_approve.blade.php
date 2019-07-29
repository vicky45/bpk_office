@foreach( $question_approve as $all)
<div class="card padding-card   ">
    <div class="row">
        <div class="col-sm-8" style="text-align: left;">
            <i class="fa fa-user-circle"></i>
            <span> {{$all->user->name}}</span>
        </div>
        <div id="like" class="col-sm-4" style="text-align:right">
            <!--<small class="text-muted"><b>Kategori </b></small>-->
            <a class="float-sm-right" href="#" style="text-decoration:none"><i class="fa fa-thumbs-o-up"></i><span> <b>15&emsp;</b> </span></a>
            <a class="float-sm-right" href="#" style="text-decoration:none"><i class="fa fa-thumbs-o-down"></i><span> <b>10&emsp;</b> </span></a>

        </div>
    </div>
    <hr>
    <p>{{$all ->question}}</p>
</div>
<br>
@endforeach