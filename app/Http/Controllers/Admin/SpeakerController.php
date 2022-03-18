<?php

namespace App\Http\Controllers\Admin;

use App\Events\TaskCounterEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Http\Services\NotificationService;
use App\Http\Services\RecordService;
use App\Models\Chat;
use App\Models\Country;
use App\Models\Dialect;
use App\Models\Language;
use App\Models\Msg;
use App\Models\Project;
use App\Models\Sites;
use App\Notifications\NewTaskNotification;
use App\User;
use App\UserSite;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Ramsey\Uuid\Uuid;
use function RingCentral\Psr7\str;
use Carbon\Carbon;

class SpeakerController extends Controller
{

    private $recordService;

    public function __construct(RecordService $recordService)
    {
        $this->recordService = $recordService;

    }
    public function index(Request $request)
    {

        $user = Auth::user();

        $mySites = Sites::where('user_id',$user->id)->select('id')->get()->toArray();

        $lastMonth = UserSite::whereIn('site_id',$mySites)->get();

        return view('admin.speaker.index', get_defined_vars());

    }

    public function newsite(Request $request)
    {

        $user = Auth::user();

        return view('admin.speaker.createsite', get_defined_vars());
    }

    public function domainslist(Request $request)
    {
        $user = Auth::user();
        $domains = Sites::where('user_id',$user->id)->get();

        return view('admin.speaker.listdomains', get_defined_vars());
    }

    public function oneDomain(Request $request,$id)
    {
        $domain = Sites::where('id',$id)->first();

        return view('admin.speaker.oneDomain', get_defined_vars());
    }

    public function chatList(Request $request)
    {
        $user = Auth::user();

        $sites = Sites::where('user_id',$user->id)->select('id')->get();
        $chats = '';
        $firstChat = '';
        if($sites->isNotEmpty()) {

            $userHasMsg = UserSite::whereIn('site_id', $sites)->select('id')->get();

            $chatsArray = Chat::whereIn('site_id', $sites)->whereIn('user_id', $userHasMsg)->select('id')->get()->toArray();

            $chats = Msg::whereIn('chat_id', $chatsArray)->groupBy('chat_id')->get();

            $firstChat = Msg::where('chat_id', $chats->first()->chat_id)->get();
        }
        return view('admin.speaker.chatList', get_defined_vars());
    }

    public function editPage(Request $request)
    {

        $user = Auth::user();

        $countries = Country::get();

        $languages = Language::get();

        $dialects = Dialect::where('user_id', $user->id)->get();

        return view('admin.speaker.edit', get_defined_vars());

    }

    public function editSave(Request $request)
    {

        $user = User::findOrFail(Auth::user()->id);
        if ($user) {
            $avatar = null;
            if ($request->file()) {

                $this->validate($request, [
                    'avatar' => 'required|image',
                ]);

                $path = "/avatar";
                $file = $request->file();

                $avatar = Storage::disk('public')->putFileAs($path, $file['avatar'], $user->last_name . '_' . $user->first_name . '_' . $file['avatar']->getClientOriginalName());


                $file = Image::make(Storage::disk('public')->path($avatar));
                $file->resize(240, 240, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $file->save(Storage::disk('public')->path($avatar));

            }

            $age = Carbon::parse($request->input('birth_date'))->diff(Carbon::now())->y;

            switch ($age) {
                case($age >= 60):
                    $age = 'Old';
                    break;
                case($age >= 21 && $age < 60):
                    $age = 'Adult';
                    break;
                case($age >= 14 && $age < 21):
                    $age = 'Teen';
                    break;
                default:
                    $age = 'Child';
                    break;
            }

            $dialect_status = 0;
            if ($request->input('dialects_status') == 'true') {
                $dialect_status = 1;
            }

            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->phone = $request->input('phone');
            $user->main_language = $request->input('main_language');
            $user->country = $request->input('country');
            $user->gender = $request->input('gender');
            $user->main_language_level = $request->input('main_language_level');
            $user->birth_date = $request->input('birth_date');
            $user->gender = $request->input('gender');
            $user->dialect_status = $dialect_status;
            $user->voice = $age;

            if ($request->current_location_status == 'no') {
                $user->current_location_status = 0;
                $user->current_location = $request->input('current_location');
            } else {
                $user->current_location_status = 1;
                $user->current_location = null;
            }

            if ($avatar != null) {
                $user->avatar = $avatar;
            }
            $user->update();

            if ($dialect_status == 1) {
                foreach ($request->input('dialect') as $key => $value) {

                    $new_dialect = Dialect::updateOrCreate([
                        'id' => $key,
                        'user_id' => Auth::user()->id,
                    ], [
                        'country_id' => $request->input('country'),
                        'language_id' => $value,
                        'level' => $request->input('lang_level')[$key],
                    ]);
                }
            } else {
                Dialect::where('user_id', Auth::user()->id)->delete();
            }


            return redirect('/cabinet')->with('status', 'Succesfuly edited');
        }
        return redirect('/');

    }


    public function deleteDialect(Request $request)
    {
        Dialect::where('id', $request->input('id'))->delete();

        return response()->json([
            'status' => true,
        ]);
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
