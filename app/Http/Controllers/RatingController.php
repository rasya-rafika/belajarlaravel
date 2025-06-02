<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function create($id)
    {
        $dokter = Dokter::findOrFail($id);
      return view('dokter.ratings', compact('dokter'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'nilai' => 'required|integer|min:1|max:5',
        ]);

        Rating::create([
            'user_id' => Auth::id(),
            'dokter_id' => $id,
            'nilai' => $request->nilai,
        ]);

        return redirect()->route('dokter.index', $id)->with('success', 'Rating berhasil ditambahkan!');
    }
}
