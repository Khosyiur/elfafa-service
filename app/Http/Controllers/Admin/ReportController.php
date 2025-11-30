<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Sparepart;
use App\Models\ServiceStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Default bulan ini
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);

        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = Carbon::create($year, $month, 1)->endOfMonth();

        // Statistik Service
        $totalServiceMasuk = Booking::whereBetween('created_at', [$startDate, $endDate])->count();
        
        $serviceSelesai = Service::where('status', 'Diambil Pelanggan')
            ->whereBetween('completed_at', [$startDate, $endDate])
            ->count();

        $serviceDitolak = Service::where('status', 'Ditolak')
            ->whereBetween('updated_at', [$startDate, $endDate])
            ->count();

        $serviceDalamProses = Service::whereNotIn('status', ['Diambil Pelanggan', 'Ditolak'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        // Pendapatan
        $totalPendapatan = Service::where('status', 'Diambil Pelanggan')
            ->whereBetween('completed_at', [$startDate, $endDate])
            ->sum('final_cost');

        // Rata-rata biaya service
        $rataRataBiaya = Service::where('status', 'Diambil Pelanggan')
            ->whereBetween('completed_at', [$startDate, $endDate])
            ->avg('final_cost') ?? 0;

        // Penggunaan Sparepart (dari pivot table)
        $sparepartUsage = DB::table('service_sparepart')
            ->join('spareparts', 'service_sparepart.sparepart_id', '=', 'spareparts.id')
            ->join('services', 'service_sparepart.service_id', '=', 'services.id')
            ->whereBetween('service_sparepart.created_at', [$startDate, $endDate])
            ->select(
                'spareparts.name',
                DB::raw('SUM(service_sparepart.quantity) as total_used'),
                DB::raw('SUM(service_sparepart.quantity * service_sparepart.price) as total_value')
            )
            ->groupBy('spareparts.id', 'spareparts.name')
            ->orderByDesc('total_used')
            ->limit(10)
            ->get();

        // Total nilai sparepart terpakai
        $totalSparepartValue = $sparepartUsage->sum('total_value');

        // Service per status
        $servicePerStatus = Service::whereBetween('created_at', [$startDate, $endDate])
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        // Grafik harian (service masuk)
        $dailyBookings = Booking::whereBetween('created_at', [$startDate, $endDate])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Daftar service selesai bulan ini
        $completedServices = Service::with('booking')
            ->where('status', 'Diambil Pelanggan')
            ->whereBetween('completed_at', [$startDate, $endDate])
            ->latest('completed_at')
            ->get();

        // Generate list bulan untuk dropdown
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = Carbon::create(null, $i, 1)->translatedFormat('F');
        }

        // Generate list tahun (3 tahun terakhir)
        $currentYear = now()->year;
        $years = range($currentYear - 2, $currentYear);

        return view('admin.report.index', compact(
            'month',
            'year',
            'months',
            'years',
            'totalServiceMasuk',
            'serviceSelesai',
            'serviceDitolak',
            'serviceDalamProses',
            'totalPendapatan',
            'rataRataBiaya',
            'sparepartUsage',
            'totalSparepartValue',
            'servicePerStatus',
            'dailyBookings',
            'completedServices',
            'startDate',
            'endDate'
        ));
    }

    // Export laporan (opsional - bisa dikembangkan)
    public function export(Request $request)
    {
        // Bisa ditambahkan export ke PDF/Excel
        return back()->with('info', 'Fitur export sedang dalam pengembangan.');
    }
}