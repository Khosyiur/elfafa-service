@extends('layouts.customer')

@section('title', 'Elfafa Service - Servis HP Profesional')

@section('content')

<!-- Hero Section -->
<section class="bg-purple-600 text-white rounded-lg p-8 mb-8">
    <h1 class="text-3xl font-bold mb-4">Solusi Terpercaya untuk Servis HP Anda</h1>
    <p class="mb-6">Teknisi profesional, garansi resmi, pengerjaan cepat, dan harga transparan.</p>
    <div class="space-x-4">
        <a href="{{ route('booking.create') }}" class="bg-yellow-400 text-gray-900 px-6 py-3 rounded font-bold">
            <i class="fas fa-calendar-check mr-2"></i>Booking Sekarang
        </a>
        <a href="{{ route('tracking.index') }}" class="bg-white text-purple-600 px-6 py-3 rounded font-bold">
            <i class="fas fa-search mr-2"></i>Cek Status
        </a>
    </div>
</section>

<!-- Quick Links -->
<section class="grid md:grid-cols-3 gap-6 mb-8">
    <a href="{{ route('booking.create') }}" class="bg-white p-6 rounded shadow hover:shadow-lg">
        <i class="fas fa-calendar-plus text-3xl text-purple-600 mb-4"></i>
        <h3 class="font-bold text-lg">Booking Service</h3>
        <p class="text-gray-600">Ajukan permintaan servis HP Anda</p>
    </a>
    <a href="{{ route('tracking.index') }}" class="bg-white p-6 rounded shadow hover:shadow-lg">
        <i class="fas fa-search text-3xl text-blue-600 mb-4"></i>
        <h3 class="font-bold text-lg">Tracking Status</h3>
        <p class="text-gray-600">Cek progress perbaikan HP</p>
    </a>
    <a href="{{ route('sparepart.index') }}" class="bg-white p-6 rounded shadow hover:shadow-lg">
        <i class="fas fa-microchip text-3xl text-green-600 mb-4"></i>
        <h3 class="font-bold text-lg">Daftar Sparepart</h3>
        <p class="text-gray-600">Lihat ketersediaan sparepart</p>
    </a>
</section>

<!-- Testimoni Section -->
<section class="mb-8">
    <h2 class="text-2xl font-bold mb-6">Hasil Service Terbaru</h2>

    @if($testimonis->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($testimonis as $testimoni)
                <div class="bg-white rounded shadow p-6">
                    <h3 class="font-bold text-lg mb-2">{{ $testimoni->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($testimoni->description, 150) }}</p>

                    @if($testimoni->has_photos)
                        <div class="grid grid-cols-2 gap-2">
                            @if($testimoni->before_photo)
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Before:</p>
                                    <img src="{{ $testimoni->before_photo_url }}" alt="Before" class="w-full h-32 object-cover rounded">
                                </div>
                            @endif
                            @if($testimoni->after_photo)
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">After:</p>
                                    <img src="{{ $testimoni->after_photo_url }}" alt="After" class="w-full h-32 object-cover rounded">
                                </div>
                            @endif
                        </div>
                    @endif

                    <p class="text-sm text-gray-400 mt-4">
                        <i class="far fa-clock mr-1"></i>{{ $testimoni->created_at->diffForHumans() }}
                    </p>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">Belum ada testimoni.</p>
    @endif
</section>

@endsection