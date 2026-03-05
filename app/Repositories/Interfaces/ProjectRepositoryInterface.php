<?php

namespace App\Repositories\Interfaces;

interface ProjectRepositoryInterface{
  public function getUserProjects(int $userId);
  public function findUserProject(int $projectId, int $userId);
  public function create(array $data);
  public function update(int $projectId, array $data);
  public function delete(int $projectId);
}