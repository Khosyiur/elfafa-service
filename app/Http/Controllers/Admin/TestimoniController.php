<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimoniController extends Controller
{
    // Daftar testimoni
    public function index()
    {
        $testimonis = Testimoni::latest()->paginate(10);

        return view('admin.testimoni.index', compact('testimonis'));
    }

    // Form tambah
    public function create()
    {
        return view('admin.testimoni.create');
    }

    //simpan testimoni
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'required|string',
            'before_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'after_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'before_photo' => null,
            'after_photo' => null,
        ];

        // Upload before photo
        if ($request->hasFile('before_photo')) {
            $file = $request->file('before_photo');
            $filename = 'before_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Simpan file ke disk 'public' secara eksplisit
            Storage::disk(env('FILESYSTEM_DISK'))->putFileAs('testimonis', $file, $filename);

            $data['before_photo'] = $filename;
        }

        // Upload after photo
        if ($request->hasFile('after_photo')) {
            $file = $request->file('after_photo');
            $filename = 'after_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Simpan file ke disk 'public' secara eksplisit
            Storage::disk(env('FILESYSTEM_DISK'))->putFileAs('testimonis', $file, $filename);

            $data['after_photo'] = $filename;
        }

        Testimoni::create($data);

        return redirect()->route('admin.testimoni.index')
            ->with('success', 'Testimoni berhasil ditambahkan.');
    }

    // Form edit
    public function edit($id)
    {
        $testimoni = Testimoni::findOrFail($id);

        return view('admin.testimoni.edit', compact('testimoni'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'required|string',
            'before_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'after_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $testimoni = Testimoni::findOrFail($id);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        // Upload before photo baru
        if ($request->hasFile('before_photo')) {
            // Hapus foto lama
            if ($testimoni->before_photo) {
                Storage::disk(env('FILESYSTEM_DISK'))->delete('testimonis/' . $testimoni->before_photo);
            }

            $file = $request->file('before_photo');
            $data['before_photo'] = 'before_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            Storage::disk(env('FILESYSTEM_DISK'))->putFileAs('testimonis', $file, $data['before_photo']);
        }

        // Upload after photo baru
        if ($request->hasFile('after_photo')) {
            // Hapus foto lama
            if ($testimoni->after_photo) {
                Storage::disk(env('FILESYSTEM_DISK'))->delete('testimonis/' . $testimoni->after_photo);
            }

            $file = $request->file('after_photo');
            $data['after_photo'] = 'after_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            Storage::disk(env('FILESYSTEM_DISK'))->putFileAs('testimonis', $file, $data['after_photo']);
        }

        $testimoni->update($data);

        return redirect()->route('admin.testimoni.index')
            ->with('success', 'Testimoni berhasil diupdate.');
    }

    public function destroy($id)
    {
        $testimoni = Testimoni::findOrFail($id);

        // Hapus foto
        if ($testimoni->before_photo) {
            Storage::disk(env('FILESYSTEM_DISK'))->delete('testimonis/' . $testimoni->before_photo);
        }
        if ($testimoni->after_photo) {
            Storage::disk(env('FILESYSTEM_DISK'))->delete('testimonis/' . $testimoni->after_photo);
        }

        $testimoni->delete();

        return back()->with('success', 'Testimoni berhasil dihapus.');
    }
}