<?php

namespace App\Http\Controllers\User;

use App\Form;
use App\Http\Controllers\Controller;
use App\Input;
use App\Message;
use App\Message_id;
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
use Illuminate\Support\Facades\Mail;
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

        $query = Msg::where('user_id', $userId)->where('site_id', $siteId)->where('userStatus', 1)->where('sendStatus', 0)->orderBy("created_at", 'ASC')->get();

        $responseMsg = $query;

        $data = [];

        if (count($newMsgStatus) > 0) {
            foreach ($newMsgStatus as $one_msg) {
                $data[] = [$one_msg->site_id, $one_msg->user_id];
            }
        }

        $view = view('messages.adminLeftEach', get_defined_vars())->render();

        Msg::whereIn('id', $query->pluck('id'))->update(['sendStatus' => 1]);
        Msg::whereIn('id', $newMsgStatus->pluck('id'))->update(['sendStatus' => 1]);

        return response()->json([
            'status' => true,
            'userText' => $view,
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
        $siteCheck = Sites::where('site_key', $request->input('site_key'))->first();
        if ($siteCheck) {
            $domain = str_contains($request->server()['HTTP_ORIGIN'], '/' . $siteCheck->site_route);
            if($domain == false){
                $domain = str_contains($request->server()['HTTP_ORIGIN'], '.' . $siteCheck->site_route);
            }

            if ($domain == true || $siteCheck->test_status == 1) {
                $newOrNot = false;
                $newSession = false;
                $formStatus = false;
                $formBlock = '';

                $ip = $request->ip();
                $user = UserSite::where('key', $request->input('session'))->where('site_id', $siteCheck->id)->first();

                if (!$user) {
                    $user = new UserSite();
                    $user->key = Uuid::uuid4();
                    $user->site_id = $siteCheck->id;
                    $user->push();
                    $newOrNot = true;
                    $newSession = true;
                }


                $form = Form::where('formkey', $request->input('form_key'))->first();

                if ($form) {
                    $inputs = Input::where('form_id', $form->id)->orderBy('position','asc')->get();
                    $formStatus = true;
                    if($request->input('type') == 'static'){
                        $formBlock = view('forms.formRenderStatic', ['inputs' => $inputs, 'form' => $form])->render();
                    }
                    else {
                        $formBlock = view('forms.formRender', ['inputs' => $inputs, 'form' => $form])->render();
                    }
                }

                return response()->json([
                    'status' => true,
                    'session' => $newSession,
                    'sessionYolly' => $user->key,
                    'user' => $newOrNot,
                    'form' => $formBlock,
                    'form_status' => $formStatus,

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

    public function sendForm(Request $request, $formkey, $session)
    {

        $messages = $request->input('form');

        $user = UserSite::where('key', $session)->first();

        $newMsgMain = new Message_id();

        $newMsgMain->user_id = $user->id;
        $newMsgMain->site_id = $user->site_id;

        $newMsgMain->push();

        $form = Form::where('formkey', $formkey)->first();

        if ($form) {

            foreach ($messages as $msg) {
                if (Input::where('form_id', $form->id)->where('id', $msg['name'])->first()) {

                    $newMsg = new Message();

                    $newMsg->message_id = $newMsgMain->id;
                    $newMsg->input_id = $msg['name'];
                    $newMsg->msg_value = $msg['value'];

                    $newMsg->save();
                }
                else {
                    return response()->json(['status'=>false]);
                }
            }
            $site = Sites::where('id',$user->site_id)->first();
            $userHost = User::where('id',$site->user_id)->first();
            $feedbackList = Message_id::where('id',$newMsgMain->id)->with('children')->first();

            Mail::send('mailForms.newFeedback', ['user' => $userHost,'site'=>$site,'messages'=>$feedbackList], function ($m) use ($userHost) {
                $m->to($userHost->email, $userHost->first_name)->subject("You got new message from you website");
            });


            return response()->json(['status'=>true]);
        }
        return response()->json(['status'=>false]);

    }
}
