<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\msg;
use App\Models\Sites;
use App\User;
use App\UserSite;
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
        $ip = $request->ip();
        $msg = $request->input('msg');
        $key = $request->input('key');

        $user = UserSite::where('key',$ip)->first();

        if (!$user) {
            $user = new UserSite();
            $user->key = $ip;
            $user->push();
        }

        $site = Sites::where('site_key',$key)->first();

        $newMsg = new msg();

        $newMsg->msg = $msg;
        $newMsg->site_id = $site->id;
        $newMsg->userStatus = 1;
        $newMsg->user_id = $user->id;
        $newMsg->sendStatus = 0;

        $newMsg->save();

        return response()->json([
            'key'=>$user->key,
            'status'=> true,
            'userText'=>view('messages.userMsg',get_defined_vars())->render(),
        ]);
    }

    public function sendmsgpanel(Request $request)
    {
        $msg = $request->input('msg');
        $site_id = $request->input('site_id');
        $user_id = $request->input('user_id');


        $one_msg = new msg();
        $one_msg->msg = $msg;
        $one_msg->userStatus = 2;
        $one_msg->user_id = $user_id;
        $one_msg->sendStatus = 0;
        $one_msg->site_id = $site_id;
        $one_msg->push();

        return response()->json([
            'status'=> true,
            'userText'=>view('messages.adminRight',get_defined_vars())->render(),
        ]);
    }


    public function checkIfAns(Request $request)
    {

        $ip = $request->ip();

        $user = UserSite::where('key', $ip)->first();

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


    public function checkResponsePanel(Request $request)
    {
            $userId = $request->input('user_id');
            $siteId = $request->input('site_id');

            $responseMsg = msg::where('user_id', $userId)->where('site_id',$siteId)->where('userStatus', 1)->where('sendStatus',0)->orderBy("created_at",'ASC')->get();

            if (count($responseMsg) > 0) {
                msg::whereIn('id',$responseMsg->pluck('id'))->update(['sendStatus'=>1]);
                return response()->json([
                    'status' => true,
                    'userText' => view('messages.adminLeftEach', get_defined_vars())->render(),
                ]);
            }
            else {
                return response()->json([
                    'status' => true,
                ]);
            }

        return response()->json([
            'status' => false
        ]);
    }

    public function history(Request $request)
    {

        $ip = $request->ip();
        $user = UserSite::where('key',$ip)->first();

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
                    'name'=>$siteCheck->site_user_name ?? 'Yolly Man',
                    'role'=>$siteCheck->site_user_role ?? 'Your own assistent',
                    'image'=>$siteCheck->site_image ?? asset('/images/no-person.svg'),
                ]);
        }
        return response()->json([
            'status' => false
        ]);
    }

    public function changeChat(Request $request)
    {
        $userId = $request->input('user_id');
        $siteId = $request->input('site_id');

        $responseMsg = msg::where('user_id', $userId)->where('site_id', $siteId)->orderBy("created_at", 'ASC')->get();

        if (count($responseMsg) > 0) {
            msg::whereIn('id', $responseMsg->pluck('id'))->update(['sendStatus' => 1]);
            return response()->json([
                'status' => true,
                'userText' => view('messages.adminChatEach', get_defined_vars())->render(),
            ]);
        } else {
            return response()->json([
                'status' => true,
            ]);
        }

        return response()->json([
            'status' => false
        ]);
    }
}
