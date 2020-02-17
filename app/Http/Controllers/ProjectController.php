<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Services\ProjectServices;
use App\Models\Task;
use Illuminate\Http\Request;

/**
 * @property ProjectServices ProjectService
 */
class ProjectController extends Controller
{
    private $projectService;

    public function __construct(ProjectServices $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projects = $this->projectService->getProjectsList($request);
        return view('projects.projects', [
            'projects' => $projects,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->projectService->createProject($request);

        return redirect('/projects');
    }

    /**
     * Display the specified resource.
     *
     * @param $projectId
     * @return \Illuminate\Http\Response
     */
    public function show($projectId)
    {
        $project = $this->projectService->getProject($projectId);
        $tasks = Task::all()->where('project_id', $projectId); //remove from controller

        return view('Projects.project', [
            'project' => $project,
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $projectId
     * @return \Illuminate\Http\Response
     */
    public function edit($projectId)
    {
        $project = $this->projectService->getProject($projectId);

        return view('Projects.edit_project',[
            'project' => $project,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $projectId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $projectId)
    {
        $this->projectService->updateProject($request, $projectId);

        return redirect('/projects/' . $projectId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $projectId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($projectId)
    {
        $this->projectService->deleteProject($projectId);

        return redirect('/projects');
    }
}
