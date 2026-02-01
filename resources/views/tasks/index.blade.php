@extends('layout.layout')
@section('title', 'My Todo List')
@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">My Todo List</h1>
        <a href="{{ route('tasks.create') }}"
           class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition duration-300">
            + Create New Task
        </a>
    </div>

    @if(session('success'))
        <div class="p-4 bg-green-100 text-green-700 rounded-lg border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    @if($tasks->count() > 0)
        <div class="space-y-4">
            @foreach($tasks as $task)
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                <div class="flex justify-between items-start">
                    <div class="space-y-2">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $task->title }}</h3>
                        @if($task->description)
                            <p class="text-gray-600">{{ Str::limit($task->description, 100) }}</p>
                        @endif
                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                {{ $task->user->name ?? 'Unknown' }}
                            </span>
                            @if($task->due_date)
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Due: {{ $task->due_date->format('M d, Y') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="flex space-x-2">
                        <a href="{{ route('tasks.edit', $task) }}"
                           class="px-3 py-1 bg-amber-100 text-amber-700 rounded-lg hover:bg-amber-200 transition duration-300">
                            Edit
                        </a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-3 py-1 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition duration-300"
                                    onclick="return confirm('Delete this task?')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination Links --}}
        @if($tasks->hasPages())
            <div class="mt-6">
                {{ $tasks->links() }}
            </div>
        @endif

    @else
        <div class="bg-white rounded-xl shadow-lg p-8 text-center">
            <p class="text-gray-600 mb-4">No tasks found.</p>
            <a href="{{ route('tasks.create') }}"
               class="inline-block px-6 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition duration-300">
                Create your first task!
            </a>
        </div>
    @endif
</div>
@endsection
