<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    /**
     * Display contact form for users OR list of contacts for admin.
     */
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            // Admin melihat daftar semua pesan
            $contacts = Contact::latest()->get();
            return view('contact.index', compact('contacts'));
        } elseif (auth()->user()->hasRole('user')) {
            // User melihat form contact
            return view('contact.index');
        }
        
        return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
    }

    /**
     * Show the form for creating a new resource (tidak digunakan).
     */
    public function create()
    {
        return redirect()->route('contact.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Pastikan hanya user yang dapat mengirim pesan
        if (!auth()->user()->hasRole('user')) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'category' => 'required|in:aduan_permasalahan,pendaftaran_dokter,pendaftaran_hewan_adopsi,lainnya',
            'message' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['name', 'email', 'category', 'message']);
        
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('contact-photos', 'public');
        }

        Contact::create($data);

        return redirect()->route('contact.index')
                         ->with('success', 'Pesan berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        if (!auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        // Mark as read when viewed
        if (!$contact->is_read) {
            $contact->update(['is_read' => true]);
        }

        return view('contact.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        if (!auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        return view('contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        if (!auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'category' => 'required|in:aduan_permasalahan,pendaftaran_dokter,pendaftaran_hewan_adopsi,lainnya',
            'message' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['name', 'email', 'category', 'message']);
        
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($contact->photo) {
                Storage::disk('public')->delete($contact->photo);
            }
            $data['photo'] = $request->file('photo')->store('contact-photos', 'public');
        }

        $contact->update($data);

        return redirect()->route('contact.index')
                         ->with('success', 'Pesan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        if (!auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        // Delete photo if exists
        if ($contact->photo) {
            Storage::disk('public')->delete($contact->photo);
        }

        $contact->delete();

        return redirect()->route('contact.index')
                         ->with('success', 'Pesan berhasil dihapus!');
    }

    /**
     * Mark contact as read
     */
    public function markAsRead(Contact $contact)
    {
        if (!auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        $contact->update(['is_read' => true]);

        return redirect()->route('contact.index')
                         ->with('success', 'Pesan telah ditandai sebagai sudah dibaca!');
    }

    /**
     * Delete contact photo
     */
    public function destroyPhoto(Contact $contact)
    {
        if (!auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        if ($contact->photo) {
            Storage::disk('public')->delete($contact->photo);
            $contact->update(['photo' => null]);
        }

        return redirect()->back()
                         ->with('success', 'Foto berhasil dihapus!');
    }
}