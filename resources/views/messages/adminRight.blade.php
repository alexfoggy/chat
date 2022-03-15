<div class="media">
    <div class="media-body reverse">
        <div class="msg">
            <p>{{$one_msg->msg}} </p>
        </div>
        <span>{{\Carbon\Carbon::parse($one_msg->created_at)->format('h:m')}}</span>
    </div><!-- media-body -->
    <img src="http://via.placeholder.com/500x500" class="wd-50 rounded-circle" alt="">
</div>
