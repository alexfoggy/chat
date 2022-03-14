<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\msg;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;


class RecordController extends Controller
{

    public function __construct()
    {

    }

    public function sendMsg(Request $request)
    {
        $request->input();

        $userKey = $request->input('key');
        $msg = $request->input('msg');

        $user = User::where('key', $userKey)->first();

        if (!$user) {
            $user = new User();
            $user->key = Hash::make(time());
            $user->push();
        }

        $newMsg = new msg();
        $newMsg->msg = $msg;
        $newMsg->userStatus = 1;
        $newMsg->user_id = $user->id;
        $newMsg->push();

        return response()->json([
            'key'=>$user->key,
            'status'=> true,
            'userText'=>view('messages.userMsg',get_defined_vars())->render(),
        ]);
    }


    public function checkIfAns(Request $request)
    {

        $userKey = $request->input('key');

        $user = User::where('key', $userKey)->first();

        if ($user) {



        return response()->json([
            'key'=>$user->key,
            'status'=> true
        ]);
        }
    }
}
