<?php

use App\Repositories\Interfaces\ProjectRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class ProjectService{

  protected $projectRepo;

  public function __construct(ProjectRepositoryInterface $projectRepo)
  {
    $this->projectRepo = $projectRepo;
  }

  /**
   * get User Projects
   *
   * @param  mixed $userId
   * @return void
   */
  public function getUserProjects(int $userId)
  {
    return Cache::remember(
      "user_projects_$userId",
      60,
      fn() => $this->projectRepo->getUserProjects($userId)
    );
  }

  /**
   * create Porject
   *
   * @param  mixed $data
   * @return void
   */
  public function createProject(array $data)
  {
    $project = $this->projectRepo->create($data);
    Cache::forget("user_projects_".$data['user_id']);
    return $project;
  }

  /**
   * delete Project
   *
   * @param  mixed $projectId
   * @return void
   */
  public function deleteProject(int $projectId)
  {
    $project = $this->projectRepo->delete($projectId);
    Cache::forget("user_projects_".$project->user_id);
    return $project;
  }

  /**
   * update Project
   *
   * @param  mixed $projectId
   * @param  mixed $data
   * @return void
   */
  public function updateProject(int $projectId, array $data)
  {
    $project = $this->projectRepo->update($projectId, $data);
    Cache::forget("user_projects_".$project->user_id);
    return $project;
  }

  /**
   * find User Project
   *
   * @param  mixed $projectId
   * @param  mixed $userId
   * @return void
   */
  public function findUserProject(int $projectId, int $userId)
  {
    return $this->projectRepo->findUserProject($projectId, $userId);
  }

}