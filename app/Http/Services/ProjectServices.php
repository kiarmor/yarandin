<?php
/**
 * Created by PhpStorm.
 * User: Security
 * Date: 12.02.2020
 * Time: 9:59
 */

namespace App\Http\Services;


use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectServices
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getProjectsList(Request $request)
    {
        $projects = DB::table('projects')->where('user_id', $request->user()->id)->paginate(10);

        return $projects;
    }

    /**
     * @param Request $request
     * @return Project
     */
    public function createProject(Request $request)
    {
        $project = new Project();

        $project->project_name = request('project_name');
        $project->description = request('description');
        $project->user_id = $request->user()->id;
        $project->save();

        return $project;
    }

    /**
     * @param Project $project
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function getProject(Project $project)
    {
        $project = Project::query()->findOrFail($project->id);

        return $project;
    }

    public function deleteProject(Project $project)
    {
        Project::query()->findOrFail($project->id)->delete();
    }

    /**
     * @param Request $request
     * @param Project $project
     */
    public function updateProject(Request $request, Project $project)
    {

        $project = Project::query()->findOrFail($project->id);
        $project->project_name = $request->project_name;
        $project->description = $request->description;
        $project->save();

    }
}
