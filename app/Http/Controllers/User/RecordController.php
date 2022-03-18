<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Msg;
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
        $site = Sites::where('site_key', $key)->first();

        $user = UserSite::where('key', $ip)->where('site_id', $site->id)->first();

        /*if (!$user) {
            $user = new UserSite();
            $user->key = $ip;
            $user->key = $ip;
            $user->push();
        }*/

        $newChat = Chat::where('user_id', $user->id)->where('site_id', $site->id)->first();

        if (!$newChat) {
            $newChat = new Chat();
            $newChat->user_id = $user->id;
            $newChat->site_id = $site->id;
            $newChat->save();
        }

        $newMsg = new Msg();

        $newMsg->msg = $msg;
        $newMsg->site_id = $site->id;
        $newMsg->chat_id = $newChat->id;
        $newMsg->userStatus = 1;
        $newMsg->user_id = $user->id;
        $newMsg->sendStatus = 0;

        $newMsg->save();

        return response()->json([
            'key' => $user->key,
            'status' => true,
            'userText' => view('messages.userMsg', get_defined_vars())->render(),
        ]);
    }

    public function sendmsgpanel(Request $request)
    {
        $msg = $request->input('msg');
        $site_id = $request->input('site_id');
        $user_id = $request->input('user_id');

        $chat = Chat::where('user_id', $user_id)->where('site_id', $site_id)->first();

        $one_msg = new Msg();
        $one_msg->msg = $msg;
        $one_msg->userStatus = 2;
        $one_msg->chat_id = $chat->id;
        $one_msg->user_id = $user_id;
        $one_msg->sendStatus = 0;
        $one_msg->site_id = $site_id;
        $one_msg->push();

        return response()->json([
            'status' => true,
            'userText' => view('messages.adminRight', get_defined_vars())->render(),
        ]);
    }


    public function checkIfAns(Request $request)
    {

        $ip = $request->ip();
        $user = UserSite::where('key', $ip)->first();
        if ($user) {

            $responseMsg = Msg::where('user_id', $user->id)->where('userStatus', 2)->where('sendStatus', 0)->orderBy("created_at", 'ASC')->get();

            if ($responseMsg->isNotEmpty()) {
                Msg::whereIn('id', $responseMsg->pluck('id'))->update(['sendStatus' => 1]);
                //$responseMsg->update(['sendStatus'=>1]);
                return response()->json([
                    'status' => true,
                    'userText' => view('messages.assistMsg', get_defined_vars())->render(),
                ]);
            } else {
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


        $youid = $request->input('yourId');

        $sites = Sites::where('user_id', $youid)->select('id')->get()->toArray();
        $siteUsers = UserSite::whereIn('site_id', $sites)->select('id')->get()->toArray();

        $newMsgStatus = Msg::whereIn('user_id', $siteUsers)->whereIn('site_id', $sites)->where('userStatus', 1)->where('sendStatus', 0)->orderBy("created_at", 'ASC')->get();

        $responseMsg = Msg::where('user_id', $userId)->where('site_id', $siteId)->where('userStatus', 1)->where('sendStatus', 0)->orderBy("created_at", 'ASC')->get();

        $data = [];

        if (count($newMsgStatus) > 0) {
            Msg::whereIn('id', $newMsgStatus->pluck('id'))->update(['sendStatus' => 1]);

            foreach ($newMsgStatus as $one_msg) {
                $data[] = [$one_msg->site_id, $one_msg->user_id];
            }
        }

        Msg::whereIn('id', $responseMsg->pluck('id'))->update(['sendStatus' => 1]);
        return response()->json([
            'status' => true,
            'userText' => view('messages.adminLeftEach', get_defined_vars())->render(),
            'newMsg' => $data
        ]);
        /*  else {
             return response()->json([
                 'status' => true,
             ]);
         }*/

        return response()->json([
            'status' => false
        ]);
    }

    public function history(Request $request)
    {
        $ip = $request->ip();
        $user = UserSite::where('key', $ip)->first();
        $site = Sites::where('site_key', $request->input('key'))->first();
        $chat = Chat::where('user_id',$user->id)->where('site_id',$site->id)->select('id')->orderBy('created_at','DESC')->first();

        //dd($chat,$ip,$site,$user,Chat::get());

        if ($user) {
            $responseMsg = Msg::where('user_id', $user->id)->where('site_id', $site->id)->where('chat_id',$chat->id)->orderBy("created_at", 'ASC')->get();
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
        //dd($_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_X_FORWARDED_FOR']);

        $siteCheck = Sites::where('site_key', $request->input('key'))->first();
        if ($siteCheck) {
            $domain = str_contains($request->server()['HTTP_ORIGIN'], '/' . $siteCheck->site_route);
            if($domain == false){
                $domain = str_contains($request->server()['HTTP_ORIGIN'], '.' . $siteCheck->site_route);
            }

            if ($domain == true || $siteCheck->test_status == 1) {
                $newOrNot = false;
                $ip = $request->ip();
                $user = UserSite::where('key', $ip)->where('site_id', $siteCheck->id)->first();

                if (!$user) {
                    $user = new UserSite();
                    $user->key = $ip;
                    $user->site_id = $siteCheck->id;
                    $user->push();
                    $newOrNot = true;
                }

                return response()->json([
                    'status' => true,
                    'user' => $newOrNot,
                    'name' => $siteCheck->site_user_name ?? 'Yolly Man',
                    'role' => $siteCheck->site_user_role ?? 'Your own assistent',
                    'image' => $siteCheck->site_image ?? asset('/images/no-person.svg'),
                ]);
            }
            return response()->json([
                'status' => false,
                'msg'=>'domain is not in list'
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
            Msg::whereIn('id', $responseMsg->pluck('id'))->update(['sendStatus' => 1]);
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
