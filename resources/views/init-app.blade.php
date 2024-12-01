<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Init App</title>
    <link rel="stylesheet" href="{{ asset('css/filament/filament/app.css') }}">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 dark:bg-gray-900">
    <div class="container fixed p-4 -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
        <div class="flex justify-center">
            <div class="w-full max-w-md">
                <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-black ">
                    <div class="p-6">
                        <h2 class="relative z-10 mb-4 text-2xl font-bold text-center text-black dark:text-white">Zakończmy konfigurację tworząc Twoje
                            <span
                                class="relative inline-block -z-10 before:bg-kula-light-400 before:block before:dark:bg-kula-dark-600 before:absolute before:-inset-1 before:-skew-y-2 ">
                                <span class="relative text-white dark:text-black">konto administratora</span>
                            </span>
                            .
                        </h2>
                        <form method="POST" action=""
                            class="dark:[&>div>input]:bg-gray-900 *:*:transition">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 dark:text-gray-300">Nazwa</label>
                                <input id="name" type="text" name="name"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:text-white dark:bg-gray-900"
                                    required>

                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700 dark:text-gray-300">Email</label>
                                <input id="email" type="email" name="email"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:text-white dark:bg-gray-900"
                                    required>
                            </div>
                            <x-password-field :name="'password'" :label="'Password'" />
                            <x-password-field :name="'password_confirmation'" :label="'Confirm_Password'" />

                            <div class="text-center">
                                <button type="submit"
                                    class="px-4 py-2 text-white transition rounded-md dark:text-black bg-kula-light-500 dark:bg-kula-dark-600 hover:bg-kula-light-600 dark:hover:bg-kula-dark-700 disabled:bg-kula-light-300 dark:disabled:bg-kula-dark-100">Stwórz konto administratora</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
