@extends('layout.layout')
@section('title', 'Edit Profile')
@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Edit Profile</h1>
        <a href="{{ route('profile') }}"
           class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-300">
            ← Back to Profile
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6">
        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Success Message -->
            @if(session('success'))
                <div class="p-4 bg-green-100 text-green-700 rounded-lg border border-green-300">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Name Field -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Full Name *
                </label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name', Auth::user()->name) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 @error('name') border-red-500 @enderror"
                       required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email Address *
                </label>
                <input type="email"
                       id="email"
                       name="email"
                       value="{{ old('email', Auth::user()->email) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 @error('email') border-red-500 @enderror"
                       required>
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Section -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Change Password (Optional)</h3>
                <p class="text-sm text-gray-600 mb-4">
                    Leave password fields blank if you don't want to change your password.
                </p>

                <div class="space-y-4">
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                            Current Password
                        </label>
                        <input type="password"
                               id="current_password"
                               name="current_password"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                        @error('current_password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            New Password
                        </label>
                        <input type="password"
                               id="password"
                               name="password"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Confirm New Password
                        </label>
                        <input type="password"
                               id="password_confirmation"
                               name="password_confirmation"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                <a href="{{ route('profile') }}"
                   class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-300">
                    Cancel
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition duration-300">
                    Update Profile
                </button>
            </div>
        </form>
    </div>

    <!-- Account Info -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h3 class="text-lg font-medium text-gray-800 mb-4">Account Information</h3>
        <div class="space-y-3 text-gray-600">
            <div class="flex justify-between">
                <span class="font-medium">Member Since:</span>
                <span>{{ Auth::user()->created_at->format('F d, Y') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-medium">Last Updated:</span>
                <span>{{ Auth::user()->updated_at->format('F d, Y') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-medium">Task Count:</span>
                <span>{{ Auth::user()->tasks()->count() }} tasks</span>
            </div>
        </div>
    </div>
</div>
@endsection
