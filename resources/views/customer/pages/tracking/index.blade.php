@extends('customer.layouts.app')

@section('title', 'Cek Status Service - Elfafa Service')
@section('description', 'Cek status perbaikan HP Anda dengan ID Booking atau Nomor HP.')

@section('content')
<!-- Hero Section -->
<section class="gradient-bg text-white pt-32 pb-12 px-4">
    <div class="container mx-auto text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Cek Status Service</h1>
        <p class="text-xl text-gray-100">Masukkan ID Booking atau Nomor HP untuk mengecek status perbaikan</p>
    </div>
</section>

<!-- Search Section -->
<section class="py-12 px-4 bg-gray-50">
    <div class="container mx-auto max-w-xl">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-search text-3xl text-purple-600"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Tracking Service</h2>
            </div>

            <form action="{{ route('tracking.search') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="search" class="block font-semibold text-gray-700 mb-2">ID Booking / Nomor HP</label>
                    <input type="text" name="search" id="search" 
                        value="{{ old('search') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-4 text-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('search') border-red-500 @enderror"
                        placeholder="Contoh: ELF-20250101-001 atau 081234567890"
                        autofocus>
                    @error('search')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full btn-primary text-white px-6 py-4 rounded-lg font-bold hover:shadow-lg transition inline-flex items-center justify-center">
                    <i class="fas fa-search mr-2"></i>Cari Status
                </button>
            </form>
        </div>

        <!-- Tips -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-xl p-6">
            <h3 class="font-bold text-blue-800 mb-3">
                <i class="fas fa-lightbulb mr-2"></i>Tips
            </h3>
            <ul class="text-blue-700 space-y-2 text-sm">
                <li><i class="fas fa-check mr-2"></i>ID Booking diberikan saat Anda melakukan booking</li>
                <li><i class="fas fa-check mr-2"></i>Jika lupa ID Booking, gunakan nomor HP yang terdaftar</li>
                <li><i class="fas fa-check mr-2"></i>Contoh format ID: <strong>ELF-20250101-001</strong></li>
            </ul>
        </div>

        <!-- Quick Actions -->
        <div class="mt-6 text-center">
            <p class="text-gray-600 mb-3">Belum punya booking?</p>
            <a href="{{ route('booking.create') }}" class="inline-flex items-center text-purple-600 font-semibold hover:text-purple-700">
                <i class="fas fa-calendar-plus mr-2"></i>Booking Service Sekarang
            </a>
        </div>
    </div>
</section>
@endsection