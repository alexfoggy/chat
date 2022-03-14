<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\msg;
use App\Models\Sites;
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
        $ip = $request->ip();
        $msg = $request->input('msg');

        $user = User::where('key',$ip)->first();

        if (!$user) {
            $user = new User();
            $user->key = $ip;
            $user->push();
        }

        $newMsg = new msg();
        $newMsg->msg = $msg;
        $newMsg->userStatus = 1;
        $newMsg->user_id = $user->id;
        $newMsg->sendStatus = 1;
        $newMsg->push();

        return response()->json([
            'key'=>$user->key,
            'status'=> true,
            'userText'=>view('messages.userMsg',get_defined_vars())->render(),
        ]);
    }


    public function checkIfAns(Request $request)
    {

        $ip = $request->ip();

        $user = User::where('key', $ip)->first();

        if ($user) {

            $responseMsg = msg::where('user_id', $user->id)->where('userStatus', 2)->where('sendStatus',0)->orderBy("created_at",'ASC')->get();
            if (count($responseMsg) > 0) {
                msg::whereIn('id',$responseMsg->pluck('id'))->update(['sendStatus'=>1]);
                //$responseMsg->update(['sendStatus'=>1]);
                return response()->json([
                    'status' => true,
                    'userText' => view('messages.assistMsg', get_defined_vars())->render(),
                ]);
            }
            else {
                return response()->json([
                    'status' => true,
                ]);
            }
        }
        return response()->json([
            'status' => false
        ]);
    }

    public function history(Request $request)
    {

        $ip = $request->ip();
        $user = User::where('key',$ip)->first();

        if ($user) {

            $responseMsg = msg::where('user_id', $user->id)->orderBy("created_at",'ASC')->get();
                return response()->json([
                    'status' => true,
                    'userText' => view('messages.historyMsg', get_defined_vars())->render(),
                ]);
        }
        return response()->json([
            'status' => false
        ]);
    }

    public function checkIfKeyWorks(Request $request)
    {
        $siteCheck = Sites::where('site_key',$request->input('key'))->first();
        if($siteCheck)
        {
                return response()->json([
                    'status' => true,
                ]);
        }
        return response()->json([
            'status' => false
        ]);
    }
}
