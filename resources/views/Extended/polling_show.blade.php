@if($polling_show->count() > 0)
@foreach($polling_show as $poll)
<div class="card padding-card" align="left">
    <strong>{{$poll->title_polling}}</strong>
    <hr>
    <form class="form-group" action="/submit/{{$poll->idPolling}}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        @if($poll->type_polling === "Multiple")
        @foreach($poll->MultipleModel as $multi)
        <label class="container">
            <div class="radio">
                <input type="radio" name="choice" value="{{$multi->id_multiple_choice}}">&nbsp;{{$multi->multiple_choice}}
            </div>
        </label>
        @endforeach
        @elseif($poll->type_polling === "Rating")
        <div class="stars">
            <input class="star" id="star-5" type="radio" value ="5" name="star" required/>
            <label class="star" for="star-5"></label>
            <input class="star" id="star-4" type="radio" value ="4" name="star"/>
            <label class="star" for="star-4"></label>
            <input class="star" id="star-3" type="radio" value ="3" name="star"/>
            <label class="star" for="star-3"></label>
            <input class="star" id="star-2" type="radio" value ="2" name="star"/>
            <label class="star" for="star-2"></label>
            <input class="star" id="star-1" type="radio" value ="1" name="star"/>
            <label class="star" for="star-1"></label>
        </div>
        @endif
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