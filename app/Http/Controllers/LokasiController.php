<?php

namespace App\Http\Controllers;

use App\Models\lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lokasi = lokasi::latest()->get();
        return view('lokasi.index', compact('lokasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lokasi = lokasi::all();
        return view('lokasi.create', compact('lokasi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lokasi' => 'required',
            'kapasitas' => 'required',
            'latitude'    => 'required|numeric',
            'longitude'   => 'required|numeric',
        ]);

        $lokasi = new lokasi();
        $lokasi->nama_lokasi = $request->nama_lokasi;
        $lokasi->kapasitas = $request->kapasitas;
        $lokasi->latitude = $request->latitude;
        $lokasi->longitude = $request->longitude;

        $lokasi->save();
        return redirect()->route('lokasi.index')
            ->with('success', 'data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lokasi = lokasi::FindOrFail($id);
        return view('lokasi.show', compact('lokasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lokasi = lokasi::FindOrFail($id);
        return view('lokasi.edit', compact('lokasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_lokasi' => 'required',
            'kapasitas' => 'required',
            'latitude'    => 'required|numeric',
            'longitude'   => 'required|numeric',
        ]);

        $lokasi->save();
        return redirect()->route('lokasi.index')
            ->with('success', 'data berhasil diperbarui');
    }

    // private function extractSrc($input)
    // {
    //     // Jika input sudah berupa URL, langsung return
    //     if (filter_var($input, FILTER_VALIDATE_URL)) {
    //         return $input;
    //     }

    //     // Coba ambil src dari kode <iframe>
    //     if (preg_match('/src=["\']([^"\']+)["\']/', $input, $matches)) {
    //         return $matches[1]; // Kembalikan hanya URL dari src
    //     }

    //     // Jika tidak valid, kembalikan string kosong atau error
    //     return null;
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $lokasi = lokasi::FindOrFail($id);
        $lokasi->delete();
        // $produk->kategori()->detach();
        return redirect()->route('lokasi.index')
            ->with('success', 'data berhasil dihapus');
    }
}
