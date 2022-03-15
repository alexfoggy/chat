@foreach($responseMsg as $one_msg)
    @if($one_msg->userStatus == 1)
        <div class="media">
            <div class="media-body">
                <div class="msg">
                    <p>{{$one_msg->msg}}</p>
                </div>
                <span>{{\Carbon\Carbon::parse($one_msg->created_at)->format('H:i')}}</span>
            </div><!-- media-body -->
        </div>
    @else
        <div class="media">
            <div class="media-body reverse">
                <div class="msg">
                    <p>{{$one_msg->msg}} </p>
                </div>
                <span>{{\Carbon\Carbon::parse($one_msg->created_at)->format('H:i')}}</span>
            </div><!-- media-body -->
        </div>
    @endif
@endforeach
