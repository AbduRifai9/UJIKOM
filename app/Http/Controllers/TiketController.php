<?php

namespace App\Http\Controllers;

use App\Models\event;
use App\Models\tiket;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiket = tiket::latest()->get();
        $event = event::all();
        return view('tiket.index', compact('tiket', 'event'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tiket = tiket::all();
        $event = event::all();
        return view('tiket.create', compact('tiket', 'event'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_event' => 'required',
            'jenis_tiket' => 'nullable|enum',
            'harga_tiket' => 'required',
            'kuota_tiket' => 'required',
            'tiket_terjual' => 'nullable|number',
            'status' => 'nullable|enum',
        ]);

        $tiket = new tiket();
        $tiket->id_event = $request->id_event;
        $tiket->jenis_tiket = 'Reguler';
        $tiket->harga_tiket = $request->harga_tiket;
        $tiket->kuota_tiket = $request->kuota_tiket;
        $tiket->tiket_terjual = 0;
        $tiket->status = 'Aktif';

        $tiket->save();
        return redirect()->route('tiket.index')
            ->with('success', 'data berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(tiket $tiket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $event = event::all();
        $tiket = tiket::FindOrFail($id);
        return view('tiket.edit', compact('tiket', 'event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_event' => 'required',
            'jenis_tiket' => 'required',
            'harga_tiket' => 'required',
            'kuota_tiket' => 'required',
            'tiket_terjual' => 'required',
            'status' => 'required',
        ]);

        $tiket = tiket::FindOrFail($id);
        $tiket->id_event = $request->id_event;
        $tiket->jenis_tiket = $request->jenis_tiket;
        $tiket->harga_tiket = $request->harga_tiket;
        $tiket->kuota_tiket = $request->kuota_tiket - $request->tiket_terjual;
        $tiket->tiket_terjual = $request->tiket_terjual;
        $tiket->status = $request->status;

        // $tiket->kuota_tersisa = $tiket->kuota_tiket - $tiket->tiket_terjual;

        $tiket->save();
        return redirect()->route('tiket.index')->with('success', 'Data berhasil diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tiket $tiket)
    {
        //
    }
}
