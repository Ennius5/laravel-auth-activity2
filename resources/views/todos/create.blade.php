@extends('layout.layout')
@section('title', 'Create New Task')
@section('content')
    <h1>Create New Task</h1>
    
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="user_id">Assign to User</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">Select a user</option>
                @foreach(\App\Models\User::all() as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="title">Task Title *</label>
            <input type="text" name="title" id="title" class="form-control" 
                   value="{{ old('title') }}" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" 
                      rows="4">{{ old('description') }}</textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Create Task</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
