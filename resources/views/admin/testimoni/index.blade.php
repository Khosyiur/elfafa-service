@extends('admin.layouts.app')

@section('title', 'Kelola Testimoni')
@section('header', 'Kelola Testimoni')

@section('content')
<!-- Header -->
<div class="flex justify-between items-center mb-6">
    <p class="text-gray-600">Kelola testimoni hasil service untuk ditampilkan di homepage</p>
    <a href="{{ route('admin.testimoni.create') }}" class="gradient-bg text-white px-6 py-2 rounded-lg font-semibold hover:opacity-90 transition">
        <i class="fas fa-plus mr-2"></i>Tambah Testimoni
    </a>
</div>

<!-- Grid -->
@if($testimonis->count() > 0)
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($testimonis as $testimoni)
            <div class="bg-white rounded-xl card-shadow overflow-hidden">
                <!-- Photos -->
                @if($testimoni->has_photos)
                    <div class="grid grid-cols-2 h-40">
                        <div class="relative bg-gray-100">
                            @if($testimoni->before_photo_url)
                                <img src="{{ $testimoni->before_photo_url }}" alt="Before" class="w-full h-full object-cover">
                                <span class="absolute bottom-2 left-2 bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">Before</span>
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <i class="fas fa-image text-2xl"></i>
                                </div>
                            @endif
                        </div>
                        <div class="relative bg-gray-100">
                            @if($testimoni->after_photo_url)
                                <img src="{{ $testimoni->after_photo_url }}" alt="After" class="w-full h-full object-cover">
                                <span class="absolute bottom-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">After</span>
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <i class="fas fa-image text-2xl"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="h-32 bg-gray-100 flex items-center justify-center">
                        <i class="fas fa-images text-4xl text-gray-300"></i>
                    </div>
                @endif

                <!-- Content -->
                <div class="p-5 relative z-10 bg-white">
                    <h3 class="font-bold text-gray-800 mb-2">{{ $testimoni->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($testimoni->description, 100) }}</p>
                    <p class="text-xs text-gray-400 mb-4">
                        <i class="far fa-clock mr-1"></i>{{ $testimoni->created_at->format('d M Y') }}
                    </p>

                    <div class="flex gap-2">
                        <a href="{{ route('admin.testimoni.edit', $testimoni->id) }}" class="flex-1 bg-yellow-100 text-yellow-700 py-2 rounded-lg font-semibold hover:bg-yellow-200 transition text-center text-sm">
                            <i class="fas fa-edit mr-1"></i>Edit
                        </a>
                        <form action="{{ route('admin.testimoni.destroy', $testimoni->id) }}" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-100 text-red-700 py-2 rounded-lg font-semibold hover:bg-red-200 transition text-sm" onclick="return confirm('Hapus testimoni ini?')">
                                <i class="fas fa-trash mr-1"></i>Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($testimonis->hasPages())
        <div class="mt-6">{{ $testimonis->links() }}</div>
    @endif
@else
    <div class="bg-white rounded-xl card-shadow p-12 text-center">
        <i class="fas fa-images text-5xl text-gray-300 mb-4"></i>
        <h3 class="text-lg font-bold text-gray-600 mb-2">Belum ada testimoni</h3>
        <p class="text-gray-500 mb-6">Tambahkan testimoni hasil service untuk ditampilkan di homepage</p>
        <a href="{{ route('admin.testimoni.create') }}" class="gradient-bg text-white px-6 py-3 rounded-lg font-semibold hover:opacity-90 transition inline-block">
            <i class="fas fa-plus mr-2"></i>Tambah Testimoni Pertama
        </a>
    </div>
@endif
@endsection