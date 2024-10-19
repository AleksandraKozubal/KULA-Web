<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Init App</title>
    <link rel="stylesheet" href="{{ asset('css/filament/filament/app.css') }}">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="container p-4 mx-auto">
        <div class="flex justify-center">
            <div class="w-full max-w-md">
                <div class="overflow-hidden bg-white rounded-lg shadow-md">
                    <div class="p-6">
                        <h2 class="mb-4 text-2xl font-bold text-center">Setup Root Admin Account</h2>
                        <form method="POST" action="">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700">Name</label>
                                <input id="name" type="text" name="name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700">Email</label>
                                <input id="email" type="email" name="email" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="block text-gray-700">Password</label>
                                <input id="password" type="password" name="password" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div class="mb-4">
                                <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="px-4 py-2 text-white bg-indigo-500 rounded-md hover:bg-indigo-600">Create Admin Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
