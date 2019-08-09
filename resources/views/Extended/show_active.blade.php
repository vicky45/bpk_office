@foreach($event_active as $active)
<div class="card cards card-notif">
    <form method="post" action="{{ route('event.store')}}">
        {{ csrf_field() }}
        <input type="hidden" value="{{$active->code_event}}" name="join">
        <button type="submit" class="btn card-notif btn-outline-success btn-block">
            <span class="spinner-grow spinner-grow-sm float-lg-left" ></span>
            LIVE NOW
            <a>
                <div class="title-event">
                    <h6><b>{{$active->name_event}}</b></h6>
                    <h6>#{{$active->code_event}}</h6> 
                </div>
            </a>
        </button>    
    </form>
</div>
<br>
@endforeach