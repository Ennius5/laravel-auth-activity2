@extends('layout.layout')
@section('title', 'My Todo List')
@section('content')
    <h1>All Tasks</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">
        Create New Task
    </a>

    @forelse($tasks as $task)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $task->title }}</h5>
                <p class="card-text">{{ Str::limit($task->description, 100) }}</p>
                <p class="text-muted">
                    Assigned to: {{ $task->user->name ?? 'Unknown' }}
                </p>
                <a href="{{ route('tasks.show', $task) }}" class="btn btn-info btn-sm">
                    View
                </a>
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning btn-sm">
                    Edit
                </a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                      style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Delete this task?')">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    @empty
        <p>No tasks found. <a href="{{ route('tasks.create') }}">Create your first task!</a></p>
    @endforelse

@endsection
