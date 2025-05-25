<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Rating;
use Illuminate\Support\Facades\Storage;

class DokterController extends Controller
{
    // ✅ Halaman daftar dokter (untuk user & admin)
    public function index(Request $request)
{
    $lokasi = $request->get('lokasi');

    $dokters = Dokter::with('ratings') // supaya rating bisa dipakai langsung
        ->when($lokasi, fn($q) => $q->where('lokasi', $lokasi))
        ->get();

    $lokasiList = Dokter::select('lokasi')->distinct()->pluck('lokasi');

    return view('dokter.index', compact('dokters', 'lokasiList', 'lokasi'));
}

    //Form tambah dokter (Admin)
    public function create()
    {
        return view('dokter.create');
    }

    //Simpan data dokter
public function store(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'pengalaman' => 'required|string|max:255',
        'lokasi' => 'required|string|max:255',
        'alamat' => 'required|string',
        'jadwal' => 'nullable|string',
        'foto' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('foto')) {
        $validated['foto'] = $request->file('foto')->store('foto_dokter', 'public');
    }

    Dokter::create($validated);

    return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil disimpan!');
}

    //Form edit dokter
    public function edit(Dokter $dokter)
    {
        return view('dokter.edit', compact('dokter'));
    }

    // ✅ Update data dokter
    public function update(Request $request, Dokter $dokter)
    {
        $data = $request->validate([
            'nama' => 'required',
            'pengalaman' => 'required',
            'lokasi' => 'required',
            'alamat' => 'required',
            'jadwal' => 'nullable',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama kalau ada
            if ($dokter->foto) {
                Storage::disk('public')->delete($dokter->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto_dokter', 'public');
        }

        $dokter->update($data);
        return redirect()->route('dokter.index')->with('success', 'Dokter diperbarui.');
    }

    // ✅ Hapus dokter
    public function destroy(Dokter $dokter)
    {
        if ($dokter->foto) {
            Storage::disk('public')->delete($dokter->foto);
        }

        $dokter->delete();
        return back()->with('success', 'Dokter dihapus.');
    }

    //Tampilkan detail dokter
    public function show(Dokter $dokter)
    {
        return view('dokter.show', compact('dokter'));
    }

}