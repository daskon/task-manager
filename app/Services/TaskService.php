<?php

namespace App\Services;

use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class TaskService {

  protected $taskRepo;

  public function __construct(TaskRepositoryInterface $taskRepo)
  {
    $this->taskRepo = $taskRepo;
  }

  /**
   * get Project Tasks
   *
   * @param  mixed $projectId
   * @return void
   */
  public function getProjectTasks(int $projectId)
  {
    return Cache::remember(
      "project_tasks_$projectId",
      60,
      fn() => $this->taskRepo->getProjectTasks($projectId)
    );
  }

  /**
   * create Task
   *
   * @param  mixed $data
   * @return void
   */
  public function createTask(array $data)
  {
    $task = $this->taskRepo->create($data);
    $project = $task->project;
    Cache::forget("user_projects_". $project->user_id);
    Cache::forget("project_tasks_". $project->id);
    return $task;
  }

  /**
   * update Task
   *
   * @param  mixed $taskId
   * @param  mixed $data
   * @return void
   */
  public function updateTask(int $taskId, array $data)
  {
    $task = $this->taskRepo->update($taskId, $data);
    $project = $task->project;
    Cache::forget("user_projects_". $project->user_id);
    Cache::forget("project_tasks_". $project->id);
    return $task;
  }

  /**
   * delete Task
   *
   * @param  mixed $taskId
   * @return void
   */
  public function deleteTask(int $taskId)
  {
    $task = $this->taskRepo->delete($taskId);
    $project = $task->project;
    Cache::forget("project_tasks_". $project->id);
    return $task;
  }

  /**
   * find Task
   *
   * @param  mixed $taskId
   * @return void
   */
  public function findTask(int $taskId)
  {
    return $this->taskRepo->find($taskId);
  }

  /**
   * toggle task completion status
   *
   * @param  mixed $taskId
   * @return void
   */
  public function toggleDone(int $projectId, int $taskId)
  {
    $task = $this->taskRepo->find($taskId);
    Cache::forget("project_tasks_". $projectId);
    return $this->taskRepo->update($taskId,[
      'is_done' => !$task->is_done
    ]);
  }

}