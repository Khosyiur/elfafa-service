<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Booking;
use App\Models\Sparepart;
use App\Models\ServiceStatusHistory;
use App\Models\SparepartStockHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    // Daftar service
    public function index(Request $request)
    {
        $query = Service::with('booking');

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('booking', function ($q) use ($search) {
                $q->where('booking_code', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%");
            });
        }

        $services = $query->latest()->paginate(10);
        $statusList = Service::getStatusList();

        return view('admin.service.index', compact('services', 'statusList'));
    }

    // Detail service
    public function show($id)
    {
        $service = Service::with(['booking', 'statusHistories', 'spareparts', 'technician'])
            ->findOrFail($id);
        
        $spareparts = Sparepart::active()->where('stock', '>', 0)->get();
        $statusList = Service::getStatusList();

        return view('admin.service.show', compact('service', 'spareparts', 'statusList'));
    }

    // Form edit service
    public function edit($id)
    {
        $service = Service::with(['booking', 'spareparts'])->findOrFail($id);
        $spareparts = Sparepart::active()->get();
        $statusList = Service::getStatusList();

        return view('admin.service.edit', compact('service', 'spareparts', 'statusList'));
    }

    // Update service
    public function update(Request $request, $id)
    {
        $request->validate([
            'estimated_cost' => 'nullable|numeric|min:0',
            'final_cost' => 'nullable|numeric|min:0',
        ]);

        $service = Service::findOrFail($id);

        $service->update([
            'estimated_cost' => $request->estimated_cost,
            'final_cost' => $request->final_cost,
            'technician_id' => session('admin_id'),
        ]);

        return back()->with('success', 'Data service berhasil diupdate.');
    }

    // Update status service
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'note' => 'nullable|string|max:500',
        ]);

        try {
            DB::beginTransaction();

            $service = Service::with('booking')->findOrFail($id);
            $newStatus = $request->status;

            // Update status service
            $service->update([
                'status' => $newStatus,
                'technician_id' => session('admin_id'),
                'completed_at' => in_array($newStatus, ['Selesai & Siap Diambil', 'Diambil Pelanggan']) ? now() : $service->completed_at,
            ]);

            // Update status booking
            $service->booking->update(['status' => $newStatus]);

            // Tambah history
            ServiceStatusHistory::create([
                'service_id' => $service->id,
                'status' => $newStatus,
                'note' => $request->note ?? 'Status diubah menjadi: ' . $newStatus,
            ]);

            DB::commit();

            return back()->with('success', 'Status berhasil diupdate.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    // Tambah sparepart ke service
    public function addSparepart(Request $request, $id)
    {
        $request->validate([
            'sparepart_id' => 'required|exists:spareparts,id',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            $service = Service::findOrFail($id);
            $sparepart = Sparepart::findOrFail($request->sparepart_id);

            // Cek stok
            if ($sparepart->stock < $request->quantity) {
                return back()->with('error', 'Stok tidak mencukupi. Stok tersedia: ' . $sparepart->stock);
            }

            // Cek apakah sudah ada di service
            $existing = $service->spareparts()->where('sparepart_id', $sparepart->id)->first();

            if ($existing) {
                // Update quantity
                $newQty = $existing->pivot->quantity + $request->quantity;
                $service->spareparts()->updateExistingPivot($sparepart->id, [
                    'quantity' => $newQty,
                ]);
            } else {
                // Attach baru
                $service->spareparts()->attach($sparepart->id, [
                    'quantity' => $request->quantity,
                    'price' => $sparepart->price,
                ]);
            }

            // Kurangi stok
            $sparepart->decrement('stock', $request->quantity);

            // Catat history stok
            SparepartStockHistory::create([
                'sparepart_id' => $sparepart->id,
                'change_type' => 'OUT',
                'quantity' => $request->quantity,
                'note' => 'Dipakai untuk service #' . $service->booking->booking_code,
            ]);

            DB::commit();

            return back()->with('success', 'Sparepart berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    // Hapus sparepart dari service
    public function removeSparepart($id, $sparepartId)
    {
        try {
            DB::beginTransaction();

            $service = Service::findOrFail($id);
            $pivot = $service->spareparts()->where('sparepart_id', $sparepartId)->first();

            if (!$pivot) {
                return back()->with('error', 'Sparepart tidak ditemukan.');
            }

            $quantity = $pivot->pivot->quantity;
            $sparepart = Sparepart::findOrFail($sparepartId);

            // Kembalikan stok
            $sparepart->increment('stock', $quantity);

            // Catat history stok
            SparepartStockHistory::create([
                'sparepart_id' => $sparepart->id,
                'change_type' => 'IN',
                'quantity' => $quantity,
                'note' => 'Dikembalikan dari service #' . $service->booking->booking_code,
            ]);

            // Detach
            $service->spareparts()->detach($sparepartId);

            DB::commit();

            return back()->with('success', 'Sparepart berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }
}