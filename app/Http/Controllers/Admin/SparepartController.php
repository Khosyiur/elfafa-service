<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sparepart;
use App\Models\SparepartStockHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SparepartController extends Controller
{
    // Daftar sparepart
    public function index(Request $request)
    {
        $query = Sparepart::query();

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('compatible_for', 'like', "%{$search}%");
            });
        }

        // Filter status stok
        if ($request->filled('stock_status')) {
            switch ($request->stock_status) {
                case 'available':
                    $query->where('stock', '>', 4);
                    break;
                case 'low':
                    $query->where('stock', '>', 0)->where('stock', '<', 5);
                    break;
                case 'empty':
                    $query->where('stock', '<=', 0);
                    break;
            }
        }

        // Filter status aktif
        if ($request->filled('active')) {
            $query->where('active', $request->active);
        }

        $spareparts = $query->orderBy('name')->paginate(10);

        return view('admin.sparepart.index', compact('spareparts'));
    }

    // Form tambah
    public function create()
    {
        return view('admin.sparepart.create');
    }

    // Simpan sparepart
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'compatible_for' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'warranty' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'name.required' => 'Nama sparepart wajib diisi',
            'price.required' => 'Harga wajib diisi',
            'stock.required' => 'Stok wajib diisi',
        ]);

        try {
            DB::beginTransaction();

            // Upload image
            $imageName = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = 'sp_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('spareparts', $file, $imageName);
            }

            $sparepart = Sparepart::create([
                'name' => $request->name,
                'compatible_for' => $request->compatible_for,
                'price' => $request->price,
                'stock' => $request->stock,
                'warranty' => $request->warranty,
                'image' => $imageName,
                'active' => true,
            ]);

            // Catat history stok awal
            if ($request->stock > 0) {
                SparepartStockHistory::create([
                    'sparepart_id' => $sparepart->id,
                    'change_type' => 'IN',
                    'quantity' => $request->stock,
                    'note' => 'Stok awal',
                ]);
            }

            DB::commit();

            return redirect()->route('admin.sparepart.index')
                ->with('success', 'Sparepart berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    // Form edit
    public function edit($id)
    {
        $sparepart = Sparepart::findOrFail($id);

        return view('admin.sparepart.edit', compact('sparepart'));
    }

    // Update sparepart
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'compatible_for' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'warranty' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $sparepart = Sparepart::findOrFail($id);

        $data = [
            'name' => $request->name,
            'compatible_for' => $request->compatible_for,
            'price' => $request->price,
            'warranty' => $request->warranty,
        ];

        // Upload image baru jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($sparepart->image) {
                Storage::disk('public')->delete('spareparts/' . $sparepart->image);
            }
            $file = $request->file('image');
            $data['image'] = 'sp_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('spareparts', $file, $data['image']);
        }

        $sparepart->update($data);

        return redirect()->route('admin.sparepart.index')
            ->with('success', 'Sparepart berhasil diupdate.');
    }

    // Hapus sparepart
    public function destroy($id)
    {
        $sparepart = Sparepart::findOrFail($id);

        // Cek apakah pernah dipakai di service
        if ($sparepart->services()->count() > 0) {
            return back()->with('error', 'Sparepart tidak dapat dihapus karena sudah digunakan dalam service.');
        }

        $sparepart->stockHistories()->delete();
        $sparepart->delete();

        return back()->with('success', 'Sparepart berhasil dihapus.');
    }

    // Toggle aktif/nonaktif
    public function toggleActive($id)
    {
        $sparepart = Sparepart::findOrFail($id);
        $sparepart->update(['active' => !$sparepart->active]);

        $status = $sparepart->active ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('success', "Sparepart berhasil {$status}.");
    }

    // Halaman kelola stok
    public function stock($id)
    {
        $sparepart = Sparepart::with(['stockHistories' => function ($q) {
            $q->latest()->take(20);
        }])->findOrFail($id);

        return view('admin.sparepart.stock', compact('sparepart'));
    }

    // Update stok
    public function updateStock(Request $request, $id)
    {
        $request->validate([
            'change_type' => 'required|in:IN,OUT',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string|max:255',
        ], [
            'change_type.required' => 'Tipe perubahan wajib dipilih',
            'quantity.required' => 'Jumlah wajib diisi',
            'quantity.min' => 'Jumlah minimal 1',
        ]);

        try {
            DB::beginTransaction();

            $sparepart = Sparepart::findOrFail($id);

            // Validasi stok keluar
            if ($request->change_type === 'OUT' && $sparepart->stock < $request->quantity) {
                return back()->with('error', 'Stok tidak mencukupi. Stok tersedia: ' . $sparepart->stock);
            }

            // Update stok
            if ($request->change_type === 'IN') {
                $sparepart->increment('stock', $request->quantity);
            } else {
                $sparepart->decrement('stock', $request->quantity);
            }

            // Catat history
            SparepartStockHistory::create([
                'sparepart_id' => $sparepart->id,
                'change_type' => $request->change_type,
                'quantity' => $request->quantity,
                'note' => $request->note,
            ]);

            DB::commit();

            $action = $request->change_type === 'IN' ? 'ditambah' : 'dikurangi';

            return back()->with('success', "Stok berhasil {$action}.");

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }
}