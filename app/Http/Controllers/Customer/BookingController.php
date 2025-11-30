<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Models\ServiceStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    // Form booking
    public function create()
    {
        return view('customer.pages.booking.create');
    }

    // Simpan booking
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required|string|max:20',
            'phone_type' => 'required|string|max:100',
            'complaint' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'estimated_arrival_date' => 'nullable|date|after_or_equal:today',
        ], [
            'customer_name.required' => 'Nama wajib diisi',
            'customer_phone.required' => 'Nomor HP wajib diisi',
            'phone_type.required' => 'Tipe HP wajib diisi',
            'complaint.required' => 'Keluhan wajib diisi',
            'photo.image' => 'File harus berupa gambar',
            'photo.max' => 'Ukuran foto maksimal 2MB',
            'estimated_arrival_date.after_or_equal' => 'Tanggal tidak boleh kurang dari hari ini',
        ]);

        try {
            DB::beginTransaction();

            // Generate booking code
            $bookingCode = Booking::generateBookingCode();

            // Upload foto jika ada
            $photoName = null;
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $photoName = $bookingCode . '_' . time() . '.' . $photo->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('bookings', $photo, $photoName);
            }

            // Simpan booking
            $booking = Booking::create([
                'booking_code' => $bookingCode,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'phone_type' => $request->phone_type,
                'complaint' => $request->complaint,
                'photo' => $photoName,
                'estimated_arrival_date' => $request->estimated_arrival_date,
                'status' => 'Menunggu Konfirmasi',
            ]);

            // Buat record service
            $service = Service::create([
                'booking_id' => $booking->id,
                'status' => 'Menunggu Konfirmasi',
            ]);

            // Buat history status awal
            ServiceStatusHistory::create([
                'service_id' => $service->id,
                'status' => 'Menunggu Konfirmasi',
                'note' => 'Booking baru diterima',
            ]);

            DB::commit();

            return redirect()->route('booking.success', $bookingCode);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    // Halaman sukses booking
    public function success($bookingCode)
    {
        $booking = Booking::where('booking_code', $bookingCode)->firstOrFail();

        return view('customer.pages.booking.success', compact('booking'));
    }
}