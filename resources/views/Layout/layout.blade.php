<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Portfolio')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-cover bg-center bg-no-repeat bg-fixed min-h-screen"
      style="background-image: url('images/Dark-Woods-HD-Photo.jpg');">

    <nav class="bg-amber-900/65 text-white px-8 py-4">
        <ul class="flex space-x-8 list-none">
            {{--  <li><a href="{{ route('home') }}" class="text-white font-bold hover:text-amber-300 transition duration-300">Home</a></li>
            <li><a href="{{ route('about') }}" class="text-white font-bold hover:text-amber-300 transition duration-300">About</a></li>--}}
            @guest
                <li><a href="{{ route('show.register') }}" class="text-white font-bold hover:text-amber-300 transition duration-300">Register</a></li>
                <li><a href="{{ route('show.login') }}" class="text-white font-bold hover:text-amber-300 transition duration-300">Log in</a></li>
            @endguest
             @auth
                {{-- Show user's name or profile link --}}
                <li>
                    <a href="{{ route('profile') }}" class="text-amber-300 font-medium">
                        Welcome, {{ Auth::user()->name }}!
                    </a>

                </li>
                <li>
                    <a href="{{ route('profile.edit') }}" class="text-white font-bold hover:text-amber-300 transition duration-300">
                        Edit Profile
                    </a>
                </li>
                {{-- Logout form (must use POST request for security) --}}
                <li>
                    <form method="POST" action="{{ route('process.logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                                class="text-white font-bold hover:text-amber-300 transition duration-300 bg-transparent border-none cursor-pointer">
                            Log out
                        </button>
                    </form>
                </li>
            @endauth
        </ul>
    </nav>

    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <div class="bg-gray-300/85 rounded-xl shadow-lg p-8">
            @yield('content')
        </div>
    </div>

    <footer class="sticky top-[100vh] bg-amber-900/65 text-white py-6 mt-8">
        <div class="text-center">
            <p class="mb-4">&copy; {{ date('Y') }} All rights are opposites of lefts. All lefts my rights have reserved.</p>

            <div class="social-links space-x-6">
                <a href="https://github.com/Ennius5" target="_blank" rel="noopener noreferrer"
                   class="text-amber-400 hover:text-red-400 hover:underline transition duration-300">
                    GitHub
                </a>
                <a href="https://linkedin.com/in/Ennius5" target="_blank" rel="noopener noreferrer"
                   class="text-amber-400 hover:text-red-400 hover:underline transition duration-300">
                    LinkedIn
                </a>
                <a href="https://twitter.com/Ennius5" target="_blank" rel="noopener noreferrer"
                   class="text-amber-400 hover:text-red-400 hover:underline transition duration-300">
                    Twitter
                </a>
                <a href="https://instagram.com/Ennius5" target="_blank" rel="noopener noreferrer"
                   class="text-amber-400 hover:text-red-400 hover:underline transition duration-300">
                    Instagram
                </a>
                <a href="mailto:e.campomanes101848@gmail.com"
                   class="text-amber-400 hover:text-red-400 hover:underline transition duration-300">
                    Email
                </a>
            </div>
        </div>
    </footer>
</body>
</html>
