@extends('admin.layouts.app')

@section('title', 'Detail Booking')
@section('header', 'Detail Booking')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.booking.index') }}" class="text-purple-600 hover:text-purple-800">
        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Booking
    </a>
</div>

<div class="grid lg:grid-cols-3 gap-6">
    <!-- Info Utama -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Booking Info -->
        <div class="bg-white rounded-xl card-shadow p-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h3 class="text-2xl font-bold text-purple-600">{{ $booking->booking_code }}</h3>
                    <p class="text-gray-500">{{ $booking->created_at->format('d M Y, H:i') }}</p>
                </div>
                <span class="px-4 py-2 rounded-full text-sm font-bold {{ $booking->status_badge }}">
                    {{ $booking->status }}
                </span>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <h4 class="font-semibold text-gray-800 mb-3">
                        <i class="fas fa-user mr-2 text-purple-600"></i>Informasi Customer
                    </h4>
                    <div class="space-y-2 text-gray-600">
                        <p><span class="text-gray-500">Nama:</span> <strong>{{ $booking->customer_name }}</strong></p>
                        <p><span class="text-gray-500">No HP:</span> <strong>{{ $booking->customer_phone }}</strong></p>
                        @if($booking->estimated_arrival_date)
                            <p><span class="text-gray-500">Rencana Datang:</span> <strong>{{ $booking->estimated_arrival_date->format('d M Y') }}</strong></p>
                        @endif
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800 mb-3">
                        <i class="fas fa-mobile-alt mr-2 text-purple-600"></i>Informasi HP
                    </h4>
                    <div class="space-y-2 text-gray-600">
                        <p><span class="text-gray-500">Tipe HP:</span> <strong>{{ $booking->phone_type }}</strong></p>
                        <p><span class="text-gray-500">Keluhan:</span></p>
                        <p class="bg-gray-50 p-3 rounded-lg">{{ $booking->complaint }}</p>
                    </div>
                </div>
            </div>

            @if($booking->photo)
                <div class="mt-6 pt-6 border-t">
                    <h4 class="font-semibold text-gray-800 mb-3">
                        <i class="fas fa-image mr-2 text-purple-600"></i>Foto Kerusakan
                    </h4>
                    <img src="{{ asset('storage/bookings/' . $booking->photo) }}" alt="Foto Kerusakan" class="max-w-md rounded-lg shadow-lg border">
                </div>
            @endif
        </div>

        <!-- Service Info -->
        @if($booking->service)
            <div class="bg-white rounded-xl card-shadow p-6">
                <h3 class="font-bold text-lg text-gray-800 mb-4">
                    <i class="fas fa-wrench mr-2 text-blue-600"></i>Informasi Service
                </h3>
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <p class="text-sm text-gray-500">Estimasi Biaya</p>
                        <p class="text-xl font-bold text-gray-800">
                            {{ $booking->service->estimated_cost ? 'Rp ' . number_format($booking->service->estimated_cost, 0, ',', '.') : '-' }}
                        </p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <p class="text-sm text-gray-500">Biaya Final</p>
                        <p class="text-xl font-bold text-green-600">
                            {{ $booking->service->final_cost ? 'Rp ' . number_format($booking->service->final_cost, 0, ',', '.') : '-' }}
                        </p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <p class="text-sm text-gray-500">Teknisi</p>
                        <p class="text-xl font-bold text-gray-800">
                            {{ $booking->service->technician->username ?? '-' }}
                        </p>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('admin.service.show', $booking->service->id) }}" class="gradient-bg text-white px-6 py-2 rounded-lg font-semibold inline-flex items-center hover:opacity-90 transition">
                        <i class="fas fa-wrench mr-2"></i>Kelola Service
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Quick Actions -->
        @if($booking->status == 'Menunggu Konfirmasi')
            <div class="bg-white rounded-xl card-shadow p-6">
                <h3 class="font-bold text-gray-800 mb-4">Aksi</h3>
                <div class="space-y-3">
                    <form action="{{ route('admin.booking.confirm', $booking->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition" onclick="return confirm('Konfirmasi booking ini?')">
                            <i class="fas fa-check mr-2"></i>Konfirmasi Booking
                        </button>
                    </form>
                    <button onclick="showRejectModal({{ $booking->id }})" class="w-full bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 transition">
                        <i class="fas fa-times mr-2"></i>Tolak Booking
                    </button>
                </div>
            </div>
        @endif

        <!-- Timeline -->
        @if($booking->service && $booking->service->statusHistories->count() > 0)
            <div class="bg-white rounded-xl card-shadow p-6">
                <h3 class="font-bold text-gray-800 mb-4">
                    <i class="fas fa-history mr-2 text-purple-600"></i>Riwayat Status
                </h3>
                <div class="space-y-4">
                    @foreach($booking->service->statusHistories->reverse()->take(5) as $history)
                        <div class="flex space-x-3">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center {{ $history->status_color }}">
                                <i class="fas {{ $history->status_icon }} text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800 text-sm">{{ $history->status }}</p>
                                <p class="text-xs text-gray-500">{{ $history->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- WhatsApp -->
        <div class="bg-white rounded-xl card-shadow p-6">
            <h3 class="font-bold text-gray-800 mb-4">Hubungi Customer</h3>
            <a href="https://wa.me/62{{ ltrim($booking->customer_phone, '0') }}?text=Halo%20{{ urlencode($booking->customer_name) }},%20terkait%20booking%20{{ $booking->booking_code }}" 
                target="_blank"
                class="w-full bg-green-500 text-white py-3 rounded-lg font-semibold hover:bg-green-600 transition inline-flex items-center justify-center">
                <i class="fab fa-whatsapp mr-2 text-xl"></i>Chat WhatsApp
            </a>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Tolak Booking</h3>
        <form action="{{ route('admin.booking.reject', $booking->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan</label>
                <textarea name="reject_reason" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="Masukkan alasan..." required></textarea>
            </div>
            <div class="flex space-x-3">
                <button type="submit" class="flex-1 bg-red-600 text-white py-2 rounded-lg font-semibold hover:bg-red-700">Tolak</button>
                <button type="button" onclick="hideRejectModal()" class="flex-1 bg-gray-200 text-gray-700 py-2 rounded-lg font-semibold hover:bg-gray-300">Batal</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function showRejectModal() {
    document.getElementById('rejectModal').classList.remove('hidden');
    document.getElementById('rejectModal').classList.add('flex');
}
function hideRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
    document.getElementById('rejectModal').classList.remove('flex');
}
</script>
@endpush
@endsection