<h4>Hello,{{$user->name}}.</h4>
<p>
    Your task has been changed
</p>
<p>
    Please check it
</p>
<a href="{{url('cabinet','task').'/'.$task->id}}">Link for task</a>


