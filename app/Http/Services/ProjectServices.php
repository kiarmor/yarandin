<?php
/**
 * Created by PhpStorm.
 * User: Security
 * Date: 12.02.2020
 * Time: 9:59
 */

namespace App\Http\Services;


use App\Models\Project;
use Illuminate\Support\Facades\DB;

class ProjectServices
{
    public function getProjectsList()
    {
        $projects = DB::table('projects')->paginate(10);

        return $projects;
    }

    public function createProject()
    {
        $project = new Project();

        $project->project_name = request('project_name');
        $project->description = request('description');
        $project->save();

        return $project;
    }

    public function getProject(int $projectId)
    {
        $project = Project::query()->findOrFail($projectId);

        return $project;
    }

    public function deleteProject(int $projectId)
    {
        Project::query()->findOrFail($projectId)->delete();
    }

}