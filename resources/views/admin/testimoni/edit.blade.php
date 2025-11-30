@extends('admin.layouts.app')

@section('title', 'Edit Testimoni')
@section('header', 'Edit Testimoni')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.testimoni.index') }}" class="text-purple-600 hover:text-purple-800">
        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Testimoni
    </a>
</div>

<div class="max-w-2xl">
    <div class="bg-white rounded-xl card-shadow p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-6">
            <i class="fas fa-edit mr-2 text-yellow-600"></i>Edit Testimoni
        </h3>

        <form action="{{ route('admin.testimoni.update', $testimoni->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Judul <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $testimoni->title) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('title') border-red-500 @enderror">
                    @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi <span class="text-red-500">*</span></label>
                    <textarea name="description" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('description') border-red-500 @enderror">{{ old('description', $testimoni->description) }}</textarea>
                    @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto Before</label>
                        @if($testimoni->before_photo_url)
                            <div class="mb-3">
                                <img src="{{ $testimoni->before_photo_url }}" alt="Before" class="w-full h-32 object-cover rounded-lg">
                                <p class="text-xs text-gray-500 mt-1">Foto saat ini</p>
                            </div>
                        @endif
                        <input type="file" name="before_photo" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto After</label>
                        @if($testimoni->after_photo_url)
                            <div class="mb-3">
                                <img src="{{ $testimoni->after_photo_url }}" alt="After" class="w-full h-32 object-cover rounded-lg">
                                <p class="text-xs text-gray-500 mt-1">Foto saat ini</p>
                            </div>
                        @endif
                        <input type="file" name="after_photo" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah</p>
                    </div>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 gradient-bg text-white py-3 rounded-lg font-semibold hover:opacity-90 transition">
                        <i class="fas fa-save mr-2"></i>Update
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