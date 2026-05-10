<!DOCTYPE html>
<html>
<head>
    <title>My Blog</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-100 via-white to-blue-100 min-h-screen text-gray-800">

    <nav class="bg-white/80 backdrop-blur-lg shadow-sm border-b border-gray-200 sticky top-0 z-50">

        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <!-- Logo -->
            <a href="/posts"
            class="text-3xl font-extrabold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">

                LaravelBlog

            </a>

            <!-- Navigation -->
            <div class="flex items-center gap-4">

                <a href="/posts"
                class="hover:text-blue-600 transition font-medium">
                    Posts
                </a>

                @auth

                    <a href="/posts/create"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl transition shadow">

                        Create Post

                    </a>

                    <span class="font-medium text-gray-700">
                        Hi, {{ auth()->user()->name }}
                    </span>

                    <form method="POST" action="/logout">
                        @csrf

                        <button
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl transition">

                            Logout

                        </button>
                    </form>

                @else

                    <a href="/login"
                    class="hover:text-blue-600 transition">
                        Login
                    </a>

                    <a href="/register"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl transition shadow">

                        Register

                    </a>

                @endauth

            </div>

        </div>

    </nav>

    <div class="max-w-3xl mx-auto mt-6 p-4 bg-white shadow rounded">
        @yield('content')
    </div>

</body>
</html>