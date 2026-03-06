<x-app-layout>

@section('content')
<div class="container mx-auto p-4 max-w-lg">
  @include('helpers.flash')
  @include('helpers.errors')

  <h1 class="text-xl font-bold mb-4">{{ isset($project) ? 'Edit' : 'Create' }}</h1>

  <form action="{{ isset($project) ? route('projects.update', $project->id) : route('projects.store') }}" method="POST">
    @csrf
    @if(isset($project))
        @method('PATCH')
    @endif

    <div class="mb-4">
      <label for="name" class="block mb-1 font-semibold">Project Name</label>
      <input type="text" name="name" id="name" value="{{ old('name', $project->name ?? '') }}"
              class="w-full border border-gray-300 p-2 rounded" required>
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
      {{ isset($project) ? 'Update' : 'Create' }}
    </button>
  </form>
</div>
</x-app-layout>