<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Init App</title>
    <link rel="stylesheet" href="{{ asset('css/filament/filament/app.css') }}">
    @vite('resources/css/app.css')
</head>

<body class="fixed bg-gray-100 dark:bg-gray-900">
    <div class="container fixed p-4 mx-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
        <div class="flex justify-center">
            <div class="w-full max-w-md">
                <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-black ">
                    <div class="p-6">
                        <h2 class="relative z-10 mb-4 text-2xl font-bold text-center text-black dark:text-white">Let's
                            finish setting
                            up by
                            creating your
                            <span
                                class="relative inline-block -z-10 before:bg-kula-light-400 before:block before:dark:bg-kula-dark-600 before:absolute before:-inset-1 before:-skew-y-2 ">
                                <span class="relative text-white dark:text-black">admin account.</span>
                            </span>
                        </h2>
                        <form method="POST" action=""
                            class="dark:[&>div>input]:bg-gray-900 dark:[&>div>input]:text-white [&>div>input]:h-10 *:*:transition">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 dark:text-gray-300">Name</label>
                                <input id="name" type="text" name="name"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700"
                                    required>

                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700 dark:text-gray-300">Email</label>
                                <input id="email" type="email" name="email"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700"
                                    required>
                            </div>
                            <div class="mb-4 ">

                                <label for="password" class="block text-gray-700 dark:text-gray-300">Password</label>
                                <input id="password" type="password" name="password"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700"
                                    required>
                            </div>
                            <div class="mb-4 ">
                                <label for="password_confirmation"
                                    class="block text-gray-700 dark:text-gray-300">Confirm
                                    Password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700"
                                    required>
                            </div>
                            <div class="text-center">
                                <button disabled type="submit"
                                    class="px-4 py-2 text-white transition rounded-md dark:text-black bg-kula-light-500 dark:bg-kula-dark-600 hover:bg-kula-light-600 dark:hover:bg-kula-dark-700 disabled:bg-kula-light-300 dark:disabled:bg-kula-dark-100">Create
                                    Admin Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    const validationChecks = document.getElementById('validation_checks');
    const password = document.getElementById('password');
    const password_confirmation = document.getElementById('password_confirmation');
    const submitButton = document.querySelector('button[type="submit"]');
    const email = document.getElementById('email');
    const name = document.getElementById('name');
    const passwordRegex =
        /^((?=.*[0-9])(?=.*[a-z])(?=.*([A-Z]|[!-\/:-@[-`{-~]))|(?=.*[A-Z])(?=.*[!-\/:-@[-`{-~])(?=.*([0-9]|[a-z])))[a-zA-Z0-9!-\/:-@[-`{-~]{8,}$/;
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

    function checkValidation() {
        if (valid.name && valid.email && valid.password && valid.password_confirmation) {
            submitButton.removeAttribute('disabled');
        } else {
            submitButton.setAttribute('disabled', 'disabled');
        }
    }

    function checkUsername(skipColors = 0) {
        if (name.value.length > 0) {
            valid.name = true;
            if(!skipColors) name.classList.remove('!border-red-500');
        } else {
            valid.name = false;
            if(!skipColors)name.classList.add('!border-red-500');
        }
    }

    function checkEmail(skipColors = 0) {
        if (emailRegex.test(email.value)) {
            valid.email = true;
            if(!skipColors) email.classList.remove('!border-red-500');
        } else {
            valid.email = false;
            if(!skipColors) email.classList.add('!border-red-500');
        }
    }

    function checkPassword(skipColors = 0) {
        if (passwordRegex.test(password.value)) {
            valid.password = true;
            if(!skipColors) password.classList.remove('!border-red-500');
        } else {
            valid.password = false;
            if(!skipColors) password.classList.add('!border-red-500');
        }
        checkPasswordConfirmation(skipColors);
    }

    function checkPasswordConfirmation(skipColors = 0) {
        if (password.value === password_confirmation.value) {
            valid.password_confirmation = true;
            if(!skipColors)password_confirmation.classList.remove('!border-red-500');
        } else {
            valid.password_confirmation = false;
            if(!skipColors)password_confirmation.classList.add('!border-red-500');
        }
    }
    let valid = [{
            name: false
        },
        {
            email: false
        },
        {
            password: false
        },
        {
            password_confirmation: false
        }
    ];

    name.addEventListener('input', () => {
        checkUsername();
        checkValidation();
    });
    email.addEventListener('input', () => {
        checkEmail();
        checkValidation();
    });
    password.addEventListener('input', () => {
        checkPassword();
        checkValidation();
    });
    password_confirmation.addEventListener('input', () => {
        checkPasswordConfirmation();
        checkValidation();
    });
    checkUsername(1);
    checkEmail(1);
    checkPassword(1);
    checkValidation();
</script>

</html>
