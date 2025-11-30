@extends('customer.layouts.app')

@section('title', 'Elfafa Service - Servis HP Profesional & Terpercaya')
@section('description', 'Servis HP profesional dengan teknisi berpengalaman. Garansi resmi, harga transparan, pengerjaan cepat.')

@section('content')
<!-- Hero Section -->
<section id="beranda" class="gradient-bg text-white pt-32 pb-20 px-4">
    <div class="container mx-auto">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="fade-in-up">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                    Solusi Terpercaya untuk <span class="text-yellow-300">Servis HP</span> Anda
                </h1>
                <p class="text-xl mb-8 text-gray-100">
                    Teknisi profesional, garansi resmi, pengerjaan cepat, dan harga transparan. Percayakan HP kesayangan Anda kepada kami!
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('booking.create') }}" class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-lg font-bold hover:bg-yellow-300 transition inline-flex items-center shadow-lg">
                        <i class="fas fa-calendar-check mr-2"></i>
                        Booking Servis Sekarang
                    </a>
                    <a href="{{ route('tracking.index') }}" class="bg-white text-purple-600 px-8 py-4 rounded-lg font-bold hover:bg-gray-100 transition inline-flex items-center shadow-lg">
                        <i class="fas fa-search mr-2"></i>
                        Cek Status Servis
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-6 mt-12">
                    <div>
                        <div class="text-3xl md:text-4xl font-bold">1000+</div>
                        <div class="text-gray-200 text-sm md:text-base">HP Terservis</div>
                    </div>
                    <div>
                        <div class="text-3xl md:text-4xl font-bold">98%</div>
                        <div class="text-gray-200 text-sm md:text-base">Kepuasan Pelanggan</div>
                    </div>
                    <div>
                        <div class="text-3xl md:text-4xl font-bold">5+</div>
                        <div class="text-gray-200 text-sm md:text-base">Tahun Pengalaman</div>
                    </div>
                </div>
            </div>

            <div class="hidden lg:block">
                <img src="https://images.unsplash.com/photo-1556656793-08538906a9f8?w=600&h=600&fit=crop" alt="Phone Repair" class="rounded-2xl shadow-2xl w-full">
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="layanan" class="py-20 px-4 bg-white">
    <div class="container mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Layanan Kami</h2>
            <p class="text-xl text-gray-600">Berbagai solusi untuk masalah HP Anda</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-white rounded-xl p-8 shadow-lg card-hover border border-gray-100">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-wrench text-3xl text-purple-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Perbaikan Hardware</h3>
                <p class="text-gray-600 mb-6">Servis komponen rusak seperti LCD, baterai, kamera, dan lainnya dengan garansi resmi</p>
                <a href="{{ route('layanan') }}#hardware" class="text-purple-600 font-semibold hover:text-purple-700 inline-flex items-center">
                    Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="bg-white rounded-xl p-8 shadow-lg card-hover border border-gray-100">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-code text-3xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Perbaikan Software</h3>
                <p class="text-gray-600 mb-6">Install ulang, update sistem, hapus virus, dan optimasi performa HP Anda</p>
                <a href="{{ route('layanan') }}#software" class="text-purple-600 font-semibold hover:text-purple-700 inline-flex items-center">
                    Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="bg-white rounded-xl p-8 shadow-lg card-hover border border-gray-100">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-microchip text-3xl text-green-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Ganti Sparepart</h3>
                <p class="text-gray-600 mb-6">Sparepart original dengan garansi resmi dan harga terjangkau, ready stock</p>
                <a href="{{ route('sparepart.index') }}" class="text-purple-600 font-semibold hover:text-purple-700 inline-flex items-center">
                    Lihat Sparepart <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="bg-white rounded-xl p-8 shadow-lg card-hover border border-gray-100">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-shield-alt text-3xl text-red-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Perawatan & Pembersihan</h3>
                <p class="text-gray-600 mb-6">Pembersihan menyeluruh untuk performa optimal dan umur panjang HP Anda</p>
                <a href="{{ route('layanan') }}#perawatan" class="text-purple-600 font-semibold hover:text-purple-700 inline-flex items-center">
                    Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="keunggulan" class="bg-gray-100 py-20 px-4">
    <div class="container mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Mengapa Memilih Elfafa Service?</h2>
            <p class="text-xl text-gray-600">Keunggulan yang membedakan kami dari yang lain</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-white rounded-xl p-8 text-center shadow-md hover:shadow-xl transition">
                <div class="w-20 h-20 bg-gradient-to-br from-purple-600 to-purple-800 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-clock text-3xl text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Servis Cepat</h3>
                <p class="text-gray-600">Pengerjaan cepat 1-3 hari kerja dengan hasil maksimal</p>
            </div>

            <div class="bg-white rounded-xl p-8 text-center shadow-md hover:shadow-xl transition">
                <div class="w-20 h-20 bg-gradient-to-br from-blue-600 to-blue-800 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-award text-3xl text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Teknisi Berpengalaman</h3>
                <p class="text-gray-600">Ditangani oleh teknisi profesional dan bersertifikat</p>
            </div>

            <div class="bg-white rounded-xl p-8 text-center shadow-md hover:shadow-xl transition">
                <div class="w-20 h-20 bg-gradient-to-br from-green-600 to-green-800 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-shield-alt text-3xl text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Garansi Servis</h3>
                <p class="text-gray-600">Garansi hingga 30 hari untuk setiap servis yang dilakukan</p>
            </div>

            <div class="bg-white rounded-xl p-8 text-center shadow-md hover:shadow-xl transition">
                <div class="w-20 h-20 bg-gradient-to-br from-yellow-600 to-yellow-800 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-dollar-sign text-3xl text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Harga Transparan</h3>
                <p class="text-gray-600">Harga jelas tanpa biaya tersembunyi, konsultasi gratis</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section id="booking" class="gradient-bg text-white py-16 px-4">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl md:text-5xl font-bold mb-6">HP Anda Bermasalah?</h2>
        <p class="text-xl mb-8 text-gray-100 max-w-2xl mx-auto">Konsultasi gratis dengan teknisi kami. Dapatkan solusi terbaik untuk masalah HP Anda!</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="https://wa.me/628563051551?text=Halo%20Elfafa%20Service,%20saya%20mau%20konsultasi" target="_blank" class="bg-green-500 text-white px-8 py-4 rounded-lg font-bold hover:bg-green-600 transition inline-flex items-center shadow-xl hover:shadow-2xl transform hover:scale-105">
                <i class="fab fa-whatsapp mr-2 text-2xl"></i>
                Konsultasi Gratis
            </a>
            <a href="{{ route('booking.create') }}" class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-lg font-bold hover:bg-yellow-300 transition inline-flex items-center shadow-xl hover:shadow-2xl transform hover:scale-105">
                <i class="fas fa-calendar-plus mr-2"></i>
                Booking Sekarang
            </a>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section id="testimoni" class="py-20 px-4 bg-white">
    <div class="container mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Hasil Service Terbaru</h2>
            <p class="text-xl text-gray-600">Kepuasan pelanggan adalah prioritas kami</p>
        </div>

        @if($testimonis->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($testimonis as $testimoni)
                    <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-2xl transition border border-gray-100">
                        <h3 class="font-bold text-lg text-gray-800 mb-3">{{ $testimoni->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($testimoni->description, 150) }}</p>

                        @if($testimoni->has_photos)
                            <div class="grid grid-cols-2 gap-3 mb-4">
                                @if($testimoni->before_photo)
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1 font-semibold">Before:</p>
                                        <img src="{{ $testimoni->before_photo_url }}" alt="Before" class="w-full h-32 object-cover rounded-lg">
                                    </div>
                                @endif
                                @if($testimoni->after_photo)
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1 font-semibold">After:</p>
                                        <img src="{{ $testimoni->after_photo_url }}" alt="After" class="w-full h-32 object-cover rounded-lg">
                                    </div>
                                @endif
                            </div>
                        @endif

                        <p class="text-sm text-gray-400">
                            <i class="far fa-clock mr-1"></i>{{ $testimoni->created_at->diffForHumans() }}
                        </p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-gray-500">
                <i class="fas fa-images text-4xl mb-4"></i>
                <p>Belum ada testimoni.</p>
            </div>
        @endif
    </div>
</section>

<!-- Contact Section -->
<section id="kontak" class="bg-gray-100 py-20 px-4">
    <div class="container mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Hubungi Kami</h2>
            <p class="text-xl text-gray-600">Kami siap membantu Anda kapan saja</p>
        </div>

        <div class="grid md:grid-cols-2 gap-12 max-w-4xl mx-auto">
            <!-- Contact Info -->
            <div class="bg-white rounded-xl p-8 shadow-lg">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Informasi Kontak</h3>
                <div class="space-y-4">
                    <p class="flex items-center text-gray-700">
                        <i class="fas fa-map-marker-alt text-purple-600 text-xl mr-4 w-6"></i>
                        Jl. Raya Contoh No. 123, Surabaya
                    </p>
                    <p class="flex items-center text-gray-700">
                        <i class="fas fa-phone text-purple-600 text-xl mr-4 w-6"></i>
                        0856-3051-551
                    </p>
                    <p class="flex items-center text-gray-700">
                        <i class="fas fa-envelope text-purple-600 text-xl mr-4 w-6"></i>
                        info@elfafaservice.com
                    </p>
                    <p class="flex items-center text-gray-700">
                        <i class="fas fa-clock text-purple-600 text-xl mr-4 w-6"></i>
                        Senin - Sabtu, 09:00 - 18:00 WIB
                    </p>
                </div>

                <div class="mt-6 pt-6 border-t">
                    <a href="https://wa.me/628563051551" target="_blank" class="w-full bg-green-500 text-white py-3 rounded-lg font-bold hover:bg-green-600 transition inline-flex items-center justify-center">
                        <i class="fab fa-whatsapp mr-2 text-xl"></i>
                        Chat WhatsApp
                    </a>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl p-8 shadow-lg">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Aksi Cepat</h3>
                <div class="space-y-4">
                    <a href="{{ route('booking.create') }}" class="block w-full bg-purple-600 text-white py-4 rounded-lg font-bold hover:bg-purple-700 transition text-center">
                        <i class="fas fa-calendar-plus mr-2"></i>
                        Booking Service
                    </a>
                    <a href="{{ route('tracking.index') }}" class="block w-full bg-blue-600 text-white py-4 rounded-lg font-bold hover:bg-blue-700 transition text-center">
                        <i class="fas fa-search mr-2"></i>
                        Cek Status Service
                    </a>
                    <a href="{{ route('sparepart.index') }}" class="block w-full bg-green-600 text-white py-4 rounded-lg font-bold hover:bg-green-700 transition text-center">
                        <i class="fas fa-microchip mr-2"></i>
                        Lihat Sparepart
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection