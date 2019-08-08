@if($polling_show->count() > 0)
@foreach($polling_show as $poll)
<div class="card padding-card" align="left">
    <strong>{{$poll->title_polling}}</strong>
    <hr>
    <form class="form-group" action="/submit/{{$poll->idPolling}}">
        @foreach($poll->MultipleModel as $multi)
        <label class="container">
            <div class="radio">
            <input type="radio" name="choice" value="{{$multi->multiple_choice}}">&nbsp;{{$multi->multiple_choice}}
            </div>
        </label>
        @endforeach
        <button type="submit" class="btn btn-warning float-sm-right">Send</button>  
    </form>
</div>
<br>
@endforeach
@else
<div class="text-center">
    <hr style="width: 50%;">
    <h4>There's is No Polling Active</h4>
    <hr style="width: 50%;">
</div>
@endif