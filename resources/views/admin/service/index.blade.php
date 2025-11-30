@extends('admin.layouts.app')

@section('title', 'Kelola Service')
@section('header', 'Kelola Service')

@section('content')
<!-- Filter -->
<div class="bg-white rounded-xl card-shadow p-6 mb-6">
    <form action="{{ route('admin.service.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
        <div class="flex-1 min-w-64">
            <label class="block text-sm font-medium text-gray-700 mb-2">Cari</label>
            <input type="text" name="search" value="{{ request('search') }}" 
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500"
                placeholder="Kode booking, nama customer, HP...">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select name="status" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500">
                <option value="">Semua Status</option>
                @foreach($statusList as $status)
                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="gradient-bg text-white px-6 py-2 rounded-lg font-semibold hover:opacity-90 transition">
            <i class="fas fa-search mr-2"></i>Filter
        </button>
        @if(request()->hasAny(['search', 'status']))
            <a href="{{ route('admin.service.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">Reset</a>
        @endif
    </form>
</div>

<!-- Table -->
<div class="bg-white rounded-xl card-shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Booking</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Customer</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">HP</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Estimasi</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($services as $service)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <span class="font-mono font-semibold text-purple-600">{{ $service->booking->booking_code }}</span>
                            <p class="text-xs text-gray-500">{{ $service->created_at->format('d M Y') }}</p>
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
                            <p class="font-semibold text-gray-800">
                                {{ $service->estimated_cost ? 'Rp ' . number_format($service->estimated_cost, 0, ',', '.') : '-' }}
                            </p>
                            @if($service->final_cost)
                                <p class="text-sm text-green-600">Final: Rp {{ number_format($service->final_cost, 0, ',', '.') }}</p>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.service.show', $service->id) }}" class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-3"></i>
                            <p>Tidak ada data service.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($services->hasPages())
        <div class="px-6 py-4 border-t">{{ $services->withQueryString()->links() }}</div>
    @endif
</div>
@endsection