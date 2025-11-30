@extends('admin.layouts.app')

@section('title', 'Kelola Sparepart')
@section('header', 'Kelola Sparepart')

@section('content')
<!-- Header Actions -->
<div class="flex flex-wrap justify-between items-center gap-4 mb-6">
    <div class="flex gap-2">
        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
            <i class="fas fa-check-circle mr-1"></i>Tersedia: {{ \App\Models\Sparepart::active()->where('stock', '>', 4)->count() }}
        </span>
        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm font-semibold">
            <i class="fas fa-exclamation-triangle mr-1"></i>Menipis: {{ \App\Models\Sparepart::lowStock()->count() }}
        </span>
        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-semibold">
            <i class="fas fa-times-circle mr-1"></i>Habis: {{ \App\Models\Sparepart::outOfStock()->count() }}
        </span>
    </div>
    <a href="{{ route('admin.sparepart.create') }}" class="gradient-bg text-white px-6 py-2 rounded-lg font-semibold hover:opacity-90 transition">
        <i class="fas fa-plus mr-2"></i>Tambah Sparepart
    </a>
</div>

<!-- Filter -->
<div class="bg-white rounded-xl card-shadow p-6 mb-6">
    <form action="{{ route('admin.sparepart.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
        <div class="flex-1 min-w-64">
            <label class="block text-sm font-medium text-gray-700 mb-2">Cari</label>
            <input type="text" name="search" value="{{ request('search') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500" placeholder="Nama sparepart, tipe HP...">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Status Stok</label>
            <select name="stock_status" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500">
                <option value="">Semua</option>
                <option value="available" {{ request('stock_status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                <option value="low" {{ request('stock_status') == 'low' ? 'selected' : '' }}>Menipis</option>
                <option value="empty" {{ request('stock_status') == 'empty' ? 'selected' : '' }}>Habis</option>
            </select>
        </div>
        <button type="submit" class="gradient-bg text-white px-6 py-2 rounded-lg font-semibold hover:opacity-90 transition">
            <i class="fas fa-search mr-2"></i>Filter
        </button>
        @if(request()->hasAny(['search', 'stock_status']))
            <a href="{{ route('admin.sparepart.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">Reset</a>
        @endif
    </form>
</div>

<!-- Table -->
<div class="bg-white rounded-xl card-shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Sparepart</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Kompatibilitas</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase">Harga</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">Stok</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($spareparts as $sp)
                    <tr class="hover:bg-gray-50 transition {{ !$sp->active ? 'opacity-50' : '' }}">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                                    @if($sp->image_url)
                                        <img src="{{ $sp->image_url }}" class="w-full h-full object-cover rounded-lg">
                                    @else
                                        <i class="fas fa-microchip text-gray-400"></i>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $sp->name }}</p>
                                    @if($sp->warranty)
                                        <p class="text-xs text-gray-500"><i class="fas fa-shield-alt mr-1"></i>{{ $sp->warranty }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600 text-sm">{{ $sp->compatible_for ?? '-' }}</td>
                        <td class="px-6 py-4 text-right font-semibold text-gray-800">{{ $sp->formatted_price }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-bold {{ $sp->stock <= 0 ? 'text-red-600' : ($sp->stock < 5 ? 'text-yellow-600' : 'text-green-600') }}">
                                {{ $sp->stock }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $sp->stock_badge }}">{{ $sp->stock_status }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center space-x-1">
                                <a href="{{ route('admin.sparepart.stock', $sp->id) }}" class="p-2 text-green-600 hover:bg-green-100 rounded-lg transition" title="Kelola Stok">
                                    <i class="fas fa-boxes"></i>
                                </a>
                                <a href="{{ route('admin.sparepart.edit', $sp->id) }}" class="p-2 text-yellow-600 hover:bg-yellow-100 rounded-lg transition" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.sparepart.toggle-active', $sp->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="p-2 {{ $sp->active ? 'text-gray-600 hover:bg-gray-100' : 'text-blue-600 hover:bg-blue-100' }} rounded-lg transition" title="{{ $sp->active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                        <i class="fas {{ $sp->active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.sparepart.destroy', $sp->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-100 rounded-lg transition" title="Hapus" onclick="return confirm('Hapus sparepart ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-box-open text-4xl mb-3"></i>
                            <p>Tidak ada data sparepart.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($spareparts->hasPages())
        <div class="px-6 py-4 border-t">{{ $spareparts->withQueryString()->links() }}</div>
    @endif
</div>
@endsection