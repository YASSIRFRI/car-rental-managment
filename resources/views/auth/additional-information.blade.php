<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Additional Information</title>
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
                <h2 class="text-2xl font-bold text-center mb-8">Additional Information</h2>
                <form method="POST" action="{{ route('additional-information.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <input id="address" name="address" type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                        <input id="city" name="city" type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="zip_code" class="block text-sm font-medium text-gray-700">ZIP Code</label>
                        <input id="zip_code" name="zip_code" type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>
                    <div>
                        <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
