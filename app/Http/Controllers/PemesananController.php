<?php

namespace App\Http\Controllers;

use App\Models\event;
use App\Models\pemesanan;
use App\Models\tiket;
use App\Models\User;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemesanan = pemesanan::latest()->get();
        return view('pemesanan.index', compact('pemesanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pemesanan = pemesanan::all();
        $user = user::all();
        $tiket = tiket::all();
        $event = event::all();
        return view('pemesanan.create', compact('pemesanan', 'user', 'tiket', 'event'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required',
            'id_tiket' => 'required',
            'kuantitas' => 'required',
            'total_harga' => 'required',
            'status' => 'nullable',
        ]);

        $pemesanan = new pemesanan();
        $pemesanan->id_user = $request->id_user;
        $pemesanan->id_tiket = $request->id_tiket;
        $pemesanan->kuantitas = $request->kuantitas;
        $pemesanan->total_harga = $request->total_harga;
        $pemesanan->status = 'Belum Bayar';
        $pemesanan->save();
        return redirect()->route('pemesanan.index')
            ->with('success', 'data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**  
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $user = User::all();
        $tiket = tiket::all();
        $event = event::all();
        return view('pemesanan.edit', compact('pemesanan', 'user', 'tiket', 'event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_user' => 'required',
            'id_tiket' => 'required',
            'kuantitas' => 'required',
            'total_harga' => 'required',
            'status' => 'required',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->id_user = $request->id_user;
        $pemesanan->id_tiket = $request->id_tiket;
        $pemesanan->kuantitas = $request->kuantitas;
        $pemesanan->total_harga = $request->total_harga;
        $pemesanan->status = $request->status;
        $pemesanan->save();
        return redirect()->route('pemesanan.index')
            ->with('success', 'data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pemesanan = pemesanan::FindOrFail($id);
        $pemesanan->delete();
// $produk->kategori()->detach();
        return redirect()->route('pemesanan.index')
            ->with('success', 'data berhasil dihapus');
    }
}
