<div class="media row">
    <div class="col-lg-7">
    <input type="hidden" name="{{$one_task->user_id}}" name="user_id">
    <div class="media-body ml-0">
        <a href="{{url(request()->segment(1).'/task').'/'.$one_task->id}}" class="lead">{{$one_task->title ?? 'Sites title'}}</a>
        <p class="d-flex mt-1 font-weight-light">Pinned to: <a href="{{url(request()->segment(1),'userinfo').'/'.$one_task->user_id}}" class="ml-1 tx-warning">{{$one_task->user->first_name ?? ''}} {{$one_task->user->last_name ?? ''}}</a> </p>
    </div><!-- media-body -->
    </div>
    <div class="col-lg-2">
    <span class="mr-5">Budget: {{$one_task->budget ?? ''}}$</span>
    </div>
    <div class="col-lg-2">
    <span class="mr-5">Time: {{$one_task->length / 60 ?? ''}} min</span>
    </div>
    <div class="col-lg-1 d-flex justify-content-center">
    @if($one_task->complete_status == 'new')
        <span class="btn btn-warning btn-inline">New</span>
    @elseif($one_task->complete_status == 'in_progress')
        <span class="btn btn-indigo btn-inline">In procces</span>
    @elseif($one_task->complete_status == 'delivered')
        <span class="btn btn-teal btn-inline">Delivered</span>
    @elseif($one_task->complete_status == 'checked')
        <span class="btn btn-pink btn-inline">Checked</span>
    @elseif($one_task->complete_status == 'approved')
        <span class="btn btn-purple active btn-inline">Approved</span>
    @elseif($one_task->complete_status == 'ready_to_invoice')
        <span class="btn btn-pink active btn-inline">Ready to invoice</span>
    @elseif($one_task->complete_status == 'invoiced')
        <span class="btn btn-success btn-inline">Invoiced</span>
    @else

    @endif
    </div>
</div><!-- media -->
