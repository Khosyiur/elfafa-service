@extends('admin.layouts.app')

@section('title', 'Kelola Booking')
@section('header', 'Kelola Booking')

@section('content')
<!-- Filter -->
<div class="bg-white rounded-xl card-shadow p-6 mb-6">
    <form action="{{ route('admin.booking.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
        <div class="flex-1 min-w-64">
            <label class="block text-sm font-medium text-gray-700 mb-2">Cari</label>
            <input type="text" name="search" value="{{ request('search') }}" 
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500"
                placeholder="Kode booking, nama, HP, tipe...">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select name="status" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500">
                <option value="">Semua Status</option>
                <option value="Menunggu Konfirmasi" {{ request('status') == 'Menunggu Konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                <option value="HP Diterima" {{ request('status') == 'HP Diterima' ? 'selected' : '' }}>HP Diterima</option>
                <option value="Pengecekan Kerusakan" {{ request('status') == 'Pengecekan Kerusakan' ? 'selected' : '' }}>Pengecekan Kerusakan</option>
                <option value="Menunggu Persetujuan Harga" {{ request('status') == 'Menunggu Persetujuan Harga' ? 'selected' : '' }}>Menunggu Persetujuan Harga</option>
                <option value="Dalam Proses Perbaikan" {{ request('status') == 'Dalam Proses Perbaikan' ? 'selected' : '' }}>Dalam Proses Perbaikan</option>
                <option value="Selesai & Siap Diambil" {{ request('status') == 'Selesai & Siap Diambil' ? 'selected' : '' }}>Selesai & Siap Diambil</option>
                <option value="Diambil Pelanggan" {{ request('status') == 'Diambil Pelanggan' ? 'selected' : '' }}>Diambil Pelanggan</option>
                <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>
        <button type="submit" class="gradient-bg text-white px-6 py-2 rounded-lg font-semibold hover:opacity-90 transition">
            <i class="fas fa-search mr-2"></i>Filter
        </button>
        @if(request()->hasAny(['search', 'status']))
            <a href="{{ route('admin.booking.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">
                Reset
            </a>
        @endif
    </form>
</div>

<!-- Table -->
<div class="bg-white rounded-xl card-shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Kode Booking</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Customer</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Tipe HP</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($bookings as $booking)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <span class="font-mono font-semibold text-purple-600">{{ $booking->booking_code }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800">{{ $booking->customer_name }}</p>
                            <p class="text-sm text-gray-500">{{ $booking->customer_phone }}</p>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $booking->phone_type }}</td>
                        <td class="px-6 py-4 text-gray-500 text-sm">{{ $booking->created_at->format('d M Y, H:i') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $booking->status_badge }}">
                                {{ $booking->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.booking.show', $booking->id) }}" class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($booking->status == 'Menunggu Konfirmasi')
                                    <form action="{{ route('admin.booking.confirm', $booking->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="p-2 text-green-600 hover:bg-green-100 rounded-lg transition" title="Konfirmasi" onclick="return confirm('Konfirmasi booking ini?')">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <button onclick="showRejectModal({{ $booking->id }})" class="p-2 text-red-600 hover:bg-red-100 rounded-lg transition" title="Tolak">
                                        <i class="fas fa-times"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-3"></i>
                            <p>Tidak ada data booking.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($bookings->hasPages())
        <div class="px-6 py-4 border-t">
            {{ $bookings->withQueryString()->links() }}
        </div>
    @endif
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Tolak Booking</h3>
        <form id="rejectForm" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan</label>
                <textarea name="reject_reason" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500" placeholder="Masukkan alasan penolakan..." required></textarea>
            </div>
            <div class="flex space-x-3">
                <button type="submit" class="flex-1 bg-red-600 text-white py-2 rounded-lg font-semibold hover:bg-red-700 transition">
                    <i class="fas fa-times mr-2"></i>Tolak
                </button>
                <button type="button" onclick="hideRejectModal()" class="flex-1 bg-gray-200 text-gray-700 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function showRejectModal(id) {
    document.getElementById('rejectForm').action = '/admin/booking/' + id + '/reject';
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