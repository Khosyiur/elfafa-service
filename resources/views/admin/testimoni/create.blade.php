@extends('admin.layouts.app')

@section('title', 'Tambah Testimoni')
@section('header', 'Tambah Testimoni')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.testimoni.index') }}" class="text-purple-600 hover:text-purple-800">
        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Testimoni
    </a>
</div>

<div class="max-w-2xl">
    <div class="bg-white rounded-xl card-shadow p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-6">
            <i class="fas fa-plus-circle mr-2 text-purple-600"></i>Form Tambah Testimoni
        </h3>

        <form action="{{ route('admin.testimoni.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Judul <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('title') border-red-500 @enderror" placeholder="Contoh: iPhone 11 - Ganti LCD Retak">
                    @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi <span class="text-red-500">*</span></label>
                    <textarea name="description" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('description') border-red-500 @enderror" placeholder="Ceritakan detail perbaikan yang dilakukan...">{{ old('description') }}</textarea>
                    @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto Before</label>
                        <input type="file" name="before_photo" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500">
                        <p class="text-xs text-gray-500 mt-1">Foto kondisi sebelum diperbaiki</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto After</label>
                        <input type="file" name="after_photo" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500">
                        <p class="text-xs text-gray-500 mt-1">Foto kondisi setelah diperbaiki</p>
                    </div>
                </div>

                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <p class="text-sm text-blue-800">
                        <i class="fas fa-info-circle mr-2"></i>
                        Testimoni akan ditampilkan di homepage website untuk calon customer.
                    </p>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 gradient-bg text-white py-3 rounded-lg font-semibold hover:opacity-90 transition">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                    <a href="{{ route('admin.testimoni.index') }}" class="flex-1 bg-gray-200 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-300 transition text-center">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection