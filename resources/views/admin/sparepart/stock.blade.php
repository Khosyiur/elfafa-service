@extends('admin.layouts.app')

@section('title', 'Kelola Stok')
@section('header', 'Kelola Stok Sparepart')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.sparepart.index') }}" class="text-purple-600 hover:text-purple-800">
        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Sparepart
    </a>
</div>

<div class="grid lg:grid-cols-3 gap-6">
    <!-- Info & Form -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Sparepart Info -->
        <div class="bg-white rounded-xl card-shadow p-6">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-gray-100 rounded-xl flex items-center justify-center">
                    @if($sparepart->image_url)
                        <img src="{{ $sparepart->image_url }}" class="w-full h-full object-cover rounded-xl">
                    @else
                        <i class="fas fa-microchip text-2xl text-gray-400"></i>
                    @endif
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-gray-800">{{ $sparepart->name }}</h3>
                    <p class="text-gray-500">{{ $sparepart->compatible_for ?? '-' }}</p>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-bold {{ $sparepart->stock <= 0 ? 'text-red-600' : ($sparepart->stock < 5 ? 'text-yellow-600' : 'text-green-600') }}">
                        {{ $sparepart->stock }}
                    </p>
                    <p class="text-gray-500 text-sm">unit tersedia</p>
                </div>
            </div>
        </div>

        <!-- Form Update Stok -->
        <div class="bg-white rounded-xl card-shadow p-6">
            <h3 class="font-bold text-lg text-gray-800 mb-6">
                <i class="fas fa-boxes mr-2 text-purple-600"></i>Update Stok
            </h3>

            <form action="{{ route('admin.sparepart.update-stock', $sparepart->id) }}" method="POST">
                @csrf
                <div class="grid md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Perubahan</label>
                        <select name="change_type" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500" required>
                            <option value="IN">➕ Stok Masuk</option>
                            <option value="OUT">➖ Stok Keluar</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah</label>
                        <input type="number" name="quantity" min="1" value="1" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                        <input type="text" name="note" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500" placeholder="Keterangan...">
                    </div>
                </div>
                <button type="submit" class="gradient-bg text-white px-6 py-3 rounded-lg font-semibold hover:opacity-90 transition">
                    <i class="fas fa-save mr-2"></i>Update Stok
                </button>
            </form>
        </div>

        <!-- Riwayat Stok -->
        <div class="bg-white rounded-xl card-shadow overflow-hidden">
            <div class="p-6 border-b">
                <h3 class="font-bold text-lg text-gray-800">
                    <i class="fas fa-history mr-2 text-blue-600"></i>Riwayat Perubahan Stok
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Tipe</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Jumlah</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($sparepart->stockHistories as $history)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $history->created_at->format('d M Y, H:i') }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $history->type_badge }}">
                                        {{ $history->type_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center font-bold {{ $history->change_type == 'IN' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $history->change_type == 'IN' ? '+' : '-' }}{{ $history->quantity }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $history->note ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada riwayat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <div class="bg-white rounded-xl card-shadow p-6">
            <h3 class="font-bold text-gray-800 mb-4">Info Sparepart</h3>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">Harga:</span>
                    <span class="font-semibold">{{ $sparepart->formatted_price }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Garansi:</span>
                    <span class="font-semibold">{{ $sparepart->warranty ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Status:</span>
                    <span class="px-2 py-1 rounded-full text-xs font-bold {{ $sparepart->stock_badge }}">{{ $sparepart->stock_status }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Aktif:</span>
                    <span class="font-semibold">{{ $sparepart->active ? 'Ya' : 'Tidak' }}</span>
                </div>
            </div>
        </div>

        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
            <p class="text-sm text-yellow-800">
                <i class="fas fa-lightbulb mr-2"></i>
                <strong>Tips:</strong> Stok akan otomatis berkurang saat digunakan di service dan bertambah jika dihapus dari service.
            </p>
        </div>
    </div>
</div>
@endsection