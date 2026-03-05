<?php

namespace App\Repositories\Interfaces;

interface TaskRepositoryInterface {
  public function getProjectTasks(int $projectId);
  public function create(array $data);
  public function update(int $taskId, array $data);
  public function delete(int $taskId);
  public function find(int $taskId);
}