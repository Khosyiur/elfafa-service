@extends('customer.layouts.app')

@section('title', 'Booking Service - Elfafa Service')
@section('description', 'Booking service HP online. Isi form dan dapatkan ID booking untuk tracking status perbaikan.')

@section('content')
<!-- Hero Section -->
<section class="gradient-bg text-white pt-32 pb-12 px-4">
    <div class="container mx-auto text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Booking Service</h1>
        <p class="text-xl text-gray-100">Isi form di bawah untuk booking service HP Anda</p>
    </div>
</section>

<!-- Form Section -->
<section class="py-12 px-4 bg-gray-50">
    <div class="container mx-auto max-w-2xl">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-calendar-plus mr-2 text-purple-600"></i>Form Booking
                </h2>
                <p class="text-gray-600">Lengkapi data berikut untuk melakukan booking service</p>
            </div>

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Nama -->
                <div class="mb-6">
                    <label for="customer_name" class="block font-semibold text-gray-700 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="customer_name" id="customer_name" 
                        value="{{ old('customer_name') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('customer_name') border-red-500 @enderror"
                        placeholder="Masukkan nama lengkap Anda">
                </div>

                <!-- No HP -->
                <div class="mb-6">
                    <label for="customer_phone" class="block font-semibold text-gray-700 mb-2">
                        Nomor HP/WhatsApp <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="customer_phone" id="customer_phone" 
                        value="{{ old('customer_phone') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('customer_phone') border-red-500 @enderror"
                        placeholder="Contoh: 081234567890">
                </div>

                <!-- Tipe HP -->
                <div class="mb-6">
                    <label for="phone_type" class="block font-semibold text-gray-700 mb-2">
                        Tipe HP <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="phone_type" id="phone_type" 
                        value="{{ old('phone_type') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('phone_type') border-red-500 @enderror"
                        placeholder="Contoh: iPhone 11, Samsung A52, Xiaomi Redmi Note 10">
                </div>

                <!-- Keluhan -->
                <div class="mb-6">
                    <label for="complaint" class="block font-semibold text-gray-700 mb-2">
                        Keluhan Kerusakan <span class="text-red-500">*</span>
                    </label>
                    <textarea name="complaint" id="complaint" rows="4"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('complaint') border-red-500 @enderror"
                        placeholder="Jelaskan kerusakan HP Anda secara detail...">{{ old('complaint') }}</textarea>
                </div>

                <!-- Foto Kerusakan -->
                <div class="mb-6">
                    <label for="photo" class="block font-semibold text-gray-700 mb-2">
                        Foto Kondisi HP <span class="text-gray-400 font-normal">(Opsional)</span>
                    </label>
                    <input type="file" name="photo" id="photo" accept="image/*"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('photo') border-red-500 @enderror">
                    <p class="text-sm text-gray-500 mt-2">
                        <i class="fas fa-info-circle mr-1"></i>Format: JPG, PNG. Maksimal 2MB
                    </p>
                </div>

                <!-- Tanggal Kedatangan -->
                <div class="mb-8">
                    <label for="estimated_arrival_date" class="block font-semibold text-gray-700 mb-2">
                        Perkiraan Tanggal Datang <span class="text-gray-400 font-normal">(Opsional)</span>
                    </label>
                    <input type="date" name="estimated_arrival_date" id="estimated_arrival_date" 
                        value="{{ old('estimated_arrival_date') }}"
                        min="{{ date('Y-m-d') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('estimated_arrival_date') border-red-500 @enderror">
                </div>

                <!-- Submit -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <button type="submit" class="flex-1 btn-primary text-white px-6 py-4 rounded-lg font-bold hover:shadow-lg transition inline-flex items-center justify-center">
                        <i class="fas fa-paper-plane mr-2"></i>Kirim Booking
                    </button>
                    <a href="{{ route('beranda') }}" class="flex-1 bg-gray-200 text-gray-700 px-6 py-4 rounded-lg font-bold hover:bg-gray-300 transition inline-flex items-center justify-center">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>
            </form>
        </div>

        <!-- Info Box -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-xl p-6">
            <h3 class="font-bold text-blue-800 mb-3">
                <i class="fas fa-info-circle mr-2"></i>Informasi Penting
            </h3>
            <ul class="text-blue-700 space-y-2 text-sm">
                <li><i class="fas fa-check mr-2"></i>Setelah booking, Anda akan mendapat ID Booking untuk tracking</li>
                <li><i class="fas fa-check mr-2"></i>Tim kami akan menghubungi Anda via WhatsApp untuk konfirmasi</li>
                <li><i class="fas fa-check mr-2"></i>Bawa HP ke toko sesuai tanggal yang dijadwalkan</li>
                <li><i class="fas fa-check mr-2"></i>Konsultasi dan pengecekan awal GRATIS</li>
            </ul>
        </div>
    </div>
</section>
@endsection