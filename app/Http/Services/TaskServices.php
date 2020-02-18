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
use App\Models\Project;

class TaskServices
{
    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getTasksList()
    {
        $tasks = DB::table('tasks')->paginate(10);

        return $tasks;
    }

    /**
     * @param int $taskId
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function getTask(Task $task)
    {
        $task = Task::query()->findOrFail($task->id);

        return $task;
    }

    /**
     * @param Request $request
     * @param int $taskId
     */
    public function updateTask(Request $request, int $taskId)
    {
        $task = Task::query()->findOrFail($taskId);
        $task->task = $request->task;
        $task->status = $request->status;
        $task->save();
    }


    /**
     * @param Request $request
     * @return Task
     */
    public function createTask(Request $request, Project $project)
    {
        $task = new Task();
        $task->task = request('task');
        $task->project_id = $project->id;
        if (!empty($request->user_file)) {
            $request->user_file->store('tasks_files');
            $task->path = $request->user_file->store('tasks_files');
        }
        $task->save();

        return $task;
    }

    /**
     * @param int $taskId
     * @throws \Exception
     */
    public function deleteTask(int $taskId)
    {
        Task::query()->findOrFail($taskId)->delete();
    }

    /**
     * @param $request
     * @param $projectId
     * @return Task[]|\Illuminate\Database\Eloquent\Collection
     */
    public function statusSelectList($request, $projectId)
    {
        $tasks = Task::all()->where('status', $request->status)->where('project_id', $projectId);

        return $tasks;
    }

}