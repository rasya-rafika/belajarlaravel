<?php

namespace App\Http\Controllers;

use App\Models\Adopsi;
use App\Models\PengajuanAdopsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdopsiController extends Controller
{
    // Admin dapat CRUD hewan adopsi
    public function create()
    {
        return view('adopsi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_hewan' => 'required',
            'jenis_hewan' => 'required|string',
            'jenis_kelamin' => 'required',
            'umur' => 'required|integer',
            'deskripsi' => 'required',
            'status' => 'nullable|string|in:tersedia,proses,diadopsi',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        // Handle gambar upload
        $gambar = $request->hasFile('gambar') ? $request->file('gambar')->store('gambar_adopsi', 'public') : null;

        // Create new Adopsi record
        Adopsi::create([
            'nama_hewan' => $request->nama_hewan,
            'jenis_hewan' => $request->jenis_hewan ?? 'Lainnya',
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status ?? 'tersedia',
            'gambar' => $gambar,
            'user_id' => Auth::id(), // Menyimpan ID admin yang menambahkan
        ]);

        return redirect()->route('adopsi.index')->with('success', 'Hewan berhasil ditambahkan untuk diadopsi!');
    }

    public function index()
    {
        $adopsis = Adopsi::latest()->paginate(10);
        return view('adopsi.index', compact('adopsis'));
    }

    public function show($id)
    {
        $adopsi = Adopsi::findOrFail($id);
        return view('adopsi.show', compact('adopsi'));
    }

    // Form edit adopsi (hanya admin)
    public function edit($id)
    {
        // Pastikan hanya admin yang bisa mengakses
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $adopsi = Adopsi::findOrFail($id);
        return view('adopsi.edit', compact('adopsi'));
    }

    // Update data adopsi (hanya admin)
    public function update(Request $request, $id)
    {
        // Pastikan hanya admin yang bisa mengakses
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $adopsi = Adopsi::findOrFail($id);

        $validatedData = $request->validate([
            'nama_hewan' => 'required|string|max:255',
            'jenis_hewan' => 'required|string|in:Kucing,Anjing,Kelinci,Burung,Lainnya',
            'umur' => 'required|integer|min:0|max:30',
            'jenis_kelamin' => 'required|string|in:Jantan,Betina',
            'deskripsi' => 'required|string',
            'status' => 'required|string|in:tersedia,proses,diadopsi',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle gambar upload jika ada
        if ($request->hasFile('gambar')) {
            if ($adopsi->gambar && Storage::disk('public')->exists($adopsi->gambar)) {
                Storage::disk('public')->delete($adopsi->gambar);
            }

            $gambarPath = $request->file('gambar')->store('gambar_adopsi', 'public');
            $validatedData['gambar'] = $gambarPath;
        }

        // Update data
        $adopsi->update($validatedData);

        return redirect()->route('adopsi.index')->with('success', 'Data adopsi berhasil diperbarui!');
    }

    // Hapus data adopsi (hanya admin)
    public function destroy($id)
    {
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $adopsi = Adopsi::findOrFail($id);

        // Hapus gambar jika ada
        if ($adopsi->gambar && Storage::disk('public')->exists($adopsi->gambar)) {
            Storage::disk('public')->delete($adopsi->gambar);
        }

        $adopsi->delete();

        return redirect()->route('adopsi.index')->with('success', 'Data adopsi berhasil dihapus!');
    }

    public function adopsiForm($id)
    {
        $adopsi = Adopsi::findOrFail($id);
        return view('adopsi.adopt', compact('adopsi'));
    }

    public function submitAdopsi(Request $request, $id)
    {
        $request->validate([
            'nama_pengaju' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
            'alasan_adopsi' => 'required',
        ]);

        PengajuanAdopsi::create([
            'adopsi_id' => $id,
            'nama_pengaju' => $request->nama_pengaju,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'alasan_adopsi' => $request->alasan_adopsi,
        ]);

        return redirect()->route('adopsi.index')->with('success', 'Pengajuan adopsi berhasil dikirim!');
    }
}
