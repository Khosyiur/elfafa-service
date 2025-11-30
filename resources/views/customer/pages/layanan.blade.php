<!-- resources/views/customer/pages/layanan.blade.php -->
@extends('customer.layouts.app')

@section('title', 'Layanan Kami - Elfafa Service')
@section('description', 'Berbagai layanan servis HP profesional: Perbaikan Hardware, Software, Ganti Sparepart, dan Perawatan HP dengan garansi resmi.')

@section('content')
<!-- Hero Section -->
<section class="gradient-bg text-white pt-32 pb-16 px-4">
    <div class="container mx-auto text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Layanan Kami</h1>
        <p class="text-xl text-gray-100 max-w-3xl mx-auto">
            Kami menyediakan berbagai layanan servis HP profesional dengan teknisi berpengalaman dan garansi resmi
        </p>
    </div>
</section>

<!-- Perbaikan Hardware -->
<section id="hardware" class="py-20 px-4 bg-white">
    <div class="container mx-auto">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1">
                <div class="inline-block bg-purple-100 text-purple-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    <i class="fas fa-wrench mr-2"></i>HARDWARE
                </div>
                <h2 class="text-4xl font-bold text-gray-800 mb-6">Perbaikan Hardware</h2>
                <p class="text-gray-600 text-lg mb-6">
                    Servis komponen fisik HP Anda dengan teknisi profesional dan sparepart berkualitas original atau OEM pilihan.
                </p>

                <div class="space-y-4 mb-8">
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 text-xl mr-3 mt-1"></i>
                        <div>
                            <h4 class="font-bold text-gray-800">Ganti LCD / Touchscreen</h4>
                            <p class="text-gray-600">Layar pecah, bergaris, atau touchscreen tidak responsif</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 text-xl mr-3 mt-1"></i>
                        <div>
                            <h4 class="font-bold text-gray-800">Ganti Baterai</h4>
                            <p class="text-gray-600">Baterai boros, cepat habis, atau tidak bisa cas</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 text-xl mr-3 mt-1"></i>
                        <div>
                            <h4 class="font-bold text-gray-800">Perbaikan Kamera</h4>
                            <p class="text-gray-600">Kamera depan/belakang buram, tidak fokus, atau mati</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 text-xl mr-3 mt-1"></i>
                        <div>
                            <h4 class="font-bold text-gray-800">Perbaikan Port Charging</h4>
                            <p class="text-gray-600">Charger tidak masuk, cas lambat, atau konektor rusak</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 text-xl mr-3 mt-1"></i>
                        <div>
                            <h4 class="font-bold text-gray-800">Servis HP Kena Air</h4>
                            <p class="text-gray-600">HP basah, tidak bisa hidup akibat air atau cairan</p>
                        </div>
                    </div>
                </div>

                <div class="bg-purple-50 rounded-xl p-6 mb-6">
                    <div class="grid md:grid-cols-3 gap-4 text-center">
                        <div>
                            <div class="text-3xl font-bold text-purple-600 mb-2">1-3 Hari</div>
                            <div class="text-gray-600 text-sm">Estimasi Pengerjaan</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-purple-600 mb-2">30 Hari</div>
                            <div class="text-gray-600 text-sm">Garansi Servis</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-purple-600 mb-2">Gratis</div>
                            <div class="text-gray-600 text-sm">Konsultasi & Cek</div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('booking.create') }}" class="btn-primary text-white px-8 py-4 rounded-lg font-bold inline-flex items-center hover:shadow-lg transition">
                    <i class="fas fa-calendar-check mr-2"></i>
                    Booking Servis Hardware
                </a>
            </div>

            <div class="order-1 lg:order-2">
                <img src="https://images.unsplash.com/photo-1591337676887-a217a6970a8a?w=800&h=600&fit=crop"
                    alt="Hardware Repair"
                    class="rounded-2xl shadow-2xl w-full">
            </div>
        </div>
    </div>
</section>

