<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <div class="hidden lg:flex lg:w-1/2 lg:h-screen" style="background-image: url('{{ asset('images/background.jpeg') }}'); background-size: cover;">
        </div>
        <div class="flex flex-col justify-center items-center w-full lg:w-1/2 p-6 bg-white">
            <div class="w-full max-w-md">
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('images/logo.webp') }}" alt="Logo" class="h-12">
                </div>
                <h2 class="text-2xl font-bold text-center mb-8">Ravis de vous revoir !</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-red-700">Email</label>
                        <input id="email" name="email" type="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                        <input id="password" name="password" type="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-900"> Se souvenir de moi </label>
                        </div>
                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500"> Mot de passe oublié ? </a>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium  bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Se connecter
                        </button>
                    </div>
                    <div class="mt-6 text-center">
                        <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500"> Vous n'avez pas de compte ? Inscrivez-vous </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
