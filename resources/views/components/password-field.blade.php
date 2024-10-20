@props(['name', 'label'])
<div class="mb-4 ">
    <label for="{{ $name }}" class="block text-gray-700 dark:text-gray-300">{{ $label }}</label>
    <div class="relative flex">
        <input id="{{ $name }}" type="password" name="{{ $name }}"
            class="relative flex-row w-full mt-1 border-gray-300 rounded-r-none shadow-sm peer rounded-l-md dark:border-gray-700 dark:text-white dark:bg-gray-900"
            required>
        <div id="{{ $name }}-tip"
            class="hidden text-center w-fit absolute animate-fade-out peer-focus:animate-fade-in p-3 text-white -translate-x-1/2 bg-gray-900 border border-gray-700 rounded-md before:border-r before:border-b left-1/2 bottom-[125%] before:block before:-translate-x-1/2 before:h-4 before:w-4 before:absolute before:bg-inherit before:border-inherit before:translate-y-1/2 before:bottom-0 before:left-1/2 before:rotate-45">
        </div>
        <div
            class="flex-row mt-1 border border-gray-300 rounded-l-none shadow-sm w-fit rounded-r-md dark:border-gray-700 dark:text-white dark:bg-gray-900">
            <button type="button" class="w-full h-full text-center text-gray-700 dark:text-gray-300"
                onclick="togglePasswordVisibility('{{ $name }}')" tabindex="-1">

                <svg tabindex="-1" id="{{ $name }}-show" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hidden mx-2 size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                </svg>
                <svg tabindex="-1" id="{{ $name }}-hide" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-2 size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>

            </button>
        </div>
    </div>
</div>
<script>
    function togglePasswordVisibility(id) {
        const input = document.getElementById(id);
        if (input.type === 'password') {
            input.type = 'text';
            document.getElementById(id + '-show').classList.remove('hidden');
            document.getElementById(id + '-hide').classList.add('hidden');
        } else {
            input.type = 'password';
            document.getElementById(id + '-show').classList.add('hidden');
            document.getElementById(id + '-hide').classList.remove('hidden');
        }
    }
</script>
