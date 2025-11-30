@extends('admin.layouts.app')

@section('title', 'Detail Service')
@section('header', 'Detail Service')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.service.index') }}" class="text-purple-600 hover:text-purple-800">
        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Service
    </a>
</div>

<div class="grid lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Info Booking -->
        <div class="bg-white rounded-xl card-shadow p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-2xl font-bold text-purple-600">{{ $service->booking->booking_code }}</h3>
                    <p class="text-gray-500">{{ $service->booking->customer_name }} • {{ $service->booking->customer_phone }}</p>
                </div>
                <span class="px-4 py-2 rounded-full text-sm font-bold {{ $service->status_badge }}">{{ $service->status }}</span>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-500">Tipe HP</p>
                    <p class="font-semibold text-gray-800">{{ $service->booking->phone_type }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-500">Keluhan</p>
                    <p class="font-semibold text-gray-800">{{ $service->booking->complaint }}</p>
                </div>
            </div>
        </div>

        <!-- Update Status -->
        <div class="bg-white rounded-xl card-shadow p-6">
            <h3 class="font-bold text-lg text-gray-800 mb-4"><i class="fas fa-sync-alt mr-2 text-blue-600"></i>Update Status</h3>
            <form action="{{ route('admin.service.update-status', $service->id) }}" method="POST">
                @csrf
                <div class="grid md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Baru</label>
                        <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500">
                            @foreach($statusList as $status)
                                <option value="{{ $status }}" {{ $service->status == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                        <input type="text" name="note" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500" placeholder="Catatan perubahan status...">
                    </div>
                </div>
                <button type="submit" class="gradient-bg text-white px-6 py-2 rounded-lg font-semibold hover:opacity-90 transition">
                    <i class="fas fa-save mr-2"></i>Update Status
                </button>
            </form>
        </div>

        <!-- Update Biaya -->
        <div class="bg-white rounded-xl card-shadow p-6">
            <h3 class="font-bold text-lg text-gray-800 mb-4"><i class="fas fa-dollar-sign mr-2 text-green-600"></i>Update Biaya</h3>
            <form action="{{ route('admin.service.update', $service->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Estimasi Biaya</label>
                        <input type="number" name="estimated_cost" value="{{ $service->estimated_cost }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500" placeholder="0">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Biaya Final</label>
                        <input type="number" name="final_cost" value="{{ $service->final_cost }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500" placeholder="0">
                    </div>
                </div>
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                    <i class="fas fa-save mr-2"></i>Simpan Biaya
                </button>
            </form>
        </div>

        <!-- Sparepart -->
        <div class="bg-white rounded-xl card-shadow p-6">
            <h3 class="font-bold text-lg text-gray-800 mb-4"><i class="fas fa-microchip mr-2 text-purple-600"></i>Sparepart Digunakan</h3>
            
            @if($service->spareparts->count() > 0)
                <table class="w-full mb-4">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-gray-500">Nama</th>
                            <th class="px-4 py-2 text-center text-xs font-semibold text-gray-500">Qty</th>
                            <th class="px-4 py-2 text-right text-xs font-semibold text-gray-500">Harga</th>
                            <th class="px-4 py-2 text-right text-xs font-semibold text-gray-500">Subtotal</th>
                            <th class="px-4 py-2"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($service->spareparts as $sp)
                            <tr>
                                <td class="px-4 py-3 font-medium">{{ $sp->name }}</td>
                                <td class="px-4 py-3 text-center">{{ $sp->pivot->quantity }}</td>
                                <td class="px-4 py-3 text-right">Rp {{ number_format($sp->pivot->price, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-right font-semibold">Rp {{ number_format($sp->pivot->price * $sp->pivot->quantity, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-right">
                                    <form action="{{ route('admin.service.remove-sparepart', [$service->id, $sp->id]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Hapus sparepart ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="3" class="px-4 py-3 font-bold text-right">Total:</td>
                            <td class="px-4 py-3 font-bold text-right text-green-600">Rp {{ number_format($service->total_sparepart_cost, 0, ',', '.') }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            @else
                <p class="text-gray-500 text-center py-4">Belum ada sparepart.</p>
            @endif

            <!-- Add Sparepart -->
            <form action="{{ route('admin.service.add-sparepart', $service->id) }}" method="POST" class="flex flex-wrap gap-3 mt-4 pt-4 border-t">
                @csrf
                <select name="sparepart_id" class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500" required>
                    <option value="">Pilih Sparepart</option>
                    @foreach($spareparts as $sp)
                        <option value="{{ $sp->id }}">{{ $sp->name }} - Rp {{ number_format($sp->price, 0, ',', '.') }} (Stok: {{ $sp->stock }})</option>
                    @endforeach
                </select>
                <input type="number" name="quantity" value="1" min="1" class="w-20 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500" placeholder="Qty">
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-purple-700 transition">
                    <i class="fas fa-plus mr-2"></i>Tambah
                </button>
            </form>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Summary -->
        <div class="bg-white rounded-xl card-shadow p-6">
            <h3 class="font-bold text-gray-800 mb-4">Ringkasan Biaya</h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Estimasi:</span>
                    <span class="font-semibold">{{ $service->estimated_cost ? 'Rp ' . number_format($service->estimated_cost, 0, ',', '.') : '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Total Sparepart:</span>
                    <span class="font-semibold">Rp {{ number_format($service->total_sparepart_cost, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between pt-3 border-t">
                    <span class="text-gray-800 font-bold">Biaya Final:</span>
                    <span class="font-bold text-green-600 text-lg">{{ $service->final_cost ? 'Rp ' . number_format($service->final_cost, 0, ',', '.') : '-' }}</span>
                </div>
            </div>
        </div>

        <!-- Timeline -->
        <div class="bg-white rounded-xl card-shadow p-6">
            <h3 class="font-bold text-gray-800 mb-4"><i class="fas fa-history mr-2 text-purple-600"></i>Riwayat</h3>
            <div class="space-y-4 max-h-96 overflow-y-auto">
                @foreach($service->statusHistories->reverse() as $history)
                    <div class="flex space-x-3">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center {{ $history->status_color }}">
                            <i class="fas {{ $history->status_icon }} text-xs"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-800 text-sm">{{ $history->status }}</p>
                            @if($history->note)
                                <p class="text-xs text-gray-600">{{ $history->note }}</p>
                            @endif
                            <p class="text-xs text-gray-400">{{ $history->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- WhatsApp -->
        <div class="bg-white rounded-xl card-shadow p-6">
            <a href="https://wa.me/62{{ ltrim($service->booking->customer_phone, '0') }}" target="_blank" class="w-full bg-green-500 text-white py-3 rounded-lg font-semibold hover:bg-green-600 transition inline-flex items-center justify-center">
                <i class="fab fa-whatsapp mr-2 text-xl"></i>Chat Customer
            </a>
        </div>
    </div>
</div>
@endsection