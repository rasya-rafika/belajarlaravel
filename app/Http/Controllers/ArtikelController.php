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
        $artikels = Artikel::latest()->paginate(10);
        return view('artikel.index', compact('artikels'));
    }

    // Menampilkan artikel berdasarkan ID (untuk umum)
    public function show($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('artikel.show', compact('artikel'));
    }

    // Menampilkan form untuk membuat artikel baru
    public function create()
    {
        // Cek apakah user memiliki role user atau admin (dengan Spatie Permission)
        if (!Auth::user()->hasAnyRole(['user', 'admin'])) {
            return redirect()->route('artikel.index')->with('error', 'Anda tidak memiliki akses untuk membuat artikel.');
        }
        
        return view('artikel.create');
    }

    // Menyimpan artikel baru ke database
    public function store(Request $request)
    {
        // Cek apakah user memiliki role user atau admin (dengan Spatie Permission)
        if (!Auth::user()->hasAnyRole(['user', 'admin'])) {
            return redirect()->route('artikel.index')->with('error', 'Anda tidak memiliki akses untuk membuat artikel.');
        }
        
        $request->validate([
            'judul' => 'required',
            'link_artikel' => 'required|url',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
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
        $artikel = Artikel::findOrFail($id);

        // Cek akses: Admin bisa edit semua, User hanya bisa edit artikel sendiri
        if (Auth::user()->hasRole('admin')) {
            // Admin bisa edit semua artikel
            return view('artikel.edit', compact('artikel'));
        } elseif (Auth::user()->hasRole('user') && $artikel->user_id == Auth::id()) {
            // User hanya bisa edit artikel sendiri
            return view('artikel.edit', compact('artikel'));
        } else {
            return redirect()->route('artikel.index')->with('error', 'Anda tidak memiliki akses untuk mengedit artikel ini.');
        }
    }

    // Memperbarui artikel
    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        // Cek akses: Admin bisa update semua, User hanya bisa update artikel sendiri
        if (!(Auth::user()->hasRole('admin') || (Auth::user()->hasRole('user') && $artikel->user_id == Auth::id()))) {
            return redirect()->route('artikel.index')->with('error', 'Anda tidak memiliki akses untuk mengedit artikel ini.');
        }

        $request->validate([
            'judul' => 'required',
            'link_artikel' => 'required|url',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        // Update gambar jika ada file gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($artikel->gambar && Storage::exists('public/'.$artikel->gambar)) {
                Storage::delete('public/'.$artikel->gambar);
            }
            
            $gambar = $request->file('gambar')->store('foto_artikel', 'public');
            $artikel->gambar = $gambar;
        }

        // Memperbarui data artikel
        $artikel->update([
            'judul' => $request->judul,
            'link_artikel' => $request->link_artikel,
            'deskripsi' => $request->deskripsi,
            'gambar' => $artikel->gambar,
        ]);

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    // Menghapus artikel berdasarkan ID
    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);

        // Cek akses: Admin bisa hapus semua, User hanya bisa hapus artikel sendiri
        if (!(Auth::user()->hasRole('admin') || (Auth::user()->hasRole('user') && $artikel->user_id == Auth::id()))) {
            return redirect()->route('artikel.index')->with('error', 'Anda tidak memiliki akses untuk menghapus artikel ini.');
        }

        // Menghapus gambar jika ada
        if ($artikel->gambar && Storage::exists('public/'.$artikel->gambar)) {
            Storage::delete('public/'.$artikel->gambar);
        }

        $artikel->delete();

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }
}
