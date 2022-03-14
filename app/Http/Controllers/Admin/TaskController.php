<?php

namespace App\Http\Controllers\Admin;

use App\Events\TaskCounterEvent;
use App\Events\TaskStatusChange;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Notification;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Services\RecordService;
use App\Http\Services\NotificationService;
use App\Models\Invoice;
use App\Models\Project;
use App\Models\Record;
use App\Models\Task;
use Carbon\Carbon;
use Faker\Factory;
use App\User;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\Uuid;

class TaskController extends Controller
{
    private $recordService;
    private $notifService;

    public function __construct(RecordService $recordService, NotificationService $notifService)
    {
        $this->recordService = $recordService;
        $this->notifService = $notifService;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        if ($this->request->exists('filter') && !empty($this->request->filter)) {
            return TaskResource::collection(Task::where('complete_status', $request->filter)->get());
        }

        return TaskResource::collection(Task::all());
    }


    public function speakerTaskList()
    {
        $user = Auth::user();

        $tasks = Task::where('user_id', $user->id)->get();

        return view('admin.speaker.tasks', get_defined_vars());

    }

    public function speakerTaskDetail(Request $request, $id)
    {
        $user = Auth::user();

        $task = Task::where('user_id', $user->id)->where('id', $id)->first();

        if (!$task) {
            return redirect('/cabinet/tasks')->with('status', 'This task is not set for you');
        }

        $records = Record::where('task_id', $id)->whereNotNull('duration')->get();

        $records_unsaved = Record::where('task_id', $id)->whereNull('duration')->get();


        return view('admin.speaker.taskDetails', get_defined_vars());

    }

