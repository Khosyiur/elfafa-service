@extends('customer.layouts.app')

@section('title', 'Booking Berhasil - Elfafa Service')

@section('content')
<!-- Hero Section -->
<section class="gradient-bg text-white pt-32 pb-12 px-4">
    <div class="container mx-auto text-center">
        <div class="mb-6">
            <i class="fas fa-check-circle text-6xl text-green-400"></i>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Booking Berhasil!</h1>
        <p class="text-xl text-gray-100">Terima kasih, booking Anda telah kami terima</p>
    </div>
</section>

<!-- Detail Section -->
<section class="py-12 px-4 bg-gray-50">
    <div class="container mx-auto max-w-2xl">
        <!-- Booking Code Highlight -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-6 text-center">
            <p class="text-gray-600 mb-2">ID Booking Anda:</p>
            <h2 class="text-3xl md:text-4xl font-bold text-purple-600 mb-4">{{ $booking->booking_code }}</h2>
            <p class="text-gray-500 text-sm">Simpan ID ini untuk mengecek status service Anda</p>
        </div>

        <!-- Booking Details -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6">
                <i class="fas fa-file-alt mr-2 text-purple-600"></i>Detail Booking
            </h3>

            <div class="space-y-4">
                <div class="flex justify-between py-3 border-b">
                    <span class="text-gray-600">Nama:</span>
                    <span class="font-semibold text-gray-800">{{ $booking->customer_name }}</span>
                </div>
                <div class="flex justify-between py-3 border-b">
                    <span class="text-gray-600">No HP:</span>
                    <span class="font-semibold text-gray-800">{{ $booking->customer_phone }}</span>
                </div>
                <div class="flex justify-between py-3 border-b">
                    <span class="text-gray-600">Tipe HP:</span>
                    <span class="font-semibold text-gray-800">{{ $booking->phone_type }}</span>
                </div>
                <div class="py-3 border-b">
                    <span class="text-gray-600">Keluhan:</span>
                    <p class="font-semibold text-gray-800 mt-1">{{ $booking->complaint }}</p>
                </div>
                <div class="flex justify-between py-3 border-b">
                    <span class="text-gray-600">Status:</span>
                    <span class="px-4 py-1 rounded-full text-sm font-bold {{ $booking->status_badge }}">
                        {{ $booking->status }}
                    </span>
                </div>
                @if($booking->estimated_arrival_date)
                <div class="flex justify-between py-3 border-b">
                    <span class="text-gray-600">Rencana Datang:</span>
                    <span class="font-semibold text-gray-800">{{ $booking->estimated_arrival_date->format('d M Y') }}</span>
                </div>
                @endif
                <div class="flex justify-between py-3">
                    <span class="text-gray-600">Tanggal Booking:</span>
                    <span class="font-semibold text-gray-800">{{ $booking->created_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Important Note -->
        <div class="bg-yellow-50 border border-yellow-300 rounded-xl p-6 mb-6">
            <h4 class="font-bold text-yellow-800 mb-3">
                <i class="fas fa-exclamation-triangle mr-2"></i>Langkah Selanjutnya
            </h4>
            <ul class="text-yellow-700 space-y-2">
                <li><i class="fas fa-check mr-2"></i>Simpan ID Booking <strong>{{ $booking->booking_code }}</strong></li>
                <li><i class="fas fa-check mr-2"></i>Tim kami akan menghubungi Anda via WhatsApp</li>
                <li><i class="fas fa-check mr-2"></i>Bawa HP ke toko untuk pengecekan</li>
                <li><i class="fas fa-check mr-2"></i>Anda bisa cek status service kapan saja</li>
            </ul>
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row gap-4">
            <a href="{{ route('tracking.show', $booking->booking_code) }}" class="flex-1 btn-primary text-white px-6 py-4 rounded-lg font-bold hover:shadow-lg transition inline-flex items-center justify-center">
                <i class="fas fa-search mr-2"></i>Cek Status Service
            </a>
            <a href="{{ route('beranda') }}" class="flex-1 bg-gray-200 text-gray-700 px-6 py-4 rounded-lg font-bold hover:bg-gray-300 transition inline-flex items-center justify-center">
                <i class="fas fa-home mr-2"></i>Kembali ke Beranda
            </a>
        </div>

        <!-- WhatsApp -->
        <div class="mt-6 text-center">
            <p class="text-gray-600 mb-3">Ada pertanyaan?</p>
            <a href="https://wa.me/628563051551?text=Halo%20Elfafa%20Service,%20saya%20sudah%20booking%20dengan%20ID%20{{ $booking->booking_code }}" 
                target="_blank" 
                class="inline-flex items-center text-green-600 font-semibold hover:text-green-700">
                <i class="fab fa-whatsapp mr-2 text-xl"></i>Hubungi via WhatsApp
            </a>
        </div>
    </div>
</section>
@endsection