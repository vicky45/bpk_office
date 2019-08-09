@if($polling_result->count() > 0 )
    @php
    $type = null;
    @endphp
@foreach($polling_result as $pr )
    @php
    $type = $pr->type_polling;
    @endphp
    <div class="card">
                    <div class="card-body text-center">
                        <div class="col-md-9 text-left">
                            <h4><strong>{{$pr->title_polling}}</strong></h4>
                            <p><small class="text-muted">{{$type}}</small></p>
                        </div>
                        <hr>
@if($pr->type_polling === "Multiple")
            @foreach($pr->MultipleModel as $show_multiple)
                            <div class="h4 col-sm-12 text-left">
                           {{$show_multiple->multiple_choice}}
                            </div> 
                            <!-- Variabel $n_choice_multi from controller C_Polling-->
                            <div class="progress col-sm-12" style="height:20px;">
                                <div class="progress-bar progress-bar-striped" 
                                     style="width:{{$show_multiple->total_multiple_choice}}%;height:20px;">{{$show_multiple->total_multiple_choice}}</div>
                            </div>
                            <br>
            @endforeach
@else
            @foreach($pr->RatingModel as $show_rating)
                <div class="h4 col-sm-12 text-left">
                @if($show_rating->rating === 5)
                    <input class="star star-4" checked="checked" type="radio">
                    <label class="star star-5" for="star-5"></label>
                    <label class="star star-4" for="star-4"></label>
                    <label class="star star-3" for="star-3"></label>
                    <label class="star star-2" for="star-2"></label>
                    <label class="star star-1" for="star-1"></label>
                    @elseif($show_rating->rating === 4)
                    <input class="star star-4" checked="checked" type="radio">
                    <label class="star star-4" for="star-4"></label>
                    <label class="star star-3" for="star-3"></label>
                    <label class="star star-2" for="star-2"></label>
                    <label class="star star-1" for="star-1"></label>
                    @elseif($show_rating->rating === 3)
                    <input class="star star-3" checked="checked" type="radio">
                    <label class="star star-3" for="star-3"></label>
                    <label class="star star-2" for="star-2"></label>
                    <label class="star star-1" for="star-1"></label>
                    @elseif($show_rating->rating === 2)
                    <input class="star star-3" checked="checked" type="radio">
                    <label class="star star-2" for="star-2"></label>
                    <label class="star star-1" for="star-1"></label>
                    @else
                    <input class="star star-3" checked="checked" type="radio">
                    <label class="star star-1" for="star-1"></label>
                @endif
                </div>
                <div class="h4 col-sm-12 text-left">
                    {{$show_rating->rating}}
                </div>
               <!-- Variabel $n_choice_rate from controller C_Polling-->
                <div class="progress col-sm-12" style="height:20px;">
                    <div class="progress-bar progress-bar-striped" style="width:{{$show_rating->total_rating}}%;height:20px;"> {{$show_rating->total_rating}}</div>
                </div>
                <br>
            @endforeach                 
            <!--end views-->
@endif
        </div>
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



