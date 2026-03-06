<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use App\Services\ProjectService;
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;

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
        $this->authorize('update', $project);
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
    public function update(UpdateTaskRequest $request, Project $project, Task $task)
    {
        if($task->project_id != $project->id) {
            abort(404);
        }

        $this->authorize('update', $project);

        $this->taskService->updateTask(
            $task->id,
            $request->only('title', 'due_date')
        );

        return back()->with('success', 'Task Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, $taskId)
    {
        $this->authorize('update', $project);

        $task = $this->taskService->findTask($taskId);
        if (!$task || $task->project_id != $project->id) {
            abort(404);
        }

        $this->taskService->deleteTask($taskId);

        return redirect()
            ->route('projects.show', $project->id)
            ->with('success', 'Task deleted');
    }

    /**
     * toggle task completion status
     *
     * @param  mixed $task
     * @return void
     */
    public function toggleDone(Project $project, $taskId)
    {
        $this->authorize('update', $project);

        $this->taskService->toggleDone($project->id, $taskId);

        return back()->with('success', 'Task status updated');
    }

}
