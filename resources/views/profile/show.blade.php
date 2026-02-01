@extends('layout.layout')
@section('title', 'My Profile')
@section('content')
<div class="space-y-8">
    <!-- Profile Header -->
    <div class="bg-gradient-to-r from-amber-700/90 to-amber-900/90 rounded-xl shadow-xl p-8 text-white">
        <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
            <!-- Profile Avatar -->
            <div class="flex-shrink-0">
                <div class="w-32 h-32 bg-amber-400 rounded-full flex items-center justify-center border-4 border-white shadow-lg">
                    <span class="text-4xl font-bold text-amber-900">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </span>
                </div>
            </div>

            <!-- Profile Info -->
            <div class="text-center md:text-left flex-1">
                <h1 class="text-3xl font-bold mb-2">Hi! I'm {{ Auth::user()->name }}</h1>
                <p class="text-amber-100 text-lg mb-4">
                    I am a busy person, so here's my tasks list!
                </p>
                <div class="flex flex-wrap gap-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2">
                        <span class="block text-sm text-amber-200">Member since</span>
                        <span class="text-xl font-bold">{{ Auth::user()->created_at->format('M Y') }}</span>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2">
                        <span class="block text-sm text-amber-200">Email</span>
                        <span class="text-xl font-bold">{{ Auth::user()->email }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                <h3 class="text-lg font-bold mb-4 text-center">Quick Stats</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center">
                        <div class="text-3xl font-bold">{{ $totalTasks }}</div>
                        <div class="text-sm text-amber-200">Total Tasks</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold">{{ $completedTasks }}</div>
                        <div class="text-sm text-amber-200">Completed</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold">{{ $pendingTasks }}</div>
                        <div class="text-sm text-amber-200">Pending</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold">{{ $overdueTasks }}</div>
                        <div class="text-sm text-red-300">Overdue</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="mb-4 md:mb-0 md:mr-6">
                <h2 class="text-xl font-bold text-gray-800 mb-2">Ready to manage your tasks?</h2>
                <p class="text-gray-600">
                    Organize your day, set priorities, and get things done efficiently.
                </p>
            </div>
            <a href="{{ route('tasks.index') }}"
               class="px-6 py-3 bg-gradient-to-r from-amber-600 to-amber-700 text-white rounded-lg hover:from-amber-700 hover:to-amber-800 transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span class="font-bold">Go to My Tasks →</span>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Tasks Preview -->
    @if($recentTasks->count() > 0)
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">Recent Tasks</h2>
            <a href="{{ route('tasks.index') }}" class="text-amber-600 hover:text-amber-700 font-medium">
                View All →
            </a>
        </div>

        <div class="space-y-4">
            @foreach($recentTasks as $task)
            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition duration-300">
                <div class="flex justify-between items-center">
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-800">{{ $task->title }}</h3>
                        @if($task->description)
                            <p class="text-gray-600 text-sm mt-1">{{ Str::limit($task->description, 80) }}</p>
                        @endif
                        <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                            @if($task->due_date)
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $task->due_date->format('M d, Y') }}
                                </span>
                            @endif
                            <span class="px-2 py-1 rounded text-xs font-medium
                                @if($task->priority == 'high') bg-red-100 text-red-800
                                @elseif($task->priority == 'medium') bg-yellow-100 text-yellow-800
                                @elseif($task->priority == 'low') bg-blue-100 text-blue-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ $task->priority ?? 'No priority' }}
                            </span>
                        </div>
                    </div>
                    <div class="ml-4">
                        @if($task->completed)
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                ✓ Completed
                            </span>
                        @else
                            <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-sm font-medium">
                                Pending
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Productivity Tip -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-6">
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div>
                <h3 class="font-bold text-gray-800 mb-2">Productivity Tip</h3>
                <p class="text-gray-600">
                    "Break down large tasks into smaller, manageable steps. Completing small tasks
                    gives you momentum and a sense of accomplishment!"
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
