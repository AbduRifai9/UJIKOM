<?php

namespace App\Http\Controllers;

use App\Models\event;
use App\Models\sponsor;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sponsor = sponsor::latest()->get();
        return view('sponsor.index', compact('sponsor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sponsor = sponsor::all();
        $event = event::all();
        return view('sponsor.create', compact('sponsor', 'event'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_event' => 'required',
            'nama_sponsor' => 'required',
            'deskripsi' => 'required',
        ]);

        $sponsor = new sponsor();
        $sponsor->id_event = $request->id_event;
        $sponsor->nama_sponsor = $request->nama_sponsor;

        // upload image
        if ($request->hasFile('logo')) {
            $img = $request->file('logo');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/sponsor', $name);
            $sponsor->logo = $name;
        }

        $sponsor->deskripsi = $request->deskripsi;
        $sponsor->save();
        return redirect()->route('sponsor.index')
            ->with('success', 'data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(sponsor $sponsor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sponsor = sponsor::FindOrFail($id);
        $event = event::all();
        return view('sponsor.edit', compact('sponsor', 'event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validated = $request->validate([
            'id_event' => 'required',
            'nama_sponsor' => 'required',
            'deskripsi' => 'required',
        ]);

        $sponsor = sponsor::FindOrFail($id);
        $sponsor->id_event = $request->id_event;
        $sponsor->nama_sponsor = $request->nama_sponsor;

        if ($request->hasFile('logo')) {
            // $sponsor->deleteImage();
            $img = $request->file('logo');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/sponsor/', $name);
            $sponsor->logo = $name;
        }

        $sponsor->deskripsi = $request->deskripsi;
        $sponsor->save();
        return redirect()->route('sponsor.index')
            ->with('success', 'data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sponsor = sponsor::FindOrFail($id);
        $sponsor->delete();
        // $produk->kategori()->detach();
        return redirect()->route('sponsor.index')
            ->with('success', 'data berhasil dihapus');
    }
}
