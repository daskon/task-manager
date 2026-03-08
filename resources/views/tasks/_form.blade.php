<div class="mb-4">
  <form action="{{ route('tasks.store', $project->id) }}" method="POST" class="flex gap-2">
    @csrf
    <input type="text" name="title" placeholder="Task Title"
      class="flex-1 border border-gray-300 p-2 rounded" required>
    <input
        type="date"
        name="due_date"
        class="border border-gray-300 p-2 rounded"
        min="{{ date('Y-m-d') }}"
    >
    <button type="submit" class="flex items-center gap-2 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
      <x-icons.plus /> Add Task
    </button>
  </form>
  @include('helpers.errors')
</div>