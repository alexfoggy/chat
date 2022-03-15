<div class="media">
    <img src="http://via.placeholder.com/500x500" alt="">
    <div class="media-body">
        <div class="msg">
            <p>{{$one_msg->msg}}</p>
        </div>
        <span>{{\Carbon\Carbon::parse($one_msg->created_at)->format('h:m')}}</span>
    </div><!-- media-body -->
</div>
