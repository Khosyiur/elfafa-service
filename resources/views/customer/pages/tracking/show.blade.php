@extends('customer.layouts.app')

@section('title', 'Status Service - ' . $booking->booking_code)

@section('content')
<!-- Hero Section -->
<section class="gradient-bg text-white pt-32 pb-12 px-4">
    <div class="container mx-auto text-center">
        <p class="text-gray-200 mb-2">ID Booking</p>
        <h1 class="text-3xl md:text-4xl font-bold mb-4">{{ $booking->booking_code }}</h1>
        <span class="inline-block px-6 py-2 rounded-full text-sm font-bold {{ $booking->status_badge }}">
            {{ $booking->status }}
        </span>
    </div>
</section>

<!-- Content Section -->
<section class="py-12 px-4 bg-gray-50">
    <div class="container mx-auto max-w-4xl">
        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <!-- Info HP -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">
                    <i class="fas fa-mobile-alt mr-2 text-purple-600"></i>Informasi HP
                </h2>

                <div class="space-y-3">
                    <div class="flex justify-between py-2 border-b">
                        <span class="text-gray-600">Nama:</span>
                        <span class="font-semibold">{{ $booking->customer_name }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b">
                        <span class="text-gray-600">No HP:</span>
                        <span class="font-semibold">{{ $booking->customer_phone }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b">
                        <span class="text-gray-600">Tipe HP:</span>
                        <span class="font-semibold">{{ $booking->phone_type }}</span>
                    </div>
                    <div class="py-2 border-b">
                        <span class="text-gray-600">Keluhan:</span>
                        <p class="font-semibold mt-1">{{ $booking->complaint }}</p>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600">Tanggal Booking:</span>
                        <span class="font-semibold">{{ $booking->created_at->format('d M Y') }}</span>
                    </div>
                </div>

                @if($booking->photo)
                    <div class="mt-4 pt-4 border-t">
                        <p class="text-gray-600 mb-2">Foto Kerusakan:</p>
                        <img src="{{ asset('storage/bookings/' . $booking->photo) }}" alt="Foto Kerusakan" class="w-full rounded-lg">
                    </div>
                @endif
            </div>

            <!-- Info Biaya -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">
                    <i class="fas fa-receipt mr-2 text-green-600"></i>Informasi Biaya
                </h2>

                @if($booking->service)
                    <div class="space-y-3">
                        <div class="flex justify-between py-2 border-b">
                            <span class="text-gray-600">Estimasi Biaya:</span>
                            <span class="font-semibold">
                                @if($booking->service->estimated_cost)
                                    Rp {{ number_format($booking->service->estimated_cost, 0, ',', '.') }}
                                @else
                                    <span class="text-gray-400">Belum ada</span>
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between py-2 border-b">
                            <span class="text-gray-600">Biaya Final:</span>
                            <span class="font-bold text-green-600 text-lg">
                                @if($booking->service->final_cost)
                                    Rp {{ number_format($booking->service->final_cost, 0, ',', '.') }}
                                @else
                                    <span class="text-gray-400 font-normal text-base">Belum ada</span>
                                @endif
                            </span>
                        </div>
                        
                    </div>

                    <!-- Sparepart yang digunakan -->
                    @if($booking->service->spareparts->count() > 0)
                        <div class="mt-6 pt-4 border-t">
                            <h3 class="font-semibold text-gray-800 mb-3">Sparepart yang Digunakan:</h3>
                            <div class="space-y-2">
                                @foreach($booking->service->spareparts as $sp)
                                    <div class="flex justify-between text-sm py-2 bg-gray-50 px-3 rounded">
                                        <span>{{ $sp->name }} (x{{ $sp->pivot->quantity }})</span>
                                        <span class="font-semibold">Rp {{ number_format($sp->pivot->price * $sp->pivot->quantity, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm py-2 bg-gray-50 px-3 rounded">
                                        <span>Garansi </span>
                                        <span class="font-semibold">{{ $sp->warranty }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="flex justify-between font-bold mt-3 pt-3 border-t">
                                <span>Total Sparepart:</span>
                                <span>Rp {{ number_format($booking->service->total_sparepart_cost, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    @endif
                @else
                    <p class="text-gray-500 text-center py-8">Data service belum tersedia.</p>
                @endif
            </div>
        </div>

        <!-- Timeline Status -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">
                <i class="fas fa-history mr-2 text-blue-600"></i>Riwayat Status
            </h2>

            @if($booking->service && $booking->service->statusHistories->count() > 0)
                <div class="relative">
                    <!-- Timeline Line -->
                    <div class="absolute left-5 top-0 bottom-0 w-0.5 bg-gray-200"></div>

                    @foreach($booking->service->statusHistories->reverse() as $history)
                        <div class="relative flex mb-6 last:mb-0">
                            <!-- Icon -->
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-white border-2 border-gray-200 flex items-center justify-center z-10 {{ $loop->first ? 'border-purple-500' : '' }}">
                                <i class="fas {{ $history->status_icon }} {{ $history->status_color }}"></i>
                            </div>

                            <!-- Content -->
                            <div class="ml-4 flex-1 bg-gray-50 rounded-lg p-4 {{ $loop->first ? 'bg-purple-50' : '' }}">
                                <div class="flex flex-wrap justify-between items-start gap-2">
                                    <h4 class="font-bold text-gray-800">{{ $history->status }}</h4>
                                    <span class="text-sm text-gray-400">
                                        {{ $history->created_at->format('d M Y, H:i') }}
                                    </span>
                                </div>
                                @if($history->note)
                                    <p class="text-gray-600 text-sm mt-1">{{ $history->note }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-8">Belum ada riwayat status.</p>
            @endif
        </div>

        <!-- Actions -->
        <div class="mt-6 flex flex-col sm:flex-row gap-4">
            <a href="{{ route('tracking.index') }}" class="flex-1 bg-gray-200 text-gray-700 px-6 py-4 rounded-lg font-bold hover:bg-gray-300 transition inline-flex items-center justify-center">
                <i class="fas fa-search mr-2"></i>Cari Booking Lain
            </a>
            <a href="https://wa.me/628563051551?text=Halo%20Elfafa%20Service,%20saya%20mau%20tanya%20tentang%20booking%20{{ $booking->booking_code }}" 
                target="_blank"
                class="flex-1 bg-green-500 text-white px-6 py-4 rounded-lg font-bold hover:bg-green-600 transition inline-flex items-center justify-center">
                <i class="fab fa-whatsapp mr-2"></i>Hubungi Kami
            </a>
        </div>
    </div>
</section>
@endsection