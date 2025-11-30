<footer class="bg-gray-900 text-white py-12 px-4">
    <div class="container mx-auto">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <i class=" text-2xl text-purple-400"></i>
                    <span class="text-xl font-bold">Elfafa Service</span>
                </div>
                <p class="text-gray-400 mb-4">Solusi terpercaya untuk servis HP Anda dengan teknisi profesional dan garansi resmi.</p>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            <div>
                <h4 class="font-bold text-lg mb-4">Layanan</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="{{ route('layanan') }}#hardware" class="hover:text-white transition">Perbaikan Hardware</a></li>
                    <li><a href="{{ route('layanan') }}#software" class="hover:text-white transition">Perbaikan Software</a></li>
                    <li><a href="{{ route('layanan') }}#sparepart" class="hover:text-white transition">Ganti Sparepart</a></li>
                    <li><a href="{{ route('layanan') }}#perawatan" class="hover:text-white transition">Perawatan HP</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-lg mb-4">Informasi</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="{{ route('beranda') }}#tentang" class="hover:text-white transition">Tentang Kami</a></li>
                    <li><a href="{{ route('sparepart.index') }}" class="hover:text-white transition">Cek Sparepart</a></li>
                    <li><a href="{{ route('tracking.index') }}" class="hover:text-white transition">Cek Status Service</a></li>
                    <li><a href="{{ route('artikel') }}" class="hover:text-white transition">Artikel & Tips</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-lg mb-4">Hubungi Kami</h4>
                <ul class="space-y-3 text-gray-400">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt mt-1 mr-3 text-purple-400"></i>
                        <span>Jl. Raya Contoh No. 123, Surabaya</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone mt-1 mr-3 text-purple-400"></i>
                        <span>0856-3051-551</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope mt-1 mr-3 text-purple-400"></i>
                        <span>info@elfafaservice.com</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-clock mt-1 mr-3 text-purple-400"></i>
                        <span>Senin - Sabtu<br>09:00 - 18:00 WIB</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} Elfafa Service. All rights reserved. Made with <i class="fas fa-heart text-red-500"></i> in Indonesia</p>
        </div>
    </div>
</footer>