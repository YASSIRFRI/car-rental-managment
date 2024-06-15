<div x-data="{ open: true }" class="min-h-screen flex flex-col justify-between bg-white shadow-lg">
    <div>
        <div class="flex items-center justify-center h-16 border-b">
            <button @click="open = !open" class="focus:outline-none">
                <i :class="open ? 'fas fa-angle-double-left' : 'fas fa-angle-double-right'"></i>
            </button>
        </div>
        <nav class="mt-10 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center justify-center h-12 text-gray-600 hover:bg-gray-200" :class="open ? 'justify-start pl-4' : 'justify-center'">
                <i class="fas fa-tachometer-alt"></i>
                <span x-show="open" class="ml-4">Dashboard</span>
            </a>
            <a href="{{ route('vehicles.index') }}" class="flex items-center justify-center h-12 text-gray-600 hover:bg-gray-200" :class="open ? 'justify-start pl-4' : 'justify-center'">
                <i class="fas fa-car"></i>
                <span x-show="open" class="ml-4">Vehicles</span>
            </a>
            <a href="{{ route('rentals.index') }}" class="flex items-center justify-center h-12 text-gray-600 hover:bg-gray-200" :class="open ? 'justify-start pl-4' : 'justify-center'">
                <i class="fas fa-receipt"></i>
                <span x-show="open" class="ml-4">Rentals</span>
            </a>
            <a href="{{ route('clients.index') }}" class="flex items-center justify-center h-12 text-gray-600 hover:bg-gray-200" :class="open ? 'justify-start pl-4' : 'justify-center'">
                <i class="fas fa-user"></i>
                <span x-show="open" class="ml-4">Clients</span>
            </a>
            <a href="#" class="flex items-center justify-center h-12 text-gray-600 hover:bg-gray-200" :class="open ? 'justify-start pl-4' : 'justify-center'">
                <i class="fas fa-cog"></i>
                <span x-show="open" class="ml-4">Settings</span>
            </a>
        </nav>
    </div>
    <div class="flex items-center justify-center h-16 border-t">
        <a href="{{ route('logout') }}" class="flex items-center justify-center h-12 text-gray-600 hover:bg-gray-200 w-full" :class="open ? 'justify-start pl-4' : 'justify-center'">
            <i class="fas fa-sign-out-alt"></i>
            <span x-show="open" class="ml-4">Logout</span>
        </a>
    </div>
</div>
