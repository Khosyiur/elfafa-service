<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\ServiceStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    // Daftar booking
    public function index(Request $request)
    {
        $query = Booking::with('service');

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('booking_code', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%")
                  ->orWhere('phone_type', 'like', "%{$search}%");
            });
        }

        $bookings = $query->latest()->paginate(10);

        return view('admin.booking.index', compact('bookings'));
    }

    // Detail booking
    public function show($id)
    {
        $booking = Booking::with(['service.statusHistories', 'service.spareparts'])
            ->findOrFail($id);

        return view('admin.booking.show', compact('booking'));
    }

    // Konfirmasi booking
    public function confirm($id)
    {
        try {
            DB::beginTransaction();

            $booking = Booking::with('service')->findOrFail($id);

            // Update status booking
            $booking->update(['status' => 'HP Diterima']);

            // Update status service
            $booking->service->update(['status' => 'HP Diterima']);

            // Tambah history
            ServiceStatusHistory::create([
                'service_id' => $booking->service->id,
                'status' => 'HP Diterima',
                'note' => 'Booking dikonfirmasi, HP sudah diterima di toko',
            ]);

            DB::commit();

            return back()->with('success', 'Booking berhasil dikonfirmasi.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    // Tolak booking
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reject_reason' => 'required|string|max:255',
        ], [
            'reject_reason.required' => 'Alasan penolakan wajib diisi',
        ]);

        try {
            DB::beginTransaction();

            $booking = Booking::with('service')->findOrFail($id);

            // Update status booking
            $booking->update(['status' => 'Ditolak']);

            // Update status service
            $booking->service->update(['status' => 'Ditolak']);

            // Tambah history
            ServiceStatusHistory::create([
                'service_id' => $booking->service->id,
                'status' => 'Ditolak',
                'note' => 'Booking ditolak: ' . $request->reject_reason,
            ]);

            DB::commit();

            return back()->with('success', 'Booking telah ditolak.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }
}