@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Booking Baru -->
    <div class="bg-white rounded-xl p-6 card-shadow border-l-4 border-yellow-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Booking Baru</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $bookingBaru }}</h3>
                <p class="text-xs text-gray-400 mt-1">Menunggu konfirmasi</p>
            </div>
            <div class="w-14 h-14 bg-yellow-100 rounded-full flex items-center justify-center">
                <i class="fas fa-clock text-2xl text-yellow-600"></i>
            </div>
        </div>
    </div>

    <!-- Service Dalam Proses -->
    <div class="bg-white rounded-xl p-6 card-shadow border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Dalam Proses</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $serviceDalamProses }}</h3>
                <p class="text-xs text-gray-400 mt-1">Service aktif</p>
            </div>
            <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center">
                <i class="fas fa-wrench text-2xl text-blue-600"></i>
            </div>
        </div>
    </div>

    <!-- Service Selesai Bulan Ini -->
    <div class="bg-white rounded-xl p-6 card-shadow border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Selesai Bulan Ini</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $serviceSelesaiBulanIni }}</h3>
                <p class="text-xs text-gray-400 mt-1">Total: {{ $serviceSelesai }}</p>
            </div>
            <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center">
                <i class="fas fa-check-circle text-2xl text-green-600"></i>
            </div>
        </div>
    </div>

    <!-- Pendapatan Bulan Ini -->
    <div class="bg-white rounded-xl p-6 card-shadow border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Pendapatan</p>
                <h3 class="text-2xl font-bold text-gray-800">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</h3>
                <p class="text-xs text-gray-400 mt-1">Bulan ini</p>
            </div>
            <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center">
                <i class="fas fa-wallet text-2xl text-purple-600"></i>
            </div>
        </div>
    </div>
</div>

<!-- Alert Sparepart -->
@if($sparepartHabis > 0 || $sparepartMenipis > 0)
<div class="bg-orange-50 border-l-4 border-orange-500 p-4 rounded-r-lg mb-8">
    <div class="flex items-center">
        <i class="fas fa-exclamation-triangle text-orange-500 mr-3"></i>
        <div>
            <p class="font-semibold text-orange-800">Perhatian Stok Sparepart!</p>
            <p class="text-sm text-orange-700">
                @if($sparepartHabis > 0)
                    <span class="font-bold">{{ $sparepartHabis }}</span> sparepart stok habis.
                @endif
                @if($sparepartMenipis > 0)
                    <span class="font-bold">{{ $sparepartMenipis }}</span> sparepart stok menipis.
                @endif
                <a href="{{ route('admin.sparepart.index') }}" class="underline ml-2">Lihat Detail →</a>
            </p>
        </div>
    </div>
</div>
@endif

<div class="grid lg:grid-cols-2 gap-6 mb-8">
    <!-- Booking Terbaru -->
    <div class="bg-white rounded-xl card-shadow">
        <div class="p-6 border-b flex justify-between items-center">
            <h3 class="font-bold text-lg text-gray-800">
                <i class="fas fa-calendar-check mr-2 text-purple-600"></i>Booking Terbaru
            </h3>
            <a href="{{ route('admin.booking.index') }}" class="text-sm text-purple-600 hover:underline">Lihat Semua →</a>
        </div>
        <div class="p-6">
            @if($bookingTerbaru->count() > 0)
                <div class="space-y-4">
                    @foreach($bookingTerbaru as $booking)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center">
                                    <i class="fas fa-mobile-alt text-purple-600"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $booking->customer_name }}</p>
                                    <p class="text-sm text-gray-500">{{ $booking->phone_type }} • {{ $booking->booking_code }}</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $booking->status_badge }}">
                                {{ $booking->status }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-8">Belum ada booking.</p>
            @endif
        </div>
    </div>

    <!-- Sparepart Alert -->
    <div class="bg-white rounded-xl card-shadow">
        <div class="p-6 border-b flex justify-between items-center">
            <h3 class="font-bold text-lg text-gray-800">
                <i class="fas fa-exclamation-triangle mr-2 text-orange-500"></i>Stok Sparepart Menipis
            </h3>
            <a href="{{ route('admin.sparepart.index') }}" class="text-sm text-purple-600 hover:underline">Kelola Stok →</a>
        </div>
        <div class="p-6">
            @if($sparepartAlert->count() > 0)
                <div class="space-y-4">
                    @foreach($sparepartAlert as $sp)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded-full {{ $sp->stock <= 0 ? 'bg-red-100' : 'bg-yellow-100' }} flex items-center justify-center">
                                    <i class="fas fa-microchip {{ $sp->stock <= 0 ? 'text-red-600' : 'text-yellow-600' }}"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $sp->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $sp->compatible_for }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $sp->stock_badge }}">
                                    {{ $sp->stock }} unit
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-8">
                    <i class="fas fa-check-circle text-green-500 text-2xl mb-2"></i><br>
                    Semua stok aman!
                </p>
            @endif
        </div>
    </div>
</div>

<!-- Service Dalam Proses -->
<div class="bg-white rounded-xl card-shadow">
    <div class="p-6 border-b flex justify-between items-center">
        <h3 class="font-bold text-lg text-gray-800">
            <i class="fas fa-wrench mr-2 text-blue-600"></i>Service Dalam Proses
        </h3>
        <a href="{{ route('admin.service.index') }}" class="text-sm text-purple-600 hover:underline">Lihat Semua →</a>
    </div>
    <div class="overflow-x-auto">
        @if($serviceTerbaru->count() > 0)
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Booking</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">HP</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($serviceTerbaru as $service)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <span class="font-mono text-sm text-purple-600">{{ $service->booking->booking_code }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-800">{{ $service->booking->customer_name }}</p>
                                <p class="text-sm text-gray-500">{{ $service->booking->customer_phone }}</p>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $service->booking->phone_type }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $service->status_badge }}">
                                    {{ $service->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.service.show', $service->id) }}" class="text-purple-600 hover:text-purple-800">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500 text-center py-8">Tidak ada service dalam proses.</p>
        @endif
    </div>
</div>
@endsection