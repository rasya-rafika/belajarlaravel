<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    // Menampilkan daftar artikel
    public function index()
{
    // Admin bisa melihat semua artikel
    if (Auth::check() && Auth::user()->hasRole('admin')) {
        $artikels = Artikel::latest()->paginate(10);  // Admin dapat melihat semua artikel
    } else {
        // Semua orang bisa melihat artikel (termasuk yang belum login)
        $artikels = Artikel::latest()->paginate(10);  // Semua user atau bukan user (belum login) bisa melihat artikel
    }

    return view('artikel.index', compact('artikels'));
}


    // Menampilkan artikel berdasarkan ID (untuk umum)
    public function show($id)
    {
        // Semua orang bisa melihat artikel
        $artikel = Artikel::findOrFail($id);  // Mencari artikel berdasarkan ID
        return view('artikel.show', compact('artikel'));
    }

    // Menampilkan form untuk membuat artikel baru
    public function create()
    {
        return view('artikel.create');
    }

    // Menyimpan artikel baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'link_artikel' => 'required|url',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',  // Memastikan gambar valid
        ]);

        // Menyimpan file gambar jika ada
        $gambar = $request->hasFile('gambar') ? $request->file('gambar')->store('foto_artikel', 'public') : null;

        // Membuat artikel baru dengan mengaitkan user yang sedang login
        Artikel::create([
            'judul' => $request->judul,
            'link_artikel' => $request->link_artikel,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar,
            'user_id' => Auth::id(),  // Mengaitkan artikel dengan user yang login
        ]);

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit artikel
public function edit($id)
{
    $artikel = Artikel::findOrFail($id);  // Mencari artikel yang akan diedit

    // Admin bisa mengedit artikel apapun
    if ($artikel->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
        return redirect()->route('artikel.index')->with('error', 'Anda tidak memiliki akses untuk mengedit artikel ini.');
    }

    return view('artikel.edit', compact('artikel'));
}


    // Memperbarui artikel
public function update(Request $request, $id)
{
    $request->validate([
        'judul' => 'required',
        'link_artikel' => 'required|url',
        'deskripsi' => 'required',
        'gambar' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',  // Memastikan gambar valid
    ]);

    $artikel = Artikel::findOrFail($id);  // Mencari artikel yang akan diupdate

    // Admin bisa mengupdate artikel apapun
    if ($artikel->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
        return redirect()->route('artikel.index')->with('error', 'Anda tidak memiliki akses untuk mengedit artikel ini.');
    }


        // Hapus gambar lama sebelum mengganti dengan gambar baru
        if ($artikel->gambar && Storage::exists('public/'.$artikel->gambar)) {
            Storage::delete('public/'.$artikel->gambar);
        }

        // Update gambar jika ada file gambar baru
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('foto_artikel', 'public');
            $artikel->gambar = $gambar;
        }

        // Memperbarui data artikel
        $artikel->update([
            'judul' => $request->judul,
            'link_artikel' => $request->link_artikel,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil diperbarui!');
    }

// Menghapus artikel berdasarkan ID
public function destroy($id)
{
    $artikel = Artikel::findOrFail($id);  // Mencari artikel berdasarkan ID

    // Admin bisa menghapus artikel apapun, user hanya bisa menghapus artikel mereka sendiri
    if ($artikel->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
        return redirect()->route('artikel.index')->with('error', 'Anda tidak memiliki akses untuk menghapus artikel ini.');
    }

    // Menghapus gambar jika ada
    if ($artikel->gambar && Storage::exists('public/'.$artikel->gambar)) {
        Storage::delete('public/'.$artikel->gambar);
    }

    $artikel->delete();  // Menghapus artikel

    return redirect()->route('artikel.index')->with('success', 'Artikel berhasil dihapus!');
}



}
