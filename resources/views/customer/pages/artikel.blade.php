<!-- resources/views/customer/pages/artikel.blade.php -->
@extends('customer.layouts.app')

@section('title', 'Artikel & Tips - Elfafa Service')
@section('description', 'Baca artikel, tips, dan panduan seputar perawatan HP, troubleshooting, dan teknologi terkini.')

@section('content')
<!-- Hero Section -->
<section class="gradient-bg text-white pt-32 pb-16 px-4">
    <div class="container mx-auto text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Artikel & Tips</h1>
        <p class="text-xl text-gray-100 max-w-3xl mx-auto">
            Panduan lengkap perawatan HP, tips troubleshooting, dan berita teknologi terkini
        </p>

        <!-- Search Bar -->
        <div class="max-w-2xl mx-auto mt-8">
            <div class="relative">
                <input type="text"
                    placeholder="Cari artikel..."
                    class="w-full px-6 py-4 rounded-full text-gray-800 focus:outline-none focus:ring-4 focus:ring-purple-300">
                <button class="absolute right-2 top-2 bg-purple-600 text-white px-6 py-2 rounded-full hover:bg-purple-700 transition">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Categories -->
<section class="py-8 px-4 bg-white border-b">
    <div class="container mx-auto">
        <div class="flex flex-wrap justify-center gap-3">
            <button class="px-6 py-2 bg-purple-600 text-white rounded-full font-semibold hover:bg-purple-700 transition">
                Semua Artikel
            </button>
            <button class="px-6 py-2 bg-gray-100 text-gray-700 rounded-full font-semibold hover:bg-gray-200 transition">
                Tips Perawatan
            </button>
            <button class="px-6 py-2 bg-gray-100 text-gray-700 rounded-full font-semibold hover:bg-gray-200 transition">
                Troubleshooting
            </button>
            <button class="px-6 py-2 bg-gray-100 text-gray-700 rounded-full font-semibold hover:bg-gray-200 transition">
                Berita Teknologi
            </button>
            <button class="px-6 py-2 bg-gray-100 text-gray-700 rounded-full font-semibold hover:bg-gray-200 transition">
                Review Gadget
            </button>
        </div>
    </div>
</section>

<!-- Featured Article -->
<section class="py-12 px-4 bg-gray-50">
    <div class="container mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition">
            <div class="grid lg:grid-cols-2">
                <div class="relative h-64 lg:h-auto">
                    <img src="https://images.unsplash.com/photo-1556656793-08538906a9f8?w=800&h=600&fit=crop"
                        alt="Featured Article"
                        class="w-full h-full object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="bg-purple-600 text-white px-4 py-2 rounded-full text-sm font-semibold">
                            <i class="fas fa-star mr-2"></i>Featured
                        </span>
                    </div>
                </div>
                <div class="p-8 lg:p-12">
                    <div class="flex items-center gap-4 mb-4 text-sm text-gray-500">
                        <span><i class="far fa-calendar mr-2"></i>21 November 2025</span>
                        <span><i class="far fa-clock mr-2"></i>5 menit baca</span>
                        <span class="bg-purple-100 text-purple-600 px-3 py-1 rounded-full font-semibold">Tips</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-4 hover:text-purple-600 transition">
                        5 Cara Ampuh Memperpanjang Umur Baterai HP Android
                    </h2>
                    <p class="text-gray-600 text-lg mb-6">
                        Baterai HP cepat habis? Ikuti 5 tips mudah ini untuk membuat baterai HP Anda lebih awet dan tahan lama. Hemat daya tanpa mengurangi kenyamanan pemakaian.
                    </p>
                    <a href="#" class="inline-flex items-center text-purple-600 font-semibold hover:text-purple-700 text-lg">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest Articles -->
