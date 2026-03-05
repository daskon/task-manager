<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use ProjectService;
use TaskService;

class TaskController extends Controller
{
    protected $taskService;
    protected $projectService;

    public function __construct(TaskService $taskService, ProjectService $projectService)
    {
        $this->taskService = $taskService;
        $this->projectService = $projectService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = $this->taskService->getProjectTasks(Auth::user()->id);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request, Project $project)
    {
        $this->authorize('update', $request);
        $data = $request->validated();
        $data['project_id'] = $project->id;

        $this->taskService->createTask($data);

        return redirect()
            ->route('projects.show', $project->id)
            ->with('success', 'Task created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task->project);

        $this->taskService->updateTask(
            $task->id,
            $request->only('title', 'due_date')
        );

        return back()->with('success', 'Task Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task->project);

        $projectId = $task->project_id;

        $this->taskService->deleteTask($task->id);

        return redirect()
            ->route('projects.show', $projectId)
            ->with('success', 'Task deleted');
    }

    /**
     * mark task completed
     *
     * @param  mixed $task
     * @return void
     */
    public function markDone(Task $task)
    {
        $this->authorize('update', $task->project);

        $this->taskService->markDone($task->id);

        return back()->with('success', 'Task marked as done');
    }
}
