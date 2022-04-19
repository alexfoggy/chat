<?php

namespace App\Http\Controllers\Admin;

use App\Events\TaskCounterEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Http\Services\ProjectService;
use App\Models\Country;
use App\Models\Language;
use App\Models\Project;
use App\Models\Sites;
use App\Models\TasksRelation;
use App\Notifications\NewTaskNotification;
use App\Pool_ans;
use App\Pool_ans_id;
use App\Pool_checkbox;
use App\Pool_question;
use App\Pools;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;
use function RingCentral\Psr7\str;

class PoolsController extends Controller
{

    public function __construct()
    {

    }

    public function poolsList()
    {

        $pools = Pools::where('user_id', Auth::user()->id)->get();

        return view('admin/speaker/poolslist', get_defined_vars());
    }

    public function newPoolPage()
    {


        return view('admin/speaker/newpool', get_defined_vars());
    }

    public function poolPage($key)
    {

        $pool = Pools::where('key', $key)->first();

        return view('admin/speaker/poolPage', get_defined_vars());
    }

    public function poolPageView($key)
    {

        $pool = Pools::where('key', $key)->first();

        $ques = Pool_question::where('pool_id',$pool->id)->with('checkbox')->orderBy('id')->get();

        return view('admin/speaker/poolPageView', get_defined_vars());
    }

    public function poolPageEdit($key){
        $pool = Pools::where('key', $key)->first();

        $ques = Pool_question::where('pool_id',$pool->id)->with('checkbox')->orderBy('id')->get();

        return view('admin/speaker/poolPageEdit', get_defined_vars());
    }

    public function createPool(Request $request)
    {

        $pool = Pools::updateOrCreate([
            'id' => $request->input('id'),
            'user_id' => Auth::user()->id,
        ], [
            'title' => $request->input('title'),
            'theme' => $request->input('theme'),
            'status' => $request->input('status') == 'on' ? 1 : 0,
            'key' => Uuid::uuid4()
        ]);


        return redirect('/cabinet/pool/' . $pool->key);

    }

    public function savePool(Request $request,$key)
    {
        $pool = Pools::where('key',$key)->first();

        $poolQus = $request->input('question');
        $poolChek = $request->input('checkbox');

        foreach ($poolQus as $key => $value){

            $qus = Pool_question::updateOrCreate([
                'id'=>$key
            ],[
                'title'=>$value,
                'status'=>1,
                'pool_id'=>$pool->id,
                'type'=>'one'
            ]);

            foreach($poolChek[$key] as $id => $value){

                $qws = Pool_checkbox::updateOrCreate([
                    'id'=>$id,
                    'pool_question_id'=>$qus->id,
                ],[
                    'title'=>$value,
                ]);
            }
        }

        return redirect('/cabinet/pool/view/' . $pool->key);

    }

    public function deletePool($id){
        Pools::where('id',$id)->where('user_id',Auth::user()->id)->delete();


        return response()->json(['status'=>true]);
    }

    public function poolAsk($key){
        $pool = Pools::where('key', $key)->first();

        $ques = Pool_question::where('pool_id',$pool->id)->with('checkbox')->orderBy('id')->get();

        return view('admin/speaker/poolAsk', get_defined_vars());
    }

    public function poolSave(Request $request,$key){

        $pool = Pools::where('key',$key)->first();

        $newAns = new Pool_ans_id();
        $newAns->pools_id = $pool->id;
        $newAns->save();

        foreach ($request->input('value') as $one_value){
            $ans = new Pool_ans();
            //$ans->value = $one_value;
            $ans->ans_id = $newAns->id;
            $ans->checkbox_id = $one_value;
            $ans->save();
        }

        return redirect('/pool/'.$key)->with('status',true);

    }

    public function poolPageAnswers($key){

        $pool = Pools::where('key',$key)->first();

        $pool_ans_id = Pool_ans_id::where('pools_id',$pool->id)->get();

        return view('admin/speaker/answers', get_defined_vars());
    }


}
