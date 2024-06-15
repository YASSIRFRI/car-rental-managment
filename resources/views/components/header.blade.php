<div class="w-full bg-white shadow-lg">
    <div class="flex items-center justify-between px-6 py-4">
        <div class="text-lg font-bold">Dashboard</div>
        <div class="flex items-center space-x-4">
            <div class="relative">
                <input type="text" placeholder="Search..." class="bg-gray-200 rounded-full px-4 py-2 focus:outline-none focus:bg-white">
                <i class="fas fa-search absolute top-2 right-4 text-gray-500"></i>
            </div>
            <div class="flex items-center space-x-2">
                <img src="{{ asset('images/user-avatar.png') }}" alt="User Avatar" class="h-8 w-8 rounded-full">
                <div>{{ Auth::user()->name }}</div>
            </div>
        </div>
    </div>
</div>
