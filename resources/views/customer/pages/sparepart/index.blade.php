@extends('customer.layouts.app')

@section('title', 'Daftar Sparepart - Elfafa Service')
@section('description', 'Lihat daftar sparepart HP yang tersedia dengan harga dan status stok.')

@section('content')
<!-- Hero Section -->
<section class="gradient-bg text-white pt-32 pb-12 px-4">
    <div class="container mx-auto text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Daftar Sparepart</h1>
        <p class="text-xl text-gray-100">Lihat ketersediaan sparepart untuk HP Anda</p>
    </div>
</section>

<!-- Filter Section -->
<section class="py-6 px-4 bg-white border-b">
    <div class="container mx-auto">
        <form action="{{ route('sparepart.index') }}" method="GET" class="flex flex-wrap gap-4 items-center">
            <!-- Search -->
            <div class="flex-1 min-w-64">
                <input type="text" name="search" value="{{ request('search') }}" 
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    placeholder="Cari nama sparepart atau tipe HP...">
            </div>

            <!-- Filter Stok -->
            <div>
                <select name="stock_status" class="border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="">Semua Status</option>
                    <option value="available" {{ request('stock_status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                    <option value="low" {{ request('stock_status') == 'low' ? 'selected' : '' }}>Hampir Habis</option>
                    <option value="empty" {{ request('stock_status') == 'empty' ? 'selected' : '' }}>Habis</option>
                </select>
            </div>

            <button type="submit" class="btn-primary text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition">
                <i class="fas fa-search mr-2"></i>Cari
            </button>

            @if(request()->hasAny(['search', 'stock_status']))
                <a href="{{ route('sparepart.index') }}" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition">
                    Reset
                </a>
            @endif
        </form>
    </div>
</section>

<!-- Sparepart List -->
<section class="py-12 px-4 bg-gray-50">
    <div class="container mx-auto">
        @if($spareparts->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($spareparts as $sp)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition card-hover">
                        <!-- Image -->
                        <div class="h-48 bg-gray-100 flex items-center justify-center">
                            @if($sp->image_url)
                                <img src="{{ $sp->image_url }}" alt="{{ $sp->name }}" class="w-full h-full object-cover">
                            @else
                                <i class="fas fa-microchip text-6xl text-gray-300"></i>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="font-bold text-lg text-gray-800">{{ $sp->name }}</h3>
                            </div>

                            <div class="space-y-2 text-sm text-gray-600 mb-4">
                                @if($sp->compatible_for)
                                    <p class="flex items-start">
                                        <i class="fas fa-mobile-alt mr-2 mt-0.5 text-purple-500"></i>
                                        <span>{{ $sp->compatible_for }}</span>
                                    </p>
                                @endif

                                @if($sp->warranty)
                                    <p class="flex items-center">
                                        <i class="fas fa-shield-alt mr-2 text-green-500"></i>
                                        Garansi {{ $sp->warranty }}
                                    </p>
                                @endif

                                <p class="flex items-center">
                                    <i class="fas fa-boxes mr-2 text-blue-500"></i>
                                    Stok: {{ $sp->stock }} unit
                                </p>
                            </div>

                            <div class="flex justify-between items-center pt-4 border-t">
                                <span class="text-2xl font-bold text-purple-600">
                                    {{ $sp->formatted_price }}
                                </span>
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $sp->stock_badge }}">
                                    {{ $sp->stock_status }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $spareparts->withQueryString()->links() }}
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-600 mb-2">Tidak ada sparepart ditemukan</h3>
                <p class="text-gray-500">Coba ubah filter pencarian Anda</p>
            </div>
        @endif
    </div>
</section>

<!-- Info Section -->
<section class="py-8 px-4 bg-white">
    <div class="container mx-auto max-w-4xl">
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
            <h3 class="font-bold text-blue-800 mb-3">
                <i class="fas fa-info-circle mr-2"></i>Informasi
            </h3>
            <ul class="text-blue-700 space-y-2 text-sm">
                <li><i class="fas fa-check mr-2"></i>Harga dan ketersediaan dapat berubah sewaktu-waktu</li>
                <li><i class="fas fa-check mr-2"></i>Sparepart original dan OEM berkualitas dengan garansi</li>
                <li><i class="fas fa-check mr-2"></i>Untuk pemesanan, silakan <a href="{{ route('booking.create') }}" class="underline font-semibold">booking service</a> atau hubungi kami</li>
            </ul>
        </div>

        <div class="mt-6 text-center">
            <p class="text-gray-600 mb-3">Butuh sparepart yang tidak ada di daftar?</p>
            <a href="https://wa.me/628563051551?text=Halo%20Elfafa%20Service,%20saya%20mau%20tanya%20ketersediaan%20sparepart" 
                target="_blank"
                class="inline-flex items-center text-green-600 font-semibold hover:text-green-700">
                <i class="fab fa-whatsapp mr-2 text-xl"></i>Tanya via WhatsApp
            </a>
        </div>
    </div>
</section>
@endsection