    public function taskPageManager(Request $request, $id)
    {
//        dd(1);
//        $user = Auth::user();
//
//        $task = TasksRelation::where('user_id',$user->id)->where('task_id',$id)->first();
//
//        if(!$task){
//            return redirect('/cabinet/tasks')->with('status','This task is not set for you');
//        }
//
        $task = Task::where('id', $id)->first();
        $user = User::where('id', $task->user_id)->first();
        $records = Record::where('task_id', $id)->get();

        return view('admin.manager.taskDetails', get_defined_vars());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return string
     */
    public function store()
    {
        try {

            $this->request->request->add(
                [
                    'status' => isset($this->request->status)
                ]
            );

            return Task::create($this->request->all());

        } catch (\Exception $exception) {

            return $exception->getMessage();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return TaskResource
     */
    public function show($id)
    {
        return new TaskResource(Task::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id
     * @return TaskResource
     */
    public function taskEdit(Request $request)
    {
        $task = Task::where('uuid', $request->input('uuid'))->first();

        if ($task) {

            $time = $request->input('length');

            switch ($request->input('time_type')) {
                case('Min'):
                    $time = $time * 60;
                    break;
                case('Hour'):
                    $time = $time * 3600;
                    break;
                default:
                    break;
            }

            $task->complete_status = $request->input('complete_status') ?? '';
            $task->apply_deadline = $request->input('apply_deadline') ?? null;
            $task->complete_deadline = $request->input('complete_deadline') ?? null;
            $task->length = $time;

            $task->update();

            $user = User::where('id', $task->user_id)->first();

            Mail::send('mailForms.newTask', ['user' => $user], function ($m) use ($user) {
                $m->to($user->email, $user->first_name)->subject("Your task has been chenged");
            });

            return redirect('/manager/task/' . $task->id)->with('status', 'task was edited');
        }
        return redirect('/manager')->with('status', 'error');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param string $id
     * @return string[]
     */
    public function update($id)
    {
        $notification = new Notification('task', 'updated');

        $this->request->request->add(
            [
                'status' => isset($this->request->status)
            ]
        );
        Task::find($id)->update($this->request->all());
        /*$tasks = new Collection;
        $tasks->push(Task::find($id));
        event(new TaskCounterEvent(collect($tasks)));*/

//        dd(collect(Task::find($id)));


        return $notification->show();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return Response
     */
    public function destroy($id)
    {
        return Task::find($id)->delete();
    }

    /*----------------------------
     * Invoice generating
     * ---------------------------T
     * */

    public function generateInvoice(Request $request)
    {
        $tasks = new Collection();

        foreach ($request->tasks as $task) {
            if ($task['checked'] === true) {

                $tasks->push(Task::find($task['id'])->first()->uuid);

                Task::find($task['id'])->update([
                    'complete_status' => 'invoiced'
                ]);
            }
        }

        // Creating new Invoice


        $invoice = new Invoice();
        $invoice->task_uuids = implode('|', $tasks->toArray());
        $invoice->speaker_id = auth()->user()->id;
        $invoice->status = 'pending';
        $invoice->save();

        dd($invoice);

    }

    public function decline(Request $request)
    {
        DB::table('taskables')->where('task_uuid', $request->uuid)->delete();
        return event(new TaskCounterEvent(User::find($request->id)->tasks));
    }


    public function createTask(Request $request, $project_id)
    {

        $project = Project::where('id', $project_id)->first();

        if ($project) {

            $time = $request->input('length');

            switch ($request->input('time_type')) {
                case('Min'):
                    $time = $time * 60;
                    break;
                case('Hour'):
                    $time = $time * 3600;
                    break;
                default:
                    break;
            }

            $one_task = new Task();

            $one_task->uuid = Uuid::uuid4()->toString();
            $one_task->project_id = $project_id;
            $one_task->user_id = $request->input('user_id');
            $one_task->title = $request->input('title');
            $one_task->price = $request->input('price');
            $one_task->length = $time;
            $one_task->status = 1;
            $one_task->description = $request->input('description');
            $one_task->budget = $request->input('budget');
            $one_task->complete_status = 'new';

            $one_task->push();

//        $taskRelation = new TasksRelation();
//
//        $taskRelation->user_id = $request->input('user_id');
//        $taskRelation->task_id = $one_task->id;
//
//        $taskRelation->push();

            return response()->json([
                'status' => true,
                'html' => view('admin.ajax_renders.newTaskCreated', get_defined_vars())->render(),
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
        }

    }

    public function multiTasksCreation(Request $request)
    {

        $user_ids = explode(',', $request->input('users_id'));

        $time = $request->input('length');

        switch ($request->input('time_type')) {
            case('Min'):
                $time = $time * 60;
                break;
            case('Hour'):
                $time = $time * 3600;
                break;
            default:
                break;
        }

        foreach ($user_ids as $one_user) {

            $one_task = new Task();

            $one_task->uuid = Uuid::uuid4()->toString();
            $one_task->project_id = $request->input('project_id');
            $one_task->user_id = $one_user;
            $one_task->title = $request->input('title');
            $one_task->price = $request->input('price');
            $one_task->length = $time;
            $one_task->description = $request->input('description');
            $one_task->status = 1;
            $one_task->budget = $request->input('budget');
            $one_task->complete_status = 'new';

            $one_task->push();

//            $taskRelation = new TasksRelation();
//
//            $taskRelation->user_id = $one_user;
//            $taskRelation->task_id = $one_task->id;
//
//            $taskRelation->push();

            $user = User::where('id', $one_user)->first();

            Mail::send('mailForms.newTask', ['user' => $user], function ($m) use ($user) {
                $m->to($user->email, $user->first_name)->subject("You got new task");
            });


        }


        return redirect('/manager/project/' . $request->input('project_id'));

    }

    public function AutoTaskCreator(Request $request)
    {

        $taskNeed = intval($request->input('autoCreatingTaskCount'));

        $taskCreatedCount = 0;

        $project = Project::where('id', $request->input('projectid'))->first();

        $users = User::whereIn('country', explode(',', $project->country))->where('main_language', $project->language)->limit($taskNeed)->get();

        $time = $request->input('time');

        switch ($request->input('time_type')) {
            case('Min'):
                $time = $time * 60;
                break;
            case('Hour'):
                $time = $time * 3600;
                break;
            default:
                break;
        }


        if ($request->input('optimCreator') == 'yes') {

            do {

                foreach ($users->pluck('id') as $one_user) {
                    $one_task = new Task();
                    $one_task->uuid = Uuid::uuid4()->toString();
                    $one_task->project_id = $project->id;
                    $one_task->user_id = $one_user;
                    //$one_task->title = $request->input('title');
                    $one_task->price = $request->input('budget');
                    $one_task->length = $time;
                    //$one_task->description = $request->input('description');
                    $one_task->status = 1;
                    $one_task->budget = $request->input('budget');
                    $one_task->complete_status = 'new';

                    $one_task->push();

                    $user = User::where('id', $one_user)->first();

                    Mail::send('mailForms.newTask', ['user' => $user], function ($m) use ($user) {
                        $m->to($user->email, $user->first_name)->subject("You got new task");
                    });

                    $taskCreatedCount++;
                }
            } while ($taskCreatedCount <= $taskNeed);

        } else {
            foreach ($users->pluck('id') as $one_user) {

                $one_task = new Task();

                $one_task->uuid = Uuid::uuid4()->toString();
                $one_task->project_id = $project->id;
                $one_task->user_id = $one_user;
                //$one_task->title = $request->input('title');
                $one_task->price = $request->input('budget');
                $one_task->length = $time;
                //$one_task->description = $request->input('description');
                $one_task->status = 1;
                $one_task->budget = $request->input('budget');
                $one_task->complete_status = 'new';

                $one_task->push();

                $user = User::where('id', $one_user)->first();

                Mail::send('mailForms.newTask', ['user' => $user], function ($m) use ($user) {
                    $m->to($user->email, $user->first_name)->subject("You got new task");
                });
            }
        }

        return redirect($request->segment(1) . '/project/' . $project->id);

    }

    public function acceptTask(Request $request, $uuid)
    {

        $task = Task::where('uuid', $uuid)->update(['complete_status' => 'in_progress']);

        return response()->json(['status' => true]);
    }

    public function sendForVerifyTask(Request $request, $uuid)
    {
        $task = Task::where('uuid', $uuid)->first();
        $project = Project::where('id', $task->project_id)->first();
        $user = User::where('id', $project->user_id)->first();

        $canBeApproved = $this->recordService->checkIfCanBeApproved($task);


        if ($canBeApproved == false) {
            return response()->json(['status' => false, 'msg' => 'You havent recordered enought audio']);
        }
        $task->update(['complete_status' => 'delivered']);

        Mail::send('mailForms.taskWasDone', ['task' => $task, 'user' => $user, 'project' => $project], function ($m) use ($user) {
            $m->to($user->email, $user->first_name)->subject("Task was done, check it");
        });

        return response()->json(['status' => true]);
    }

    public function sendReminder(Request $request, $uuid)
    {

        $task = Task::where('uuid', $uuid)->first();
        $task->update(['remind_date' => Carbon::now()]);

        $user = User::where('id', Task::where('id', $task->id)->pluck('user_id'))->first();

        $this->notifService->notify($user, 'info', 'You were remined that you have task', true, url('cabinet', ['task', $task->id]));

        Mail::send('mailForms.reminderTask', ['user' => $user], function ($m) use ($user) {
            $m->to($user->email, $user->first_name)->subject("Did you forget ?!");
        });

        return response()->json(['status' => true]);
    }

    public function approveTask(Request $request, $uuid)
    {

        $task = Task::where('uuid', $uuid)->first();
        $task->update(['complete_status' => 'approved']);

        $this->notifService->notify(User::where('id', $task->user_id)->first(), 'success', 'Your task was approved', false);

        return response()->json(['status' => true]);
    }

//    public function resendTask(Request $request, $uuid)
//    {
//
//        $task = Task::where('uuid', $uuid)->update(['complete_status' => 'in_progress']);
//
//        return response()->json(['status' => true]);
//    }

    public function revokeTask(Request $request, $uuid)
    {

        $task = Task::where('uuid', $uuid)->first();
        $task->update(['complete_status' => 'rejected']);

        $this->notifService->notify(User::where('id', $task->user_id)->first(), 'danger', 'Your task rejected', false);

        return response()->json(['status' => true]);
    }
}
