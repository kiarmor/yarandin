<?php
/**
 * Created by PhpStorm.
 * User: Security
 * Date: 12.02.2020
 * Time: 17:43
 */

namespace App\Http\Services;


use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskServices
{
    public function getTasksList()
    {
        $tasks = DB::table('tasks')->paginate(10);

        return $tasks;

    }

    public function updateTask(Request $request, $taskId)
    {
       /* var_dump($request->status);
        die();*/
        $task = Task::query()->findOrFail($taskId);
        $task->status = $request->status;
        $task->save();
    }


    public function createTask(Request $request)
    {
        $task = new Task();
        $task->task = request('task');
        $task->project_id = request('projectId');
        $task->save();

        return $task;
    }

}