<section class="py-20 px-4 bg-white">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-12">Artikel Terbaru</h2>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Article Card 1 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition card-hover">
                <div class="relative h-48">
                    <img src="https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=600&h=400&fit=crop"
                        alt="Article"
                        class="w-full h-full object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            Troubleshooting
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-3 text-sm text-gray-500">
                        <span><i class="far fa-calendar mr-1"></i>20 Nov 2025</span>
                        <span><i class="far fa-clock mr-1"></i>4 menit</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-purple-600 transition">
                        HP Kena Air? Ini yang Harus Dilakukan dalam 5 Menit Pertama
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Langkah-langkah darurat yang harus segera dilakukan saat HP terkena air untuk mencegah kerusakan permanen.
                    </p>
                    <a href="#" class="text-purple-600 font-semibold inline-flex items-center hover:text-purple-700">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                </div>
            </article>

            <!-- Article Card 2 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition card-hover">
                <div class="relative h-48">
                    <img src="https://images.unsplash.com/photo-1591337676887-a217a6970a8a?w=600&h=400&fit=crop"
                        alt="Article"
                        class="w-full h-full object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="bg-green-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            Tips Perawatan
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-3 text-sm text-gray-500">
                        <span><i class="far fa-calendar mr-1"></i>18 Nov 2025</span>
                        <span><i class="far fa-clock mr-1"></i>6 menit</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-purple-600 transition">
                        Cara Membedakan LCD HP Original vs KW: Panduan Lengkap
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Jangan tertipu! Kenali ciri-ciri LCD original dan KW agar tidak salah beli saat mengganti layar HP Anda.
                    </p>
                    <a href="#" class="text-purple-600 font-semibold inline-flex items-center hover:text-purple-700">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                </div>
            </article>

            <!-- Article Card 3 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition card-hover">
                <div class="relative h-48">
                    <img src="https://images.unsplash.com/photo-1609921212029-bb5a28e60960?w=600&h=400&fit=crop"
                        alt="Article"
                        class="w-full h-full object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="bg-red-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            Berita
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-3 text-sm text-gray-500">
                        <span><i class="far fa-calendar mr-1"></i>15 Nov 2025</span>
                        <span><i class="far fa-clock mr-1"></i>3 menit</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-purple-600 transition">
                        10 Tanda HP Anda Butuh Service Segera
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Jangan tunggu sampai rusak total! Kenali tanda-tanda awal HP yang memerlukan perhatian khusus.
                    </p>
                    <a href="#" class="text-purple-600 font-semibold inline-flex items-center hover:text-purple-700">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                </div>
            </article>

            <!-- Article Card 4 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition card-hover">
                <div class="relative h-48">
                    <img src="https://images.unsplash.com/photo-1556656793-08538906a9f8?w=600&h=400&fit=crop"
                        alt="Article"
                        class="w-full h-full object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="bg-purple-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            Review
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-3 text-sm text-gray-500">
                        <span><i class="far fa-calendar mr-1"></i>12 Nov 2025</span>
                        <span><i class="far fa-clock mr-1"></i>7 menit</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-purple-600 transition">
                        Rekomendasi HP Terbaik 2025 di Bawah 3 Juta
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Cari HP baru dengan budget terbatas? Ini dia pilihan terbaik dengan spesifikasi gahar dan harga terjangkau.
                    </p>
                    <a href="#" class="text-purple-600 font-semibold inline-flex items-center hover:text-purple-700">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                </div>
            </article>

            <!-- Article Card 5 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition card-hover">
                <div class="relative h-48">
                    <img src="https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=600&h=400&fit=crop"
                        alt="Article"
                        class="w-full h-full object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="bg-green-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            Tips Perawatan
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-3 text-sm text-gray-500">
                        <span><i class="far fa-calendar mr-1"></i>10 Nov 2025</span>
                        <span><i class="far fa-clock mr-1"></i>5 menit</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-purple-600 transition">
                        Cara Benar Membersihkan Layar HP Tanpa Merusaknya
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Layar HP kotor dan berminyak? Pelajari cara membersihkan yang aman dan efektif tanpa merusak coating.
                    </p>
                    <a href="#" class="text-purple-600 font-semibold inline-flex items-center hover:text-purple-700">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                </div>
            </article>

            <!-- Article Card 6 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition card-hover">
                <div class="relative h-48">
                    <img src="https://images.unsplash.com/photo-1591337676887-a217a6970a8a?w=600&h=400&fit=crop"
                        alt="Article"
                        class="w-full h-full object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            Troubleshooting
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-3 text-sm text-gray-500">
                        <span><i class="far fa-calendar mr-1"></i>8 Nov 2025</span>
                        <span><i class="far fa-clock mr-1"></i>6 menit</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-purple-600 transition">
                        HP Lemot dan Hang? Ini Penyebab dan Solusinya
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Atasi masalah HP lemot dengan cara sederhana tanpa perlu install ulang. Dijamin langsung ngebut!
                    </p>
                    <a href="#" class="text-purple-600 font-semibold inline-flex items-center hover:text-purple-700">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                </div>
            </article>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-12 gap-2">
            <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-lg hover:bg-gray-300 transition">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="px-4 py-2 bg-purple-600 text-white rounded-lg font-semibold">1</button>
            <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-lg hover:bg-gray-300 transition">2</button>
            <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-lg hover:bg-gray-300 transition">3</button>
            <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-lg hover:bg-gray-300 transition">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<!-- Popular Topics -->
<section class="py-16 px-4 bg-gray-50">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Topik Populer</h2>
        <div class="flex flex-wrap justify-center gap-3">
            <a href="#" class="px-6 py-3 bg-white text-gray-700 rounded-full font-semibold hover:bg-purple-600 hover:text-white transition shadow-md">
                #BateraiAwet
            </a>
            <a href="#" class="px-6 py-3 bg-white text-gray-700 rounded-full font-semibold hover:bg-purple-600 hover:text-white transition shadow-md">
                #LCDOriginal
            </a>
            <a href="#" class="px-6 py-3 bg-white text-gray-700 rounded-full font-semibold hover:bg-purple-600 hover:text-white transition shadow-md">
                #HPKenaAir
            </a>
            <a href="#" class="px-6 py-3 bg-white text-gray-700 rounded-full font-semibold hover:bg-purple-600 hover:text-white transition shadow-md">
                #TipsAndroid
            </a>
            <a href="#" class="px-6 py-3 bg-white text-gray-700 rounded-full font-semibold hover:bg-purple-600 hover:text-white transition shadow-md">
                #PerawatanHP
            </a>
            <a href="#" class="px-6 py-3 bg-white text-gray-700 rounded-full font-semibold hover:bg-purple-600 hover:text-white transition shadow-md">
                #ServiceHP
            </a>
            <a href="#" class="px-6 py-3 bg-white text-gray-700 rounded-full font-semibold hover:bg-purple-600 hover:text-white transition shadow-md">
                #ReviewGadget
            </a>
        </div>
    </div>
</section>
@endsection