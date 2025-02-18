<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        .custom-font {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 custom-font">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-green-600 custom-font">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium custom-font">Email</label>
                <input id="email" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 custom-font" 
                       type="email" name="email" value="{{ old('email') }}" required autofocus>
                
                @error('email')
                    <div class="mt-2 text-red-600 custom-font">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 custom-font">
                    Email Password Reset Link
                </button>
            </div>
        </form>
    </div>
</body>
</html>
