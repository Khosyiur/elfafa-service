@extends('admin.layouts.app')

@section('title', 'Edit Sparepart')
@section('header', 'Edit Sparepart')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.sparepart.index') }}" class="text-purple-600 hover:text-purple-800">
        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Sparepart
    </a>
</div>

<div class="max-w-2xl">
    <div class="bg-white rounded-xl card-shadow p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-6">
            <i class="fas fa-edit mr-2 text-yellow-600"></i>Edit Sparepart: {{ $sparepart->name }}
        </h3>

        <form action="{{ route('admin.sparepart.update', $sparepart->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Sparepart <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $sparepart->name) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('name') border-red-500 @enderror">
                    @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kompatibilitas HP</label>
                    <input type="text" name="compatible_for" value="{{ old('compatible_for', $sparepart->compatible_for) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-gray-500">Rp</span>
                        <input type="number" name="price" value="{{ old('price', $sparepart->price) }}" class="w-full border border-gray-300 rounded-lg pl-12 pr-4 py-3 focus:ring-2 focus:ring-purple-500 @error('price') border-red-500 @enderror">
                    </div>
                    @error('price')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Garansi</label>
                    <input type="text" name="warranty" value="{{ old('warranty', $sparepart->warranty) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Sparepart</label>
                    @if($sparepart->image_url)
                        <div class="mb-3">
                            <img src="{{ $sparepart->image_url }}" alt="Current" class="w-32 h-32 object-cover rounded-lg">
                            <p class="text-xs text-gray-500 mt-1">Gambar saat ini</p>
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500">
                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah gambar</p>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600"><i class="fas fa-info-circle mr-2"></i>Stok saat ini: <strong>{{ $sparepart->stock }} unit</strong>. Untuk mengubah stok, gunakan menu <a href="{{ route('admin.sparepart.stock', $sparepart->id) }}" class="text-purple-600 underline">Kelola Stok</a>.</p>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 gradient-bg text-white py-3 rounded-lg font-semibold hover:opacity-90 transition">
                        <i class="fas fa-save mr-2"></i>Update
                    </button>
                    <a href="{{ route('admin.sparepart.index') }}" class="flex-1 bg-gray-200 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-300 transition text-center">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection