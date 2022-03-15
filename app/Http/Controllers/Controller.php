<?php

namespace App\Http\Controllers;

use App\Models\Sites;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
//use http\Client\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    public function createConnection(Request $request){

//        $valid = \Illuminate\Support\Facades\Validator::make($request->input(), [
//            'site_route' => 'required|unique:sites|regex:^(?!-)[A-Za-z0-9-]+([\\-\\.]{1}[a-z0-9]+)*\\.[A-Za-z]{2,6}$',
//        ]);
//        if ($valid->fails()) {
//            $msg = '';
//            foreach ($valid->errors()->messages() as $one_msg) {
//                $msg .= $one_msg['0'] . '<br>' . $msg;
//            }
//            return redirect('admin/create-user')->with('status', ['type' => 'danger', 'msg' => $msg]);
//        }

        $newSite = new Sites();

        $newSite->user_id = Auth::user()->id;
        $newSite->site_route = $request->input('site_route');
        $newSite->site_user_name = $request->input('site_user_name') ?? 'Help assistent';
        $newSite->site_user_role = $request->input('site_user_role') ?? 'I/m here to help you';
        $newSite->site_key = \Ramsey\Uuid\Nonstandard\Uuid::uuid4();
        $newSite->test_status = '0';

        $newSite->push();

        return redirect('/cabinet/domain/'.$newSite->id);
    }

    public function createConnectionTest(Request $request){

        $newSite = new Sites();

        $newSite->user_id = Auth::user()->id;
        $newSite->site_route = $request->ip();
        $newSite->site_user_name = 'Test Yolly';
        $newSite->site_user_role = 'I/m here to help you';
        $newSite->site_key = \Ramsey\Uuid\Nonstandard\Uuid::uuid4();
        $newSite->test_status = '1';

        $newSite->push();

        return redirect('/cabinet/domain/'.$newSite->id);
    }



}
