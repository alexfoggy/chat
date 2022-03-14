@foreach($responseMsg as $oneMsg)
    @if($oneMsg->userStatus == 2)
        <div class="left-q">
            <div class="small-image-assist">
                <img src="" alt="">
            </div>
            <div class="msg-block">
                <div class="msg-text">
                    {{$oneMsg->msg}}
                </div>
                <div class="date-msg">
                    {{\Illuminate\Support\Carbon::parse($oneMsg->created_at)->format('H:m')}}
                </div>
            </div>
        </div>
    @else
        <div class="right-q">
            <div class="small-image-assist">
                <img src="" alt="">
            </div>
            <div class="msg-block">
                <div class="msg-text">
                    {{$oneMsg->msg}}
                </div>
                <div class="date-msg">
                    {{\Illuminate\Support\Carbon::parse($oneMsg->created_at)->format('h:m')}}
                </div>
            </div>
        </div>
    @endif
@endforeach
