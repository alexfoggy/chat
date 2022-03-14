<?php

namespace App\Http\Controllers\Admin;

use App\Events\TaskCounterEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Http\Services\ProjectService;
use App\Models\Country;
use App\Models\Language;
use App\Models\Project;
use App\Models\Sites;
use App\Models\TasksRelation;
use App\Notifications\NewTaskNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;
use function RingCentral\Psr7\str;

class ProjectController extends Controller
{

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Project[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Project::with(['language'])
                ->with(['tasks' => function ($query) {
                    $query->with(['user', 'records'])->orderByDesc('complete_status');
                }])
                ->where('user_id', auth()->user()->id)->get();
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function createIndex()
    {


        $user = Auth::user();

        $countries = Country::get();

        $languages = Language::get();

        return view('admin.manager.projectCreate', get_defined_vars());

    }

    public function projectsList()
    {
        $projects = Project::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->where('status', '!=', 'complited')->get();

        $projectsComplited = Project::where('user_id', Auth::user()->id)->where('status', 'complited')->orderBy('created_at', 'DESC')->get();

        return view('admin.manager.projectsList', get_defined_vars());
    }

    public function projectPage(Request $request,$id)
    {
        $user = User::where('id',Auth::user()->id)->first();


        $adminStatus = false;
        if($user->type->first()->title == 'admin'){
            $project = Project::where('id', $id)->first();
            $adminStatus = true;
        }
        else {
            $project = Project::where('user_id', Auth::user()->id)->where('id', $id)->first();
        }
        if($project) {
            $user = Auth::user();

            $countries = Country::get();

            $languages = Language::get();

            $tasks = Sites::where('project_id', $id)->get();

            $relatedUsersId = Sites::where('project_id', $id)->pluck('user_id')->toArray();

            //$relatedUsers = TasksRelation::whereIn('task_id',$tasksId)->pluck('user_id')->toArray();

            $speakers = User::where('main_language', $project->language)->whereNotIn('id', $relatedUsersId)->where('voice', $project->voice)->where('country', $project->country)->get();

            $aprox_price_per_person = $this->projectService->getAproxPrice($project);
            $aprox_time_per_person = $this->projectService->getAproxTime($project);

            $timeTasked = $tasks->pluck('length')->sum();

            $statusUsersCount = $this->projectService->getStatusUsersCount($project, $tasks, $speakers, $timeTasked);

            $country_list = explode(',', $project->country);

            return view('admin.manager.projectPage', get_defined_vars());
        }
        else {
            return redirect($request->segment(1).'/projects')->with('status',['type'=>'warning','msg'=>'Project was deleted or not found']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    public function store(Request $request)
    {
        $request = $request->data;
        $request['status'] = 'new';
        $project = Project::create($request);
        $project->language()->attach(Language::where('name', $request['language'])->first()->id);
        return "$project->id";

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function show(Project $project)
    {
//        return Project::where('id', $project->id)->with('tasks')->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    /*   public function update(Request $request, Project $project)
       {

           dd($request->data);

           if (isset($request->data['users'])) {

               $tasks = new Collection();

               foreach ($request->data['users'] as $user) {


                   if ($user !== null) {

                       for ($i = 0; $i < $project->tasks_count; $i++) {
                           $tasks->push(
                               Sites::create([
                                   'uuid' => Uuid::uuid4()->toString(),
                                   'project_id' => $project->id,
                                   'title' => $project->title . ' Sites',
                                   'budget' => $project->budget,
                                   'length' => $project->minutes_per_tasks,
                                   'status' => true,
                                   'complete_status' => 'new',
                                   'apply_deadline' => $project->apply_deadline,
                                   'complete_deadline' => $project->complete_deadline,
                               ]));
                       }
                   }
               }

               foreach (User::whereIn('id', $request->data['users'])->get() as $key => $user) {
                   foreach ($tasks->chunk($project->tasks_per_speaker)[$key]->pluck('uuid') as $task) {
                       $user->tasks()->attach(['task_uuid' => $task]);
                   }
               }
           }
           return $project->update($request->data);
       }*/

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function deleteProject(Request $request,$hash)
    {
        $projects = Project::get();

        foreach ($projects as $one_proj){
            if (Hash::check($one_proj->id, $hash)) {

                Project::where('id',$one_proj->id)->delete();
                return response()->json([
                    'status' => true,
                ]);
            }
        }

    }

    public function saveProject(Request $request)
    {

        $id = '';
        $return = redirect($request->segment(1) . '/projects')->with('status', 'Succesfuly created new project');

        if ($request->input('id')) {
                $id = $request->input('id');
                $return = redirect($request->segment(1) . '/project/' . $id)->with('status', 'Project was edited');;

        }

        //time verefiy

        $time = $request->input('time');

        if ($request->input('time_type') == 'Min') {
            $time = $time * 60;
        } elseif ($request->input('time_type') == 'Hour') {
            $time = $time * 3600;
        }

        //$uuid = $request->input('uuid');
        // $tasks = $request->input('speakers') * $request->input('tasks_count');
        // $budget = intval($request->input('budget')) / intval($request->input('tasks_count'));

        $countries = implode(',', $request->input('country'));

        $user_id = Auth::user()->id;

        if($request->input('user_id')){
            $user_id = $request->input('user_id');
        }

        $project = Project::updateOrCreate(
            ['id' => $id,
                'user_id' => $user_id],
            [
                'title' => $request->input('title'),
                'subject' => $request->input('subject'),
                'language' => $request->input('language'),
                'country' => $countries,
                'dialect' => $request->input('dialect'),
                'budget' => $request->input('budget'),
                //'tasks_count' => $request->input('tasks_count'),
                'rules' => $request->input('rules'),
                'speakers' => $request->input('speakers'),
                'voice' => $request->input('voice'),
                'type' => $request->input('type'),
                'time' => $time,
                'time_type' => $request->input('time_type'),
                'status' => true,
                'apply_deadline' => $request->input('apply_deadline'),
                'uploadAction' => $request->input('uploadAction') == 'on' ? 1 : 0,
//               'complete_deadline' => $project->complete_deadline,
            ]
        );

        return $return;
    }
}
