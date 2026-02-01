    @extends('layout.layout')
    @section('title','index')
    @section('content')

    <form method="POST" action="{{ route('process.login') }}" class="max-w-md mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
        @csrf

    <div class="mb-6">
        <label class="block text-gray-700 mb-2">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus
               class=" px-4 py-2 border border-gray-300 rounded-md bg-gray-50 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent">
        @error('email')
            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-6">
        <label class="block text-gray-700 mb-2">Password</label>
        <input type="password" name="password" required
               class=" px-4 py-2 border border-gray-300 rounded-md bg-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent">
        @error('password')
            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-6 flex items-center">
        <input type="checkbox" name="remember" class="h-4 w-4 text-amber-600 focus:ring-amber-500">
        <label class="ml-2 text-gray-700">Remember Me</label>
    </div>

    <button type="submit" class=" bg-amber-600 hover:bg-amber-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-300">
        Login
    </button>

    <div class="mb-4 p-100 bg-red-500 text-white">
    TEST: This should have a red background if Tailwind works
</div>

</form>

    @endsection
