<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    // Form tracking
    public function index()
    {
        return view('customer.pages.tracking.index');
    }

    // Cari booking
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|string',
        ], [
            'search.required' => 'Masukkan ID Booking atau Nomor HP',
        ]);

        $search = $request->search;

        // Cari berdasarkan booking code atau nomor HP
        $booking = Booking::where('booking_code', $search)
            ->orWhere('customer_phone', $search)
            ->first();

        if (!$booking) {
            return back()
                ->withInput()
                ->with('error', 'Data tidak ditemukan. Periksa kembali ID Booking atau Nomor HP Anda.');
        }

        return redirect()->route('tracking.show', $booking->booking_code);
    }

    // Detail tracking
    public function show($bookingCode)
    {
        $booking = Booking::where('booking_code', $bookingCode)
            ->with(['service.statusHistories', 'service.spareparts'])
            ->firstOrFail();

        return view('customer.pages.tracking.show', compact('booking'));
    }
}