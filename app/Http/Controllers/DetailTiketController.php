<?php
namespace App\Http\Controllers;

use App\Models\detail;
use App\Models\detail_tiket;
use App\Models\event;
use App\Models\pembayaran;
use App\Models\pemesanan;
use App\Models\tiket;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DetailTiketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detail     = detail_tiket::all();
        $tiket      = Tiket::all();
        $pemesanan  = Pemesanan::all();
        $pembayaran = Pembayaran::all();
        $event      = event::all();
        return view('detail.index', compact('detail', 'tiket', 'pemesanan', 'pembayaran', 'event', 'detail'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     $detail     = detail_tiket::all();
    //     $tiket      = Tiket::all();
    //     $pemesanan  = Pemesanan::all();
    //     $pembayaran = Pembayaran::all();
    //     $event      = event::all();
    //     return view('detail.create', compact('detail', 'tiket', 'pemesanan', 'pembayaran', 'event'));
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'id_pemesanan'  => 'required',
    //         'id_tiket'      => 'required',
    //         'id_pembayaran' => 'required',
    //         'status'        => 'required',
    //     ]);

    //     $detail                = new detail_tiket();
    //     $detail->id_pemesanan  = $request->id_pemesanan;
    //     $detail->id_tiket      = $request->id_tiket;
    //     $detail->id_pembayaran = $request->id_pembayaran;
    //     $detail->status        = $request->status;

    //     $detail->save();
    //     return redirect()->route('detail.index')
    //         ->with('success', 'data berhasil ditambahkan');

    // }

    /**
     * Display the specified resource.
     */
    public function show(detail_tiket $detail_tiket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(detail_tiket $detail_tiket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, detail_tiket $detail_tiket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(detail_tiket $detail_tiket)
    {
        //
    }

    public function generateQr($id)
    {
        $detail  = DetailTiket::findOrFail($id);
        $scanUrl = route('detail-tiket.scan', ['id' => $detail->id]);

        return view('detail_tiket.qr', [
            'qr'     => QrCode::size(300)->generate($scanUrl),
            'detail' => $detail,
        ]);
    }

    // Scan QR dan update status
    public function scanQr($id)
    {
        $detail = DetailTiket::findOrFail($id);

        if ($detail->status !== 'Belum Digunakan') {
            return response("Tiket sudah digunakan atau kadaluwarsa.", 400);
        }

        $detail->status = 'Sudah Digunakan';
        $detail->save();

        return response("Tiket berhasil diverifikasi!", 200);
    }
}
