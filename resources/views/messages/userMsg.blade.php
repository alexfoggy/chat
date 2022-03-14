<div class="right-q">
    <div class="small-image-assist">
        <img src="" alt="">
    </div>
    <div class="msg-block">
        <div class="msg-text">
            {{$newMsg->msg}}
        </div>
        <div class="date-msg">
            {{\Illuminate\Support\Carbon::parse($newMsg->created_at)->format('h:m')}}
        </div>
    </div>
</div>
