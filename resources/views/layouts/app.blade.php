<!DOCTYPE html>
<html>
<head>
    <title>My Blog</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">

    <nav class="bg-white shadow p-4 flex justify-between">
        <div>
            <a href="/posts" class="font-bold text-lg text-blue-600">MyBlog</a>
        </div>

        <div class="space-x-4">
            <a href="/posts" class="text-gray-700 hover:text-blue-500">Home</a>
            <a href="/posts/create" class="text-gray-700 hover:text-blue-500">Create</a>

            @auth
                <a href="/dashboard" class="text-gray-700 hover:text-blue-500">Dashboard</a>
                <span class="text-gray-600">{{ auth()->user()->name }}</span>

                <form method="POST" action="/logout" class="inline">
                    @csrf
                    <button class="text-red-500">Logout</button>
                </form>
            @else
                <a href="/login" class="text-blue-500">Login</a>
                <a href="/register" class="text-green-500">Register</a>
            @endauth
        </div>
    </nav>

    <div class="max-w-3xl mx-auto mt-6 p-4 bg-white shadow rounded">
        @yield('content')
    </div>

</body>
</html>