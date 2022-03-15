@foreach($responseMsg as $oneMsg)
<div class="left-q">
    <div class="small-image-assist">
        <img src="" alt="">
    </div>
    <div class="msg-block">
        <div class="msg-text">
            {{$oneMsg->msg}}
        </div>
        <div class="date-msg">
            {{\Illuminate\Support\Carbon::parse($oneMsg->created_at)->format('H:i')}}
        </div>
    </div>
</div>
@endforeach
