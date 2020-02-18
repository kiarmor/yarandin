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
     * @param Request $request
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
     * @param Project $project
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Project $project)
    {
        $this->authorize('update', $project);
        $project = $this->projectService->getProject($project);
        $tasks = Task::all()->where('project_id', $project->id); //remove from controller

        return view('Projects.project', [
            'project' => $project,
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Project $project
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Project $project)
    {
        $this->authorize('update', $project);
        $project = $this->projectService->getProject($project);

        return view('Projects.edit_project',[
            'project' => $project,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Project $project
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);
        $this->projectService->updateProject($request, $project);

        return redirect('/projects/' . $project->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Project $project)
    {
        $this->authorize('update', $project);
        $this->projectService->deleteProject($project);

        return redirect('/projects');
    }
}
