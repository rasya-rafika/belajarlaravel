<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Rating;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

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

    // ✅ FIXED: Halaman Chart Rating (Admin only)
    public function chartRating()
    {
        // Ambil semua dokter dengan ratings
        $dokters = Dokter::with(['ratings' => function($query) {
            $query->select('dokter_id', 'nilai', 'created_at');
        }])->get();

        // Siapkan data untuk chart
        $dokterNames = [];
        $ratings = [];
        $chartData = [];

        foreach ($dokters as $dokter) {
            $avgRating = $dokter->ratings->avg('nilai') ?? 0;
            $totalRating = $dokter->ratings->count();
            
            // Data untuk chart JS
            $dokterNames[] = $dokter->nama;
            $ratings[] = round($avgRating, 1);
            
            // Data untuk tabel/display
            $chartData[] = [
                'nama' => $dokter->nama,
                'rata_rating' => round($avgRating, 1),
                'total_rating' => $totalRating,
                'lokasi' => $dokter->lokasi
            ];
        }

        // Statistik keseluruhan
        $totalDokter = $dokters->count();
        $totalReview = Rating::count();
        $ratingRataRata = Rating::avg('nilai') ?? 0;

        // Urutkan berdasarkan rata-rata rating tertinggi
        $chartData = collect($chartData)->sortByDesc('rata_rating')->values()->all();

        return view('dokter.chart', compact(
            'chartData',
            'dokters',
            'dokterNames',
            'ratings',
            'totalDokter',
            'totalReview',
            'ratingRataRata'
        ));
    }

    // ✅ TAMBAHAN BARU: Download PDF Rating Report (Admin only)
    public function generatePdf(Request $request)
{
    $chartBase64 = $request->input('chart');

    $dokters = Dokter::with(['ratings' => function($query) {
        $query->select('dokter_id', 'nilai', 'created_at');
    }])->get();

    // Data untuk PDF
    $reportData = [];
    foreach ($dokters as $dokter) {
        $ratings = $dokter->ratings;
        $avgRating = $ratings->avg('nilai') ?? 0;
        $totalRating = $ratings->count();
        
        // Distribusi rating (1-5 bintang)
        $distribution = [];
        for ($i = 1; $i <= 5; $i++) {
            $count = $ratings->where('nilai', $i)->count();
            $distribution[$i] = $count;
        }

        $reportData[] = [
            'nama' => $dokter->nama,
            'lokasi' => $dokter->lokasi,
            'pengalaman' => $dokter->pengalaman,
            'rata_rating' => round($avgRating, 1),
            'total_rating' => $totalRating,
            'distribusi' => $distribution,
            'rating_terbaru' => $ratings->sortByDesc('created_at')->first()
        ];
    }

    $reportData = collect($reportData)->sortByDesc('rata_rating')->values()->all();

    $pdf = Pdf::loadView('dokter.pdf-report', [
        'reportData' => $reportData,
        'tanggal' => now()->format('d F Y'),
        'chartBase64' => $chartBase64
    ])->setPaper('a4', 'portrait');

    return $pdf->download('laporan-rating-dokter-' . now()->format('Y-m-d') . '.pdf');
}

}