<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3977be33c4.js" crossorigin="anonymous"></script>
    @stack('page-css')
    <style>
        /* Custom styles for the sidebar and header */
        .sidebar {
            background-color: #E1F7F5;
            min-width: 80px;
            transition: width 0.3s;
        }

        .sidebar.expanded {
            width: 200px;
        }

        .sidebar .icon {
            font-size: 24px;
            transition: transform 0.3s;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 80px; /* Adjusted height for more vertical spacing */
            text-decoration: none;
        }

        .sidebar a:hover .icon {
            transform: scale(1.2);
        }

        .sidebar .text {
            display: none;
            margin-left: 16px;
        }

        .sidebar.expanded .text {
            display: inline;
        }

        .sidebar.expanded .icon-only {
            display: none;
        }

        .header {
            background-color: #164863; /* Dark background */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header .user-info {
            display: flex;
            align-items: center;
        }

        .header .user-info i {
            margin-right: 10px; /* Horizontal space between user name and icon */
        }

        .header .user-info p {
            margin: 0;
            padding: 0 10px;
            color: #fff;
        }

        .logo img {
            height: 60px; 
            width: auto; 
        }

        /* Custom styles for the search bar */
        .search-bar {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-bar input {
            padding: 8px 16px;
            border-radius: 24px;
            border: 1px solid #ccc;
            width: 250px;
            transition: width 0.3s;
        }

        .search-bar input:focus {
            width: 300px;
        }

        .search-results {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: none;
        }

        .search-results a {
            display: flex;
            align-items: center;
            padding: 8px 16px;
            text-decoration: none;
            color: black;
            transition: background-color 0.3s;
        }

        .search-results a:hover {
            background-color: #f0f0f0;
        }

        .search-results .icon {
            margin-right: 8px;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div class="sidebar min-h-screen shadow-lg flex flex-col justify-between">
            <div>
                <nav class="mt-10 px-2 py-3">
                    <a href="{{ route('dashboard') }}" class="text-palette-5 hover:bg-white hover:rounded-lg px-4 py-4">
                        <i class="fas fa-tachometer-alt icon"></i>
                        <span class="text">Dashboard</span>
                    </a>
                    <a href="{{ route('vehicles.index') }}" class="text-palette-5 hover:bg-white hover:rounded-lg px-4 py-4">
                        <i class="fas fa-car icon"></i>
                        <span class="text">Vehicles</span>
                    </a>
                    <a href="{{ route('rentals.index') }}" class="text-palette-5 hover:bg-white hover:rounded-lg px-4 py-4">
                        <i class="fas fa-receipt icon"></i>
                        <span class="text">Rentals</span>
                    </a>
                    <a href="{{ route('clients.index') }}" class="text-palette-5 hover:bg-white hover:rounded-lg px-4 py-4">
                        <i class="fas fa-user icon"></i>
                        <span class="text">Clients</span>
                    </a>
                    <a href="#" class="text-palette-5 hover:bg-white hover:rounded-lg px-4 py-4">
                        <i class="fas fa-usd icon"></i>
                        <span class="text">Income</span>
                    </a>
                    <a href="#" class="text-palette-5 hover:bg-white hover:rounded-lg px-4 py-4">
                        <i class="fas fa-cog icon"></i>
                        <span class="text">Settings</span>
                    </a>
                </nav>
            </div>
            <div class="flex items-center justify-center h-16 border-t">
            <form method="POST" action="{{ route('logout') }}" class="w-full flex justify-center items-center h-full">
                @csrf
                <button type="submit" class="text-palette-5 hover:bg-gray-200 w-full flex justify-center items-center h-full focus:outline-none">
                    <i class="fas fa-sign-out-alt icon"></i>
                </button>
            </form>
            </div>
        </div>

        <!-- Main content -->
        <div class="flex-1">
            <!-- Header -->
            <header class="header bg-palette-4 text-white p-4 flex justify-between items-center shadow-md">
                <div class="flex items-center">
                    <button id="sidebarToggle" class="text-gray-300 hover:text-white focus:outline-none mr-4">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="search-bar">
                        <input id="search-input" type="text" placeholder="Rechercher...">
                        <div id="search-results" class="search-results"></div>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                <a href="{{ route('rentals.create') }}" class="bg-white  text-palette-5 py-2 px-4 rounded-2xl flex items-center">
                        <i class="fas fa-key mr-2"></i>Location
                        </a>
                    <a href="{{ route('clients.create') }}" class="bg-white  text-palette-5 py-2 px-4 rounded-2xl flex items-center">
                        <i class="fas fa-user-plus mr-2"></i> Client
                    </a>
                    <a href="{{ route('vehicles.create') }}" class="bg-white  text-palette-5 py-2 px-4 rounded-2xl flex items-center">
                        <i class="fas fa-car mr-2"></i>Vehicule
                    </a>

                    <div class="flex items-center">
                        <i class="fas fa-user-circle text-2xl mr-2"></i>
                        <span>{{ Auth::user()->name }}</span>
                    </div>
                </div>
            </header>

            <!-- Page content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#sidebarToggle').on('click', function () {
                $('.sidebar').toggleClass('expanded');
            });

            const searchLinks = [
                { href: "{{ route('dashboard') }}", icon: "fas fa-tachometer-alt", text: "Dashboard" },
                { href: "{{ route('vehicles.index') }}", icon: "fas fa-car", text: "Vehicles" },
                { href: "{{ route('rentals.index') }}", icon: "fas fa-receipt", text: "Rentals" },
                { href: "{{ route('clients.index') }}", icon: "fas fa-user", text: "Clients" },
                { href: "#", icon: "fas fa-usd", text: "Income" },
                { href: "#", icon: "fas fa-cog", text: "Settings" }
            ];

            $('#search-input').on('input', function () {
                const query = $(this).val().toLowerCase();
                $('#search-results').empty().hide();

                if (query) {
                    const results = searchLinks.filter(link => link.text.toLowerCase().includes(query));
                    if (results.length > 0) {
                        results.forEach(link => {
                            $('#search-results').append(`
                                <a href="${link.href}">
                                    <i class="${link.icon} icon"></i>
                                    <span>${link.text}</span>
                                </a>
                            `);
                        });
                        $('#search-results').show();
                    }
                }
            });

            $(document).click(function (e) {
                if (!$(e.target).closest('.search-bar').length) {
                    $('#search-results').hide();
                }
            });
        });
    </script>
    @stack('page-js')
</body>
</html>
