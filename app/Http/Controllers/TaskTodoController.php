<?php

namespace App\Http\Controllers;

use App\Model\taskTodo;
use Illuminate\Http\Request;

class TaskTodoController extends Controller
{

    public function __construct()
    {
        $this->randomize();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $in_kegiatan=taskTodo::latest()->get();
        return view($this->taskFolder.'.index', compact('in_kegiatan') );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task=new taskTodo;
        $task->kd_task_todo= substr($this->randomize ,0,5);
        $task->kegiatan= $request->kegiatan;
        $task->save();

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\taskTodo  $taskTodo
     * @return \Illuminate\Http\Response
     */
    public function edit(taskTodo $taskTodo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\taskTodo  $taskTodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $task=taskTodo::find($id);
        if ($request->ubah_kegiatan) {
            $task->kegiatan=$request->ubah_kegiatan;
        }else{
            $task->selesai=time();
        }
        $task->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\taskTodo  $taskTodo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task=taskTodo::find($id);
        $task->delete();

        return redirect()->back();
    }
}
