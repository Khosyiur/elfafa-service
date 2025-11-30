@extends('admin.layouts.app')

@section('title', 'Laporan')
@section('header', 'Laporan Bulanan')

@section('content')
<!-- Filter Bulan -->
<div class="bg-white rounded-xl card-shadow p-6 mb-6">
    <form action="{{ route('admin.report.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Bulan</label>
            <select name="month" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500">
                @foreach($months as $num => $name)
                    <option value="{{ $num }}" {{ $month == $num ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
            <select name="year" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500">
                @foreach($years as $y)
                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="gradient-bg text-white px-6 py-2 rounded-lg font-semibold hover:opacity-90 transition">
            <i class="fas fa-filter mr-2"></i>Tampilkan
        </button>
    </form>
</div>

<!-- Period Info -->
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">
        Laporan: {{ $startDate->translatedFormat('F Y') }}
    </h2>
    <p class="text-gray-500">Periode {{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }}</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl card-shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Service Masuk</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalServiceMasuk }}</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                <i class="fas fa-inbox text-blue-600"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl card-shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Service Selesai</p>
                <p class="text-3xl font-bold text-green-600">{{ $serviceSelesai }}</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                <i class="fas fa-check-circle text-green-600"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl card-shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Ditolak/Gagal</p>
                <p class="text-3xl font-bold text-red-600">{{ $serviceDitolak }}</p>
            </div>
            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                <i class="fas fa-times-circle text-red-600"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl card-shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Dalam Proses</p>
                <p class="text-3xl font-bold text-yellow-600">{{ $serviceDalamProses }}</p>
            </div>
            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                <i class="fas fa-spinner text-yellow-600"></i>
            </div>
        </div>
    </div>
</div>

<!-- Revenue Cards -->
<div class="grid lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-gradient-to-br from-purple-600 to-purple-800 rounded-xl p-6 text-white">
        <div class="flex items-center justify-between mb-2">
            <p class="text-purple-200">Total Pendapatan</p>
            <i class="fas fa-wallet text-2xl text-purple-300"></i>
        </div>
        <p class="text-3xl font-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        <p class="text-purple-200 text-sm mt-2">Dari {{ $serviceSelesai }} service selesai</p>
    </div>

    <div class="bg-gradient-to-br from-green-600 to-green-800 rounded-xl p-6 text-white">
        <div class="flex items-center justify-between mb-2">
            <p class="text-green-200">Rata-rata Biaya Service</p>
            <i class="fas fa-calculator text-2xl text-green-300"></i>
        </div>
        <p class="text-3xl font-bold">Rp {{ number_format($rataRataBiaya, 0, ',', '.') }}</p>
        <p class="text-green-200 text-sm mt-2">Per service selesai</p>
    </div>

    <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl p-6 text-white">
        <div class="flex items-center justify-between mb-2">
            <p class="text-blue-200">Total Sparepart Terpakai</p>
            <i class="fas fa-microchip text-2xl text-blue-300"></i>
        </div>
        <p class="text-3xl font-bold">Rp {{ number_format($totalSparepartValue, 0, ',', '.') }}</p>
        <p class="text-blue-200 text-sm mt-2">Nilai sparepart yang digunakan</p>
    </div>
</div>

<div class="grid lg:grid-cols-2 gap-6 mb-8">
    <!-- Sparepart Terlaris -->
    <div class="bg-white rounded-xl card-shadow">
        <div class="p-6 border-b">
            <h3 class="font-bold text-lg text-gray-800">
                <i class="fas fa-fire mr-2 text-orange-500"></i>Sparepart Paling Sering Dipakai
            </h3>
        </div>
        <div class="p-6">
            @if($sparepartUsage->count() > 0)
                <div class="space-y-4">
                    @foreach($sparepartUsage as $index => $sp)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <span class="w-8 h-8 rounded-full {{ $index < 3 ? 'bg-purple-100 text-purple-600' : 'bg-gray-100 text-gray-600' }} flex items-center justify-center font-bold text-sm">
                                    {{ $index + 1 }}
                                </span>
                                <span class="font-medium text-gray-800">{{ $sp->name }}</span>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-800">{{ $sp->total_used }} unit</p>
                                <p class="text-xs text-gray-500">Rp {{ number_format($sp->total_value, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-8">Tidak ada data.</p>
            @endif
        </div>
    </div>

    <!-- Status Distribution -->
    <div class="bg-white rounded-xl card-shadow">
        <div class="p-6 border-b">
            <h3 class="font-bold text-lg text-gray-800">
                <i class="fas fa-chart-pie mr-2 text-blue-500"></i>Distribusi Status Service
            </h3>
        </div>
        <div class="p-6">
            @if($servicePerStatus->count() > 0)
                <div class="space-y-3">
                    @foreach($servicePerStatus as $status)
                        @php
                            $percentage = $totalServiceMasuk > 0 ? ($status->total / $totalServiceMasuk) * 100 : 0;
                            $color = match($status->status) {
                                'Diambil Pelanggan' => 'bg-green-500',
                                'Selesai & Siap Diambil' => 'bg-green-400',
                                'Dalam Proses Perbaikan' => 'bg-blue-500',
                                'Menunggu Persetujuan Harga' => 'bg-yellow-500',
                                'Ditolak' => 'bg-red-500',
                                default => 'bg-gray-400'
                            };
                        @endphp
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-600">{{ $status->status }}</span>
                                <span class="font-semibold">{{ $status->total }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="{{ $color }} h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-8">Tidak ada data.</p>
            @endif
        </div>
    </div>
</div>

<!-- Service Selesai Table -->
<div class="bg-white rounded-xl card-shadow">
    <div class="p-6 border-b">
        <h3 class="font-bold text-lg text-gray-800">
            <i class="fas fa-list mr-2 text-green-500"></i>Daftar Service Selesai Bulan Ini
        </h3>
    </div>
    <div class="overflow-x-auto">
        @if($completedServices->count() > 0)
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Booking</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">HP</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Biaya Final</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Selesai</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($completedServices as $service)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-mono text-purple-600">{{ $service->booking->booking_code }}</td>
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $service->booking->customer_name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $service->booking->phone_type }}</td>
                            <td class="px-6 py-4 text-right font-bold text-green-600">Rp {{ number_format($service->final_cost ?? 0, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-gray-500 text-sm">{{ $service->completed_at?->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500 text-center py-12">Tidak ada service selesai di bulan ini.</p>
        @endif
    </div>
</div>
@endsection