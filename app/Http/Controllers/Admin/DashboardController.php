<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Sparepart;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik booking
        $totalBooking = Booking::count();
        $bookingBaru = Booking::where('status', 'Menunggu Konfirmasi')->count();
        $bookingHariIni = Booking::whereDate('created_at', today())->count();

        // Statistik service
        $serviceDalamProses = Service::whereNotIn('status', ['Diambil Pelanggan', 'Ditolak'])->count();
        $serviceSelesai = Service::where('status', 'Diambil Pelanggan')->count();
        $serviceSelesaiBulanIni = Service::where('status', 'Diambil Pelanggan')
            ->whereMonth('completed_at', now()->month)
            ->whereYear('completed_at', now()->year)
            ->count();

        // Pendapatan bulan ini
        $pendapatanBulanIni = Service::where('status', 'Diambil Pelanggan')
            ->whereMonth('completed_at', now()->month)
            ->whereYear('completed_at', now()->year)
            ->sum('final_cost');

        // Sparepart alert
        $sparepartHabis = Sparepart::active()->where('stock', '<=', 0)->count();
        $sparepartMenipis = Sparepart::active()->where('stock', '>', 0)->where('stock', '<', 5)->count();

        // Booking terbaru (5 terakhir)
        $bookingTerbaru = Booking::with('service')
            ->latest()
            ->take(5)
            ->get();

        // Service dalam proses (5 terakhir)
        $serviceTerbaru = Service::with('booking')
            ->whereNotIn('status', ['Diambil Pelanggan', 'Ditolak'])
            ->latest()
            ->take(5)
            ->get();

        // Sparepart stok menipis
        $sparepartAlert = Sparepart::active()
            ->where('stock', '<', 5)
            ->orderBy('stock')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBooking',
            'bookingBaru',
            'bookingHariIni',
            'serviceDalamProses',
            'serviceSelesai',
            'serviceSelesaiBulanIni',
            'pendapatanBulanIni',
            'sparepartHabis',
            'sparepartMenipis',
            'bookingTerbaru',
            'serviceTerbaru',
            'sparepartAlert'
        ));
    }
}