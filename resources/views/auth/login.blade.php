<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
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
        <h2 class="text-center text-2xl font-bold text-gray-800 dark:text-white">Welcome Back! 👋</h2>
        <p class="text-center text-gray-500 dark:text-gray-400 text-sm">Login to continue</p>
        
        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="mt-6">
            @csrf
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Email</label>
                <input id="email" name="email" type="email" required autocomplete="username" autofocus 
                       class="block mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-indigo-500" />
                <p class="mt-2 text-red-500 text-sm">@error('email') {{ $message }} @enderror</p>
            </div>
            
            <div class="mt-4">
                <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Password</label>
                <input id="password" name="password" type="password" required autocomplete="current-password" 
                       class="block mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-indigo-500" />
                <p class="mt-2 text-red-500 text-sm">@error('password') {{ $message }} @enderror</p>
            </div>
        
            <!-- Remember Me Checkbox -->
            <div class="flex items-center justify-between mt-4 mb-4">
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                        Remember Me
                    </label>
                </div>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" 
                       href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
            
            <div class="mt-6">
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg transition-all duration-300">
                    Log in
                </button>
            </div>
        </form>
        
       

        <!-- Register Link -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Register</a>
            </p>
        </div>
    </div>
</body>
</html>
