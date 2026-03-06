<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Services\ProjectService;
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    protected $projectService;
    protected $taskService;

    public function __construct(ProjectService $projectService, TaskService $taskService)
    {
        $this->projectService = $projectService;
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = $this->projectService->getUserProjects(Auth::user()->id);
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $this->projectService->createProject($data);
        return redirect()
            ->route('projects.index')
            ->with('success','Project created successfully');
    }

    /**
     * Display project with tasks
     */
    public function show(Project $project)
    {
        $this->authorize('view', $project);
        $tasks = $this->taskService->getProjectTasks($project->id);
        return view('projects.show', compact('project','tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $this->authorize('update', $project);
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $this->authorize('update', $project);
        $this->projectService->updateProject(
                $project->id,
                $request->validated()
        );
        return redirect()
            ->route('projects.index')
            ->with('success','Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);
        $this->projectService->deleteProject($project->id);
        return redirect()
            ->route('projects.index')
            ->with('success','Project deleted successfully');
    }
}