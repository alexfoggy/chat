<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ApiCrudInterface;
use App\Http\Resources\LanguageResource;
use App\Http\Resources\TaskResource;
use App\Http\Resources\UserResource;
use App\Models\Country;
use App\Models\Language;
use App\Models\Record;
use App\Models\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller implements ApiCrudInterface
{
    protected $type = 'profile';
    protected $request;
    protected $token;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->token = $request->token;
    }

    public function getItems()
    {
        return UserResource::collection(User::all());
    }

    public function getItem($token)
    {
        return new UserResource(User::whereToken($this->token)->firstOrFail());
    }

    public function updateItem(Request $request, $token = null)
    {
        $user = User::whereToken($token)->first();
        User::whereToken($token)->update([
            'first_name' => $request->first_name ?? $user->first_name,
            'last_name' => $request->last_name ?? $user->last_name,
            'birth_date' => $request->birth_date ?? $user->birth_date,
            'email' => $request->email ?? $user->email,
            'paypal' => $request->paypal ?? $user->paypal,
            'phone' => $request->phone ?? $user->phone,
            'gender' => $request->gender ?? $user->gender,
            'main_language' => $request->main_language ? Language::whereName($request->main_language)->first()->id : $user->main_language,
            'main_language_level' => $request->main_level ?? $user->main_language_level,
            'country' => $request->country ? Country::where('name', $request->country)->first()->id : $user->country
        ]);

        if($request->has(['second_language', 'second_country'])) {
            $user->languages()->sync(Language::whereName($request->second_language)->first()->id,
                [
                    'dialect' => $request->second_country,
                    'level' => $request->second_level
                ]
            );
        }



        return $this->crudNotification($this->type, 'updated');
    }

    public function deleteItem($token)
    {
        User::whereToken($this->token)->delete();
        return $this->crudNotification($this->type, 'deleted');
    }

    public function getTasks()
    {

//        dump(User::whereToken($this->request->token)->first()->tasks()->get());

        if ($this->request->exists('filter') && !empty($this->request->filter)) {
            return TaskResource::collection((User::whereToken($this->token)->first()->tasks()->where('complete_status', $this->request->filter)->get()));
        }

//        return dd(User::whereToken($this->request->token)->with('tasks')->get());

        $user = User::whereToken($this->token)->first();
        $default = '';

        foreach (config('general.task.status') as $key => $status) {
            if ($user->tasks()->where('complete_status', $key)->get()->count() == 0) {
                continue;
            } else {
                $default = $key;
            }
        }

        return TaskResource::collection((User::whereToken($this->token)->first()->tasks()->where('complete_status', $default)->get()));
    }

    public function getTaskLength()
    {
        $tasks = Task::whereHas('user', function ($query) {
            $query->whereToken($this->token);
        })->get();

        $task_response = new Collection();

        foreach (config('general.task.status') as $key => $status) {
            if ($tasks->where('complete_status', $key)->count() && !in_array($key, ['invoiced', 'checked', 'approved'])) {
                $task_response->push(
                    [
                        'name' => config("general.task.status.$key"),
                        'filter' => $key,
                        'count' => $tasks->where('complete_status', $key)->count()
                    ]
                );
            }
        }

        return response(['data' => $task_response]);
    }

    public function getLanguages()
    {
        return LanguageResource::collection(
            Language::whereHas('user', function ($query) {
                $query->whereToken($this->token);
            })->get()
        );

    }

    public function addLanguage(Request $request)
    {
        User::whereToken($this->token)
            ->first()
            ->languages()
            ->sync($request->langs);

        return $this->crudNotification($this->type, 'updated');
    }
}
