<!DOCTYPE html>
<html>
<head>
    <title>Register Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center min-h-screen p-6">
    <div class="w-full max-w-md bg-white dark:bg-gray-900 p-8 rounded-2xl shadow-lg">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('Ninestars/assets/img/logo2.jpg') }}" alt="Company Logo" class="h-20">
        </div>
        
        <!-- Title -->
        <h2 class="text-center text-2xl font-bold text-gray-800 dark:text-white">Create an Account</h2>
        <p class="text-center text-gray-500 dark:text-gray-400 text-sm">Register to get started</p>
        
        <!-- Register Form -->
        <form action="{{ route('register') }}" method="POST" class="mt-6">
            @csrf
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Name</label>
                <input id="name" name="name" type="text" required autocomplete="name" autofocus 
                       class="block mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-indigo-500" />
                <p class="mt-2 text-red-500 text-sm">@error('name') {{ $message }} @enderror</p>
            </div>
            
            <div class="mt-4">
                <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Email</label>
                <input id="email" name="email" type="email" required autocomplete="username"
                       class="block mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-indigo-500" />
                <p class="mt-2 text-red-500 text-sm">@error('email') {{ $message }} @enderror</p>
            </div>
            
            <div class="mt-4">
                <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Password</label>
                <input id="password" name="password" type="password" required autocomplete="new-password"
                       class="block mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-indigo-500" />
                <p class="mt-2 text-red-500 text-sm">@error('password') {{ $message }} @enderror</p>
            </div>
            
            <div class="mt-4">
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                       class="block mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-indigo-500" />
                <p class="mt-2 text-red-500 text-sm">@error('password_confirmation') {{ $message }} @enderror</p>
            </div>
            
            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('login') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    Already registered?
                </a>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg transition-all duration-300">
                    Register
                </button>
            </div>
        </form>
    </div>
</body>
</html>