@extends('admin.layouts.app')

@section('title', 'Tambah Sparepart')
@section('header', 'Tambah Sparepart')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.sparepart.index') }}" class="text-purple-600 hover:text-purple-800">
        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Sparepart
    </a>
</div>

<div class="max-w-2xl">
    <div class="bg-white rounded-xl card-shadow p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-6">
            <i class="fas fa-plus-circle mr-2 text-purple-600"></i>Form Tambah Sparepart
        </h3>

        <form action="{{ route('admin.sparepart.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Sparepart <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('name') border-red-500 @enderror" placeholder="Contoh: LCD iPhone 11">
                    @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kompatibilitas HP</label>
                    <input type="text" name="compatible_for" value="{{ old('compatible_for') }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500" placeholder="Contoh: iPhone 11, iPhone 11 Pro">
                    <p class="text-xs text-gray-500 mt-1">Tipe HP yang kompatibel, pisahkan dengan koma</p>
                </div>

                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Harga <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-gray-500">Rp</span>
                            <input type="number" name="price" value="{{ old('price') }}" class="w-full border border-gray-300 rounded-lg pl-12 pr-4 py-3 focus:ring-2 focus:ring-purple-500 @error('price') border-red-500 @enderror" placeholder="0">
                        </div>
                        @error('price')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Stok Awal <span class="text-red-500">*</span></label>
                        <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('stock') border-red-500 @enderror" placeholder="0">
                        @error('stock')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Garansi</label>
                    <input type="text" name="warranty" value="{{ old('warranty') }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500" placeholder="Contoh: 30 Hari">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Sparepart</label>
                    <input type="file" name="image" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maksimal 2MB</p>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 gradient-bg text-white py-3 rounded-lg font-semibold hover:opacity-90 transition">
                        <i class="fas fa-save mr-2"></i>Simpan
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