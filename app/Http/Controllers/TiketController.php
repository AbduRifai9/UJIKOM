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
        return view('admin.tiket.index', compact('tiket', 'event'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $event = event::with('lokasi', 'tiket')->get();

// Siapkan data kapasitas tersisa per event
        $kapasitasPerEvent = [];
        foreach ($event as $e) {
            $kapasitas = $e->lokasi->kapasitas;
            $terpakai  = $e->tiket->sum('kuota_tiket');
            $sisa      = $kapasitas - $terpakai;

            $kapasitasPerEvent[$e->id] = $sisa;
        }

        return view('admin.tiket.create', compact('event', 'kapasitasPerEvent'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id'    => 'required|exists:events,id',
            'aktif_jenis' => 'required|array',
            'harga_tiket' => 'required|array',
            'kuota_tiket' => 'required|array',
        ]);

        foreach ($request->aktif_jenis as $jenis) {
            $harga = $request->harga_tiket[$jenis] ?? null;
            $kuota = $request->kuota_tiket[$jenis] ?? null;

            if ($harga && $kuota) {
                \App\Models\Tiket::create([
                    'event_id'      => $request->event_id,
                    'jenis_tiket'   => $jenis,
                    'harga_tiket'   => $harga,
                    'kuota_tiket'   => $kuota,
                    'tiket_terjual' => 0,
                    'status'        => 'Aktif',
                ]);
            }
        }

        return redirect()->route('admin.tiket.index')->with('success', 'Tiket berhasil ditambahkan.');
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
        return view('admin.tiket.edit', compact('tiket', 'event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'event_id'      => 'required',
            'jenis_tiket'   => 'required',
            'harga_tiket'   => 'required',
            'kuota_tiket'   => 'required',
            'tiket_terjual' => 'required',
            'status'        => 'required',
        ]);

        $tiket                = tiket::FindOrFail($id);
        $tiket->event_id      = $request->event_id;
        $tiket->jenis_tiket   = $request->jenis_tiket;
        $tiket->harga_tiket   = $request->harga_tiket;
        $tiket->kuota_tiket   = $request->kuota_tiket - $request->tiket_terjual;
        $tiket->tiket_terjual = $request->tiket_terjual;
        $tiket->status        = $request->status;

        // $tiket->kuota_tersisa = $tiket->kuota_tiket - $tiket->tiket_terjual;

        $tiket->save();
        return redirect()->route('admin.tiket.index')->with('success', 'Data berhasil diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tiket = Tiket::FindOrFail($id);
        $tiket->delete();
        // $produk->kategori()->detach();
        return redirect()->route('admin.tiket.index')
            ->with('success', 'data berhasil dihapus');
    }
}
