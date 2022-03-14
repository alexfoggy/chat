<h4>Hello,{{$user->name}}.</h4>
<p>
Task for project {{$project->title}} was done.
</p>
<p>
Please check it
</p>
<a href="{{url('cabinet','task').'/'.$task->id}}">Link for task</a>


