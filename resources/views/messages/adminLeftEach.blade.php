@foreach($newMsgStatus as $one_msg)
<div class="media">
    <div class="media-body">
        <div class="msg">
            <p>{{$one_msg->msg}}</p>
        </div>
        <span>{{\Carbon\Carbon::parse($one_msg->created_at)->format('H:i')}}</span>
    </div><!-- media-body -->
</div>
@endforeach
