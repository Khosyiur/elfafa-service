<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Sparepart;
use Illuminate\Http\Request;

class SparepartController extends Controller
{
    public function index(Request $request)
    {
        $query = Sparepart::active();

        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('compatible_for', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan status stok
        if ($request->filled('stock_status')) {
            switch ($request->stock_status) {
                case 'available':
                    $query->where('stock', '>', 0);
                    break;
                case 'low':
                    $query->where('stock', '>', 0)->where('stock', '<', 5);
                    break;
                case 'empty':
                    $query->where('stock', '<=', 0);
                    break;
            }
        }

        $spareparts = $query->orderBy('name')->paginate(12);

        return view('customer.pages.sparepart.index', compact('spareparts'));
    }
}