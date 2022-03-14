<?php

namespace App\Http\Controllers\Admin;

use App\Events\TaskCounterEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Country;
use App\Models\Dialect;
use App\Models\Language;
use App\Models\Project;
use App\Models\Task;
use App\Notifications\NewTaskNotification;
use App\User;
use Dotenv\Validator;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Ramsey\Uuid\Uuid;
use function RingCentral\Psr7\str;
use Carbon\Carbon;

class AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Project[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {

        $user = Auth::user();

        $project_managers = User::whereHas('type', function ($q) {
            $q->where('user_type_id', 2);
        })->get();

        /*   $age = Carbon::parse($user->birth_date)->diff(Carbon::now())->y;

           $dialects = Dialect::where('user_id',$user->id)->get();

           $userTasks = Task::where('user_id',$user->id)->get();*/

        return view('admin.main.index', get_defined_vars());

    }

    public function projectsList()
    {
        $projects = Project::orderBy('created_at', 'DESC')->where('status', '<>', 'complited')->get();

        $projectsComplited = Project::where('status', 'complited')->orderBy('created_at', 'DESC')->get();

        return view('admin.manager.projectsList', get_defined_vars());
    }

    public function speakersList()
    {
        $users = User::whereHas('type', function ($q) {
            $q->where('user_type_id', 3);
        })->get();

        return view('admin.main.speakersList', get_defined_vars());
    }

    public function pmList()
    {
        $users = User::whereHas('type', function ($q) {
            $q->where('user_type_id', 2);
        })->get();

        return view('admin.main.managersList', get_defined_vars());
    }

    public function createUser()
    {
        return view('admin.main.createUserPage', get_defined_vars());
    }

    public function translates(Request $request)
    {

        $lang_trans = trans('vars', [], 'en');

        $curr_lang = trans('vars', [], $request->input('lang'));

        return view('admin.main.translatesPage', get_defined_vars());
    }

    public function translatesSave(Request $request)
    {
        $data = '<?php return[';

        foreach ($request->input('trans') as $key => $value) {
            $data .= '"' . $key . '" => "' . $value . '",';
        }
        $data .= '];';

        $route = resource_path('lang/' . $request->input('lang') . '/vars.php');

        file_put_contents($route, $data);

        return redirect('admin/translates?lang=' . $request->input('lang'))->with('status', 'Successfully edited');

    }

    public function newProjectManager(Request $request)
    {

        $valid = \Illuminate\Support\Facades\Validator::make($request->input(), [
            'email' => 'required|unique:users|email',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);
        if ($valid->fails()) {
            $msg = '';
            foreach ($valid->errors()->messages() as $one_msg) {
                $msg .= $one_msg['0'] . '<br>' . $msg;
            }
            return redirect('admin/create-user')->with('status', ['type' => 'danger', 'msg' => $msg]);
        } else {

            $passUser = substr($request->input('_token'), 0, 12);

            $user = User::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'password' => Hash::make($passUser),
                'email_verified_at' => now(),
                'token' => generateToken()
            ]);

            $user->type()->attach('2');

            Mail::send('mailForms.newPM', ['user' => $user, 'pass' => $passUser], function ($m) use ($user) {
                $m->to($user->email, $user->first_name)->subject("You have been registered at Unicrowd.ai as PM");
            });

            return redirect('admin/pmlist')->with('success', 'New project manager has been created');
        }
    }

    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    public function store(Request $request)
    {

    }

    public function settingsPage(Project $project)
    {

        return view('admin.speaker.settings', get_defined_vars());
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
    public function update(Request $request)
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }

    public function generateTasks(Request $request)
    {

    }
}
