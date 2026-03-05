<?php

namespace App\Repositories\Eloquent;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;

class EloquentTaskRepository implements TaskRepositoryInterface {

  /**
   * get Project Tasks
   *
   * @param  mixed $projectId
   * @return void
   */
  public function getProjectTasks(int $projectId)
  {
    return Task::where('project_id', $projectId)->get();
  }

  /**
   * create task
   *
   * @param  mixed $data
   * @return void
   */
  public function create(array $data)
  {
    return Task::create($data);
  }

  /**
   * update
   *
   * @param  mixed $taskId
   * @param  mixed $data
   * @return void
   */
  public function update(int $taskId, array $data)
  {
    $task = Task::findOrFail($taskId);
    $task->update($task);
    return $task;
  }

  /**
   * delete
   *
   * @param  mixed $taskId
   * @return void
   */
  public function delete(int $taskId)
  {
    return Task::destroy($taskId);
  }

  /**
   * find
   *
   * @param  mixed $taskId
   * @return void
   */
  public function find(int $taskId)
  {
    return Task::findOrFail($taskId);
  }
}