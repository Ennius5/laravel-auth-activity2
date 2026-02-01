@extends('layout.layout')
@section('title', 'Create New Task')
@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Create New Task</h1>
        <a href="{{ route('tasks.index') }}"
           class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-300">
            ← Back to Tasks
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6">
        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Task Title *
                </label>
                <input type="text"
                       id="title"
                       name="title"
                       value="{{ old('title') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 @error('title') border-red-500 @enderror"
                       required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>


                <div>
                    <label for="due_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Due Date
                    </label>
                    <input type="date"
                           id="due_date"
                           name="due_date"
                           value="{{ old('due_date') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                </div>
            </div>

            <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                <a href="{{ route('tasks.index') }}"
                   class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-300">
                    Cancel
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition duration-300">
                    Create Task
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
