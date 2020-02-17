<?php

namespace App\Http\Controllers;

use App\Http\Services\TaskServices;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    private $taskService;

    public function __construct(TaskServices $taskService)
    {
        $this->taskService= $taskService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(/*Project $projectId*/)
    {
        //TODO:
        $tasks = $this->taskService->getTasksList();

        return redirect('/projects');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->taskService->createTask($request);

        return redirect("/projects/$request->projectId");
    }

    /**
     * Display the specified resource.
     *
     * @param int $taskId
     * @return \Illuminate\Http\Response
     */
    public function show(int $taskId)
    {
        $task = $this->taskService->getTask($taskId);

        return view('Tasks.task', [
            'task' => $task,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $taskId
     * @return \Illuminate\Http\Response
     */
    public function edit(int $taskId)
    {
        $task = $this->taskService->getTask($taskId);

        return view('Tasks.edit_task', [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param int $taskId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $taskId)
    {
        $this->taskService->updateTask($request, $taskId);

        return redirect("/projects/$request->project_id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $taskId
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(int $taskId)
    {
        $this->taskService->deleteTask($taskId);

        return redirect('/projects');
    }

    /**
     * @param $taskId
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function download(int $taskId)
    {
        $task = $this->taskService->getTask($taskId);

        return Storage::download($task->path);
    }

    /**
     * @param Request $request
     * @param $projectId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function statusSelect(Request $request, int $projectId)
    {
        $tasks = $this->taskService->statusSelectList($request, $projectId);

        return view('Tasks.tasks',[
            'tasks' => $tasks,
            ]);
    }
}
