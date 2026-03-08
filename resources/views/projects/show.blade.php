<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ $project->name }}
    </h2>
  </x-slot>

<div class="py-4">
  <div class="max-w-2x1 mx-auto sm:px-6 lg:px-8">
    @include('helpers.flash')

    @include('tasks._form', ['project' => $project])

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6">
        <table class="w-full bg-white shadow rounded">
            <thead class="bg-gray-100">
              <tr>
                <th class="p-2">Done</th>
                <th class="p-2 text-left">Title</th>
                <th class="p-2 text-left">Due Date</th>
                <th class="p-2">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($tasks as $task)
                <tr class="border-b">
                  <td class="p-2 text-center">
                    <form action="{{ route('tasks.toggle', [$project->id, $task->id]) }}" method="POST">
                      @csrf
                      @method('PATCH')

                      <input
                        type="checkbox"
                        onchange="this.form.submit()"
                        {{ $task->is_done ? 'checked' : '' }}
                        class="h-5 w-5 text-green-600 rounded"
                      >
                    </form>
                  </td>
                  <td class="p-2">{{ $task->title }}</td>
                  <td class="p-2">{{ $task->due_date?->format('Y-m-d') ?? '-' }}</td>
                  <td class="flex gap-2 p-2 text-center">
                    <button
                      class="flex items-center gap-2 bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600"
                      onclick="document.getElementById('edit-task-{{ $task->id }}').classList.remove('hidden')"
                    >
                      <x-icons.edit/> Edit
                    </button>

                    <form action="{{ route('tasks.destroy', [$project->id, $task->id]) }}" method="POST" class="inline-block">
                      @csrf
                      @method('DELETE')
                      <button
                        class="flex items-center gap-2 bg-red-500 text-white px-3 py-1 rounded hover:bg-yellow-600"
                        onclick="return confirm('Delete this task?')">
                        <x-icons.delete/> Delete
                      </button>
                    </form>

                    <!--task edit-->
                    <div id="edit-task-{{ $task->id }}" class="hidden mt-2">
                      <form action="{{ route('tasks.update', [$project->id, $task->id]) }}" method="POST" class="flex gap-2">
                        @csrf
                        @method('PATCH')
                        <input type="text" name="title" id="title" value="{{ $task->title }}" class="border border-gray-300 p-1 rounded flex-1">
                        <input type="date" name="due_date" id="due_date" value="{{ $task->due_date?->format('Y-m-d') }}" class="border border-gray-300 p-1 rounded">
                        <button type="submit" class="bg-yellow-500 text-white px-2 rounded hover:bg-yellow-600">Update</button>
                        <button type="button" onclick="document.getElementById('edit-task-{{ $task->id }}').classList.add('hidden')" class="px-2 rounded border">Cancel</button>
                      </form>
                    </div>
                  </td>
                </tr>
                @empty
                  <tr>
                    <td colspan="4" class="p-2 text-center text-gray-500">No tasks found</td>
                  </tr>
                @endforelse
            </tbody>
          </table>
      </div>

    </div>
  </div>
</div>
</x-app-layout>