<!-- Perbaikan Software -->
<section id="software" class="py-20 px-4 bg-gray-50">
    <div class="container mx-auto">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <img src="https://images.unsplash.com/photo-1556656793-08538906a9f8?w=800&h=600&fit=crop"
                    alt="Software Repair"
                    class="rounded-2xl shadow-2xl w-full">
            </div>

            <div>
                <div class="inline-block bg-blue-100 text-blue-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    <i class="fas fa-code mr-2"></i>SOFTWARE
                </div>
                <h2 class="text-4xl font-bold text-gray-800 mb-6">Perbaikan Software</h2>
                <p class="text-gray-600 text-lg mb-6">
                    Solusi masalah software HP Android dan iOS dengan metode aman tanpa menghilangkan data penting Anda.
                </p>

                <div class="space-y-4 mb-8">
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 text-xl mr-3 mt-1"></i>
                        <div>
                            <h4 class="font-bold text-gray-800">Install Ulang / Flash</h4>
                            <p class="text-gray-600">Sistem error, bootloop, atau hang berkala</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 text-xl mr-3 mt-1"></i>
                        <div>
                            <h4 class="font-bold text-gray-800">Update Software</h4>
                            <p class="text-gray-600">Update ke versi terbaru untuk performa optimal</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 text-xl mr-3 mt-1"></i>
                        <div>
                            <h4 class="font-bold text-gray-800">Hapus Virus & Malware</h4>
                            <p class="text-gray-600">Bersihkan HP dari virus, iklan, dan aplikasi jahat</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 text-xl mr-3 mt-1"></i>
                        <div>
                            <h4 class="font-bold text-gray-800">Optimasi Performa</h4>
                            <p class="text-gray-600">HP lemot, RAM penuh, storage hampir habis</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 text-xl mr-3 mt-1"></i>
                        <div>
                            <h4 class="font-bold text-gray-800">Unlock / Bypass</h4>
                            <p class="text-gray-600">Lupa pola, PIN, password, atau akun Google</p>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 rounded-xl p-6 mb-6">
                    <div class="grid md:grid-cols-3 gap-4 text-center">
                        <div>
                            <div class="text-3xl font-bold text-blue-600 mb-2">2-4 Jam</div>
                            <div class="text-gray-600 text-sm">Estimasi Pengerjaan</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-blue-600 mb-2">14 Hari</div>
                            <div class="text-gray-600 text-sm">Garansi Servis</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-blue-600 mb-2">Aman</div>
                            <div class="text-gray-600 text-sm">Data Terjaga</div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('booking.create') }}" class="bg-blue-600 text-white px-8 py-4 rounded-lg font-bold inline-flex items-center hover:bg-blue-700 hover:shadow-lg transition">
                    <i class="fas fa-calendar-check mr-2"></i>
                    Booking Servis Software
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Ganti Sparepart -->
<section id="sparepart" class="py-20 px-4 bg-white">
    <div class="container mx-auto">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1">
                <div class="inline-block bg-green-100 text-green-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    <i class="fas fa-microchip mr-2"></i>SPAREPART
                </div>
                <h2 class="text-4xl font-bold text-gray-800 mb-6">Ganti Sparepart Original</h2>
                <p class="text-gray-600 text-lg mb-6">
                    Tersedia sparepart original dan OEM berkualitas untuk berbagai merk HP dengan harga bersaing dan garansi resmi.
                </p>

                <div class="grid md:grid-cols-2 gap-4 mb-8">
                    <div class="bg-white border-2 border-gray-200 rounded-xl p-4 hover:border-green-500 transition">
                        <i class="fas fa-tv text-3xl text-green-600 mb-3"></i>
                        <h4 class="font-bold text-gray-800 mb-2">LCD & Touchscreen</h4>
                        <p class="text-gray-600 text-sm">Original & OEM</p>
                    </div>
                    <div class="bg-white border-2 border-gray-200 rounded-xl p-4 hover:border-green-500 transition">
                        <i class="fas fa-battery-full text-3xl text-green-600 mb-3"></i>
                        <h4 class="font-bold text-gray-800 mb-2">Baterai</h4>
                        <p class="text-gray-600 text-sm">Kapasitas Original</p>
                    </div>
                    <div class="bg-white border-2 border-gray-200 rounded-xl p-4 hover:border-green-500 transition">
                        <i class="fas fa-camera text-3xl text-green-600 mb-3"></i>
                        <h4 class="font-bold text-gray-800 mb-2">Kamera</h4>
                        <p class="text-gray-600 text-sm">Depan & Belakang</p>
                    </div>
                    <div class="bg-white border-2 border-gray-200 rounded-xl p-4 hover:border-green-500 transition">
                        <i class="fas fa-volume-up text-3xl text-green-600 mb-3"></i>
                        <h4 class="font-bold text-gray-800 mb-2">Speaker & Mic</h4>
                        <p class="text-gray-600 text-sm">Suara Jernih</p>
                    </div>
                </div>

                <div class="bg-green-50 rounded-xl p-6 mb-6">
                    <h4 class="font-bold text-gray-800 mb-4">Merk HP yang Kami Layani:</h4>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <div class="text-center py-2 bg-white rounded-lg font-semibold text-gray-700">Samsung</div>
                        <div class="text-center py-2 bg-white rounded-lg font-semibold text-gray-700">iPhone</div>
                        <div class="text-center py-2 bg-white rounded-lg font-semibold text-gray-700">Oppo</div>
                        <div class="text-center py-2 bg-white rounded-lg font-semibold text-gray-700">Vivo</div>
                        <div class="text-center py-2 bg-white rounded-lg font-semibold text-gray-700">Xiaomi</div>
                        <div class="text-center py-2 bg-white rounded-lg font-semibold text-gray-700">Realme</div>
                        <div class="text-center py-2 bg-white rounded-lg font-semibold text-gray-700">Infinix</div>
                        <div class="text-center py-2 bg-white rounded-lg font-semibold text-gray-700">Lainnya</div>
                    </div>
                </div>

                <div class="flex gap-4">
                    <a href="{{ route('sparepart.index') }}" class="bg-green-600 text-white px-8 py-4 rounded-lg font-bold inline-flex items-center hover:bg-green-700 hover:shadow-lg transition">
                        <i class="fas fa-box mr-2"></i>
                        Lihat Stok Sparepart
                    </a>
                    <a href="{{ route('booking.create') }}" class="border-2 border-green-600 text-green-600 px-8 py-4 rounded-lg font-bold inline-flex items-center hover:bg-green-50 transition">
                        <i class="fas fa-calendar-check mr-2"></i>
                        Booking
                    </a>
                </div>
            </div>

            <div class="order-1 lg:order-2">
                <img src="https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=800&h=600&fit=crop"
                    alt="Sparepart"
                    class="rounded-2xl shadow-2xl w-full">
            </div>
        </div>
    </div>
