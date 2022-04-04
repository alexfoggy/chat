<?php

namespace App\Http\Controllers;

use App\comment;
use Illuminate\Http\Request;

class Todo extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(\App\todo::orderBy('created_at','DESC')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $new = new \App\todo();

        $todoElement = \App\todo::updateOrCreate([
            'id'=>$request->json('id'),
        ],[
            'value'=> $request->json('valueInput'),
            'status'=> $request->json('status')
        ]);

        return response()->json($todoElement);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       $element = \App\todo::where('id',$request->json('id'))->update(['value'=>$request->json('updateValue')]);

       return response()->json(['status'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changestatus(Request $request)
    {
        $element = \App\todo::where('id',$request->json('id'))->update(['status'=>$request->json('status')]);

        return response()->json(['status'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        \App\todo::where('id',$request->json('id'))->delete();

        return response()->json(['status'=>true]);
    }

    public function commentShow($id){

        return response()->json(comment::where('todo_id',$id)->orderBy('created_at','DESC')->get());

    }
    public function commentCreate(Request $request){

        $comment = new comment();
        $comment->comment = $request->json('commentValue');
        $comment->todo_id = $request->json('id');
        $comment->save();

        return response()->json($comment);
    }
}
