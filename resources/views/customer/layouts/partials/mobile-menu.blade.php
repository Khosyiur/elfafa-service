<div id="mobileMenu" class="mobile-menu">
    <div class="flex flex-col items-center justify-center h-full space-y-8">
        <button id="closeMenu" class="absolute top-8 right-8 text-white text-3xl">
            <i class="fas fa-times"></i>
        </button>
        <a href="{{ route('beranda') }}" class="text-white text-2xl font-semibold hover:text-purple-400 transition mobile-link">
            Beranda
        </a>
        <a href="{{ route('layanan') }}" class="text-white text-2xl font-semibold hover:text-purple-400 transition mobile-link">
            Layanan
        </a>
        <a href="{{ route('sparepart.index') }}" class="text-white text-2xl font-semibold hover:text-purple-400 transition mobile-link">
            Sparepart
        </a>
        <a href="{{ route('tracking.index') }}" class="text-white text-2xl font-semibold hover:text-purple-400 transition mobile-link">
            Cek Status
        </a>
        <a href="{{ route('artikel') }}" class="text-white text-2xl font-semibold hover:text-purple-400 transition mobile-link">
            Artikel
        </a>
        <a href="{{ route('booking.create') }}" class="btn-primary text-white px-8 py-3 rounded-lg font-semibold text-xl mobile-link hover:shadow-lg transition">
            Booking Sekarang
        </a>
    </div>
</div>