<?php

namespace App\Http\Controllers\Admin;

use App\Events\TaskCounterEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Country;
use App\Models\Language;
use App\Models\Project;
use App\Models\Task;
use App\Notifications\NewTaskNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;
use function RingCentral\Psr7\str;
use Carbon\Carbon;

class ManagerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Project[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {

        $user = Auth::user();

        return view('admin.manager.index', get_defined_vars());

    }

    public function editPage(Request $request)
    {

        $user = Auth::user();

        $countries = Country::get();

        $languages = Language::get();

        return view('admin.speaker.edit', get_defined_vars());

    }

    public function editSave(Request $request)
    {

//        $user = User::findOrFail(Auth::user()->id);
//
//        $age = Carbon::parse($request->input('birth_date'))->diff(Carbon::now())->y;
//
//        switch ($age) {
//            case($age >= 60):
//                $age = 'Old';
//                break;
//            case($age >= 21 && $age < 60):
//                $age = 'Adult';
//                break;
//            case($age >= 14 && $age < 21):
//                $age = 'Teen';
//                break;
//            default:
//                $age = 'Child';
//                break;
//        }
//
//        $user->first_name = $request->input('first_name');
//        $user->last_name = $request->input('last_name');
//        $user->email = $request->input('email');
//        $user->phone = $request->input('phone');
//        $user->main_language = $request->input('main_language');
//        $user->country = $request->input('country');
//        $user->gender = $request->input('gender');
//        $user->main_language_level = $request->input('main_language_level');
//        $user->birth_date = $request->input('birth_date');
//        $user->gender = $request->input('gender');
//        $user->voice = $age;
//
//        $user->update();
//
//        return redirect('/cabinet')->with('status', 'Succesfuly edited');

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function show(Project $project)
    {

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
