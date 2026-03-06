<x-app-layout>

<x-slot name="header">
  <div class="flex justify-between items-center">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('My Projects') }}
    </h2>

    <a href="{{ route('projects.create') }}"
        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Create Project
    </a>
  </div>
</x-slot>

<div class="p-6">
  <div class="max-w-7x1 max-auto sm:px-6 lg:px-8">
    @include('helpers.flash')

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6">
        <table class="w-full bg-white shadow rounded">
            <thead class="bg-gray-100">
              <tr>
                <th class="py-2 px-4 border-b text-left">Project Name</th>
                <th class="py-2 px-4 border-b text-left">Tasks Count</th>
                <th class="py-2 px-4 border-b ">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($projects as $project)
                <tr class="border-b">
                  <td class="p-2">
                    <a href="{{ route('projects.show', $project->id) }}" class="text-blue-500 hover:underline">
                      {{ $project->name }}
                    </a>
                  </td>
                  <td class="p-2">{{ $project->tasks_count ?? 0 }}</td>
                  <td class="p-2 text-center">
                    <a href="{{ route('projects.edit', $project->id) }}"
                        class="bg-yellow-500 text-white px-3 py-[7px] rounded hover:bg-yellow-600">Edit</a>
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="inline-block"
                        onsubmit="return confirm('Are you sure you want to delete this project?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="3" class="p-4 text-center text-gray-500">No projects found. Create your first project!</td>
                </tr>
              @endforelse
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>
</x-app-layout>