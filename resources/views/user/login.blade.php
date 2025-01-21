<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-sm bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 text-center mb-6">Login</h1>

        <!-- Form Login -->
        <form action="/login" method="POST" class="space-y-4">
            @csrf
            <!-- email -->
            <div>
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input type="email" id="email" name="email"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan email" required>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-gray-700 font-medium">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan password" required>
            </div>

            @if (session('error'))
                <p class="text-red-500 text-sm">{{ session('error') }}</p>
            @endif

            <!-- Tombol Login -->
            <button type="submit"
                class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                Login
            </button>
        </form>

        <!-- Footer -->
        <p class="text-center text-gray-600 mt-4 text-sm">
            Belum punya akun?
            <a href="/register" class="text-blue-500 hover:underline">Daftar di sini</a>
        </p>
    </div>
</body>

</html>
