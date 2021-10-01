<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;

class Tasks extends Controller
{
    protected $dbtasks;

    public function __construct(Task $dbtasks)
    {
        $this->dbtasks = $dbtasks;
    }   

    public function index()
    {
        $tasks = \App\Models\Task::get();

        return view('task', ['tasks'=>$tasks]);
    }

    public function store()
    {


        $task = new $this->dbtasks;

        $task->title_task = request('title_task');
        $task->descr_task = request('descr_task');
        $task->name_resp_task = request('name_resp_task');
        $task->email_resp_task = request('email_resp_task');

        if($task->save()):
            return json_encode(['response'=>'success']);
        else:
            return json_encode(['response'=>'error', 'message'=>"Não foi possivel registrar esta tarefa, tente novamente!"]);
        endif;
    }

    public function movetask($id)
    {
       if(!$task = $this->dbtasks->find($id))
       {
           return json_encode(['response'=>'error','message'=>'Tarefa não encontrada!']);
       } 

       $task->status_task = request('status');

       if(request('status') == 1)
        $task->change_count_task = $task->change_count_task +1;

       if($task->save()):
            return json_encode(['response'=>'success']);
       else:
            return json_encode(['response'=>'error', 'message'=>"Não foi possivel concluir a tarefa, tente novamente!"]);
       endif;

    }

    public function destroy($id)
    {
        if(!$task = $this->dbtasks->find($id))
        {
            return json_encode(['response'=>'error','message'=>'Tarefa não encontrada!']);
        }

        $task->first()->delete();

        return json_encode(['response'=>'success']);
    }
}
