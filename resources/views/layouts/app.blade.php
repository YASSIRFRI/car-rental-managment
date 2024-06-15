<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @stack('page-css')
</head>
<body class="bg-gray-100">
    @include('components.header')
    <div class="flex">
        @include('components.sidebar')
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('page-js')
</body>
</html>
