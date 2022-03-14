<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Task;
use App\Http\Services\NotificationService;
use App\Models\TasksRelation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    private $notifService;

    public function __construct(NotificationService $notifService)
    {
        $this->notifService = $notifService;
    }

    public function getProfile()
    {
        return new UserResource(Auth::user());  //todo check this functionality
    }

    public function getProfileUser($id)
    {
        $user_profile = User::where('id', $id)->first();

        $userTasks = Task::where('user_id', $id)->get();

        return view('admin.manager.userInfo', get_defined_vars());
    }

    public function changePass(Request $request)
    {

        $valid = Validator::make($request->input(), [
            'old_pass' => 'required',
            'new_pass' => 'required|confirmed|min:8',
        ]);
        if ($valid->fails()) {
            $msg = '';
            foreach ($valid->errors()->messages() as $one_msg) {
                $msg .= $one_msg['0'] . '<br>' . $msg;
            }
            return redirect($request->segment(1).'/settings')->with('status', ['type' => 'warning', 'msg' => $msg]);
        }

        if($request->get('old_pass') == $request->get('new_pass')){
            return redirect($request->segment(1).'/settings')->with('status', ['type' => 'danger', 'msg' => 'New password cannot be as old one']);
        }

        if ($valid) {

            if (Auth::attempt(['email' => Auth::user()->email, 'password' => $request->get('old_pass')], true)) {

                Auth::user()->update(['password' => Hash::make($request->input('new_pass'))]);

                $this->notifService->notify(Auth::user(), 'success', 'Your password successfully has been changed', false);

                $user = Auth::user();

                Mail::send('mailForms.passChanged', ['user' => $user], function ($m) use ($user) {
                    $m->to($user->email,$user->first_name)->subject("You successfully changed you password");
                });

                return redirect($request->segment(1).'/settings')->with('status', ['type' => 'success', 'msg' => 'Password has been changed with success']);

            } else {
                return redirect($request->segment(1).'/settings')->with('status', ['type' => 'danger', 'msg' => 'Old password does not match']);
            }
        }
    }

    public function paypalChangeEmail()
    {

        $user = Auth::user();

        Mail::send('mailForms.paypalChange', ['user' => $user], function ($m) use ($user) {
            $m->to($user->email, $user->first_name)->subject("Paypal change email");
        });

        return redirect('cabinet/settings')->with('status', ['type' => 'success', 'msg' => 'Your request was send']);

    }

    public function paypalChangeEmailSave(Request $request)
    {

        $valid = Validator::make($request->input(), [
            'email_paypal' => 'required|email|confirmed',
        ]);

        $user = User::where('id',Auth::user()->id)->first();

        $user->update(['paypal' => $request->input('email_paypal'), 'token'=>generateToken()]);

        return redirect('cabinet/settings')->with('status', ['type' => 'success', 'msg' => 'Paypal email has been changed']);

    }

    public function paypalEmailPage($token)
    {

        $user = User::where('token', $token)->first();
        if ($user) {
            Auth::loginUsingId($user->id, true);

            return view('admin.speaker.paypalChange', get_defined_vars());
        } else {
            return redirect('/cabinet');
        }
    }
}
