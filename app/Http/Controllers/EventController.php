<?php

namespace App\Http\Controllers;

use App\Models\event;
use App\Models\lokasi;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $event = event::latest()->get();
        return view('event.index', compact('event'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $event = event::all();
        $lokasi = lokasi::all();
        return view('event.create', compact('event', 'lokasi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_event' => 'required',
            'deskripsi' => 'required',
            'tanggal_mulai' => 'required',
            'waktu_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'waktu_selesai' => 'required',
            'id_lokasi' => 'required',
            'status' => 'nullable|enum',
        ]);

        $event = new event();
        $event->nama_event = $request->nama_event;
        $event->deskripsi = $request->deskripsi;
        // upload image
        if ($request->hasFile('poster')) {
            $img = $request->file('poster');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/event', $name);
            $event->poster = $name;
        }
        $event->tanggal_mulai = $request->tanggal_mulai;
        $event->waktu_mulai = $request->waktu_mulai;
        $event->tanggal_selesai = $request->tanggal_selesai;
        $event->waktu_selesai = $request->waktu_selesai;
        $event->id_lokasi = $request->id_lokasi;
        $event->status = 'Segera';

        $event->save();
        return redirect()->route('event.index')
            ->with('success', 'data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = event::FindOrFail($id);
        $lokasi = lokasi::all();
        return view('event.show', compact('event', 'lokasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lokasi = lokasi::all();
        $event = event::FindOrFail($id);
        return view('event.edit', compact('event', 'lokasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_event' => 'required',
            'deskripsi' => 'required',
            'tanggal_mulai' => 'required',
            'waktu_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'waktu_selesai' => 'required',
            'id_lokasi' => 'required',
            'status' => 'required',
        ]);

        $event = event::FindOrFail($id);
        $event->nama_event = $request->nama_event;
        $event->deskripsi = $request->deskripsi;
        // upload image
        if ($request->hasFile('poster')) {
            $img = $request->file('poster');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/event', $name);
            $event->poster = $name;
        }
        $event->tanggal_mulai = $request->tanggal_mulai;
        $event->waktu_mulai = $request->waktu_mulai;
        $event->tanggal_selesai = $request->tanggal_selesai;
        $event->waktu_selesai = $request->waktu_selesai;
        $event->id_lokasi = $request->id_lokasi;
        $event->status = $request->status;

        $event->save();
        return redirect()->route('event.index')->with('success', 'Data berhasil diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event = event::FindOrFail($id);
        $event->delete();
        // $produk->kategori()->detach();
        return redirect()->route('event.index')
            ->with('success', 'data berhasil dihapus');
    }
}
