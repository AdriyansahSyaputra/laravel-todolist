<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TodoList</title>

    @vite('resources/css/app.css')
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <h1 class="text-2xl font-bold text-gray-800">TodoList</h1>
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-300">
                        Logout
                    </button>
                </form>

            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-3xl mx-auto mt-8 px-4">
        <!-- Todo Form -->
        <form action="" method="post" class="bg-white rounded-lg shadow-md p-6 mb-8">
            @csrf
            <div class="flex gap-4">
                <input type="text" placeholder="Add new todo..." name="todo"
                    class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition duration-300">
                    Add
                </button>
            </div>
        </form>

        <!-- Todo List -->
        <div class="space-y-4">

            <!-- Todo Item (Complete) -->
            @foreach ($todoList as $todo)
                <div
                    class="bg-white rounded-lg shadow-md p-4 flex items-center justify-between gap-4 transition-all duration-300 hover:shadow-lg">
                    <div class="flex items-center gap-4 flex-1">
                        <span>{{ $todo['id'] }}</span>
                        <span class="text-gray-800 font-semibold">
                            {{ $todo['todo'] }}
                        </span>
                    </div>
                    <div class="flex gap-2">
                        <button
                            class="text-blue-500 hover:text-blue-600 px-3 py-1 rounded-lg hover:bg-blue-50 transition duration-300">
                            Edit
                        </button>
                        <form action="/{{ $todo['id'] }}/delete" method="POST">
                            @csrf
                            @method('DELETE')
                            <button
                                class="text-red-500 hover:text-red-600 px-3 py-1 rounded-lg hover:bg-red-50 transition duration-300">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

        </div>
    </main>
</body>

</html>
