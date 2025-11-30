<nav class="bg-white shadow-lg fixed w-full top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <i class=" text-3xl text-purple-600"></i>
                <a href="{{ route('beranda') }}" class="text-2xl font-bold text-gray-800">Elfafa Service</a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center space-x-8">
                <a href="{{ route('beranda') }}"
                    class="text-gray-700 hover:text-purple-600 transition {{ request()->routeIs('beranda') ? 'text-purple-600 font-semibold' : '' }}">
                    Beranda
                </a>

                <a href="{{ route('layanan') }}"
                    class="text-gray-700 hover:text-purple-600 transition {{ request()->routeIs('layanan') ? 'text-purple-600 font-semibold' : '' }}">
                    Layanan
                </a>

                <a href="{{ route('sparepart.index') }}"
                    class="text-gray-700 hover:text-purple-600 transition {{ request()->routeIs('sparepart.index') ? 'text-purple-600 font-semibold' : '' }}">
                    Sparepart
                </a>

                <a href="{{ route('tracking.index') }}"
                    class="text-gray-700 hover:text-purple-600 transition {{ request()->routeIs('tracking.*') ? 'text-purple-600 font-semibold' : '' }}">
                    Cek Status
                </a>

                <a href="{{ route('booking.create') }}"
                    class="btn-primary text-white px-6 py-2 rounded-lg font-semibold hover:shadow-lg transition">
                    Booking Sekarang
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobileMenuBtn" class="lg:hidden text-gray-700 focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
    </div>
</nav>