<?php

namespace App\Repositories\Eloquent;

use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepositoryInterface;

class EloquentProjectRepository implements ProjectRepositoryInterface {

  /**
   * getUserProjects
   *
   * @param  mixed $userId
   * @return void
   */
  public function getUserProjects(int $userId)
  {
    return Project::withCount('tasks')
        ->where('user_id', $userId)
        ->get();
  }

  /**
   * findUserProject
   *
   * @param  mixed $projectId
   * @param  mixed $userId
   * @return void
   */
  public function findUserProject(int $projectId, int $userId)
  {
    return Project::where('id', $projectId)
        ->where('user_id', $userId)
        ->firstOrFail();
  }

  /**
   * create
   *
   * @param  mixed $data
   * @return void
   */
  public function create(array $data)
  {
    return Project::create($data);
  }

  /**
   * update
   *
   * @param  mixed $projectId
   * @param  mixed $data
   * @return void
   */
  public function update(int $projectId, array $data)
  {
    $project = Project::findOrFail($projectId);
    $project->update($data);
    return $project;
  }

  /**
   * delete
   *
   * @param  mixed $projectId
   * @return void
   */
  public function delete(int $projectId)
  {
    $project = Project::findOrFail($projectId);
    $project->delete();
    return $project;
  }
}