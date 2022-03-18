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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

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

        $avatar = null;
        if ($request->file()) {
            Validator::make($request->file(),[
                'avatar' => 'required|image',
            ]);

            $path = "/avatar";
            $file = $request->file();

            $avatar = Storage::disk('public')->putFileAs($path, $file['avatar'], $request->input('site_user_name').'_' . $request->input('site_route') . '_' . $file['avatar']->getClientOriginalName());

            $file = Image::make(Storage::disk('public')->path($avatar));
            $file->resize(60, 60, function ($constraint) {
                $constraint->aspectRatio();
            });
            $file->save(Storage::disk('public')->path($avatar));

        }

        $newSite = Sites::updateOrCreate([
            'user_id'=>Auth::user()->id,
            'id'=>$request->input('id')
        ],[
            'site_route'=>$request->input('site_route'),
            'site_user_name'=>$request->input('site_user_name') ?? 'Help assistent',
            'site_user_role'=>$request->input('site_user_role') ?? 'I/m here to help you',
            'site_key'=>\Ramsey\Uuid\Nonstandard\Uuid::uuid4(),
            'site_image'=>$avatar,
            'test_status'=>'0',
        ]);

       /* $newSite = new Sites();

        $newSite->user_id = Auth::user()->id;
        $newSite->site_route = $request->input('site_route');
        $newSite->site_user_name = $request->input('site_user_name') ?? 'Help assistent';
        $newSite->site_user_role = $request->input('site_user_role') ?? 'I/m here to help you';
        $newSite->site_key = \Ramsey\Uuid\Nonstandard\Uuid::uuid4();
        $newSite->test_status = '0';

        $newSite->push();*/

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

    public function deleteDomain(Request $request){

        $id = $request->input('id');

        $site = Sites::where('id',$id)->where('user_id',Auth::user()->id)->first();

        if($site){
            if($site->site_route == $request->input('site_route')){
                $site->delete();
                return redirect('/cabinet/domains/')->with('status',['msg'=>'Domain '.$request->input('site_route').' was successfuly deleted','type'=>'success']);

            }
            return redirect('/cabinet/domain/'.$id.'#deleteDomain')->with('error_domain',['msg'=>'Incorect domain name','type'=>'danger']);

        }

        return redirect('/cabinet/domain/'.$id)->with('status',['msg'=>'You have no access to do this action','type'=>'danger']);
    }



}
