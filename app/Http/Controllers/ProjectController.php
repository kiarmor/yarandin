<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Services\ProjectServices;
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
    public function index()
    {
        $projects = $this->projectService->getProjectsList();
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

        return view('Projects.project', ['project' => $project]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project $project
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($projectId, Request $request)
    {
        $this->projectService->deleteProject($projectId);

        return redirect('/projects');
    }
}