</section>

<!-- Perawatan & Pembersihan -->
<section id="perawatan" class="py-20 px-4 bg-gray-50">
    <div class="container mx-auto">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <img src="https://images.unsplash.com/photo-1609921212029-bb5a28e60960?w=800&h=600&fit=crop"
                    alt="Maintenance"
                    class="rounded-2xl shadow-2xl w-full">
            </div>

            <div>
                <div class="inline-block bg-red-100 text-red-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    <i class="fas fa-shield-alt mr-2"></i>MAINTENANCE
                </div>
                <h2 class="text-4xl font-bold text-gray-800 mb-6">Perawatan & Pembersihan</h2>
                <p class="text-gray-600 text-lg mb-6">
                    Jaga HP Anda tetap optimal dengan layanan perawatan dan pembersihan berkala menggunakan peralatan profesional.
                </p>

                <div class="space-y-4 mb-8">
                    <div class="bg-white rounded-xl p-5 border-l-4 border-red-500">
                        <h4 class="font-bold text-gray-800 mb-2">
                            <i class="fas fa-broom text-red-600 mr-2"></i>
                            Pembersihan Menyeluruh
                        </h4>
                        <p class="text-gray-600">Bersihkan debu, kotoran, dan minyak dari luar dan dalam HP</p>
                    </div>
                    <div class="bg-white rounded-xl p-5 border-l-4 border-red-500">
                        <h4 class="font-bold text-gray-800 mb-2">
                            <i class="fas fa-tint text-red-600 mr-2"></i>
                            Coating Anti Air
                        </h4>
                        <p class="text-gray-600">Lapisan pelindung tambahan untuk mencegah kerusakan air</p>
                    </div>
                    <div class="bg-white rounded-xl p-5 border-l-4 border-red-500">
                        <h4 class="font-bold text-gray-800 mb-2">
                            <i class="fas fa-thermometer-half text-red-600 mr-2"></i>
                            Cek Suhu & Performa
                        </h4>
                        <p class="text-gray-600">Analisa kesehatan baterai dan suhu HP</p>
                    </div>
                    <div class="bg-white rounded-xl p-5 border-l-4 border-red-500">
                        <h4 class="font-bold text-gray-800 mb-2">
                            <i class="fas fa-paste text-red-600 mr-2"></i>
                            Ganti Thermal Paste
                        </h4>
                        <p class="text-gray-600">Untuk HP yang sering panas/overheat</p>
                    </div>
                </div>

                <div class="bg-red-50 rounded-xl p-6 mb-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-3xl font-bold text-red-600 mb-2">Rp 50.000</div>
                            <div class="text-gray-600">Paket Pembersihan Dasar</div>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold text-red-600 mb-2">Rp 100.000</div>
                            <div class="text-gray-600">Paket Premium</div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('booking.create') }}" class="bg-red-600 text-white px-8 py-4 rounded-lg font-bold inline-flex items-center hover:bg-red-700 hover:shadow-lg transition">
                    <i class="fas fa-calendar-check mr-2"></i>
                    Booking Perawatan
                </a>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="gradient-bg text-white py-16 px-4">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl md:text-5xl font-bold mb-6">HP Anda Bermasalah?</h2>
        <p class="text-xl mb-8 text-gray-100 max-w-2xl mx-auto">
            Konsultasi gratis dengan teknisi kami. Dapatkan solusi terbaik untuk masalah HP Anda!
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="https://wa.me/6281234567890?text=Halo%20Elfafa%20Service,%20saya%20mau%20konsultasi"
                target="_blank"
                class="bg-green-500 text-white px-8 py-4 rounded-lg font-bold hover:bg-green-600 transition inline-flex items-center shadow-xl">
                <i class="fab fa-whatsapp mr-2 text-2xl"></i>
                Konsultasi Gratis
            </a>
            <a href="form_booking"
                class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-lg font-bold hover:bg-yellow-300 transition inline-flex items-center shadow-xl">
                <i class="fas fa-calendar-plus mr-2"></i>
                Booking Sekarang
            </a>
        </div>
    </div>
</section>
@endsection