<?php
namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Tiket;
use App\Models\User;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PemesananController extends Controller
{
    public function bayar($id)
    {
        try {
            $pemesanan = Pemesanan::with(['user', 'tiket'])->findOrFail($id);

            // Set konfigurasi midtrans
            Config::$serverKey    = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized  = true;
            Config::$is3ds        = true;

            // Buat array untuk parameter midtrans
            $params = [
                'transaction_details' => [
                    'order_id'     => 'ORDER-' . $pemesanan->id . '-' . time(),
                    'gross_amount' => $pemesanan->total_harga,
                ],
                'customer_details'    => [
                    'first_name' => $pemesanan->user->name,
                    'email'      => $pemesanan->user->email,
                ],
                'item_details'        => [
                    [
                        'id'       => $pemesanan->tiket->id,
                        'price'    => $pemesanan->tiket->harga_tiket,
                        'quantity' => $pemesanan->kuantitas,
                        'name'     => $pemesanan->tiket->event->nama_event . ' - ' . $pemesanan->tiket->jenis_tiket,
                    ],
                ],
            ];

            // Dapatkan Snap Token dari Midtrans
            $snapToken = Snap::getSnapToken($params);

            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function index()
    {
        $pemesanan = Pemesanan::with(['user', 'tiket.event'])->latest()->get();
        return view('pemesanan.index', compact('pemesanan'));
    }

    public function create()
    {
        $user  = User::all();
        $tiket = Tiket::with('event')->get();
        return view('pemesanan.create', compact('user', 'tiket'));
    }

    public function store(Request $request, MidtransService $midtrans)
    {
        $validated = $request->validate([
            'id_user'   => 'required',
            'id_tiket'  => 'required|exists:tikets,id',
            'kuantitas' => 'required|integer|min:1',
        ]);

        $tiket      = Tiket::findOrFail($request->id_tiket);
        $totalHarga = $tiket->harga_tiket * $request->kuantitas;

        // Buat pemesanan
        $pemesanan = Pemesanan::create([
            'id_user'     => $request->id_user,
            'id_tiket'    => $request->id_tiket,
            'kuantitas'   => $request->kuantitas,
            'total_harga' => $totalHarga,
            'status'      => 'Belum Bayar',
        ]);

        // Buat Order ID untuk Midtrans
        $orderId = 'ORDER-' . $pemesanan->id . '-' . time();

        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $totalHarga,
            ],
            'customer_details'    => [
                'first_name' => $pemesanan->user->name,
                'email'      => $pemesanan->user->email,
            ],
        ];

        $snap = $midtrans->createTransaction($params);

        return redirect()->route('pemesanan.index')->with('snap_token', $snap->token);
    }

    public function edit($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $user      = User::all();
        $tiket     = Tiket::all();
        return view('pemesanan.edit', compact('pemesanan', 'user', 'tiket'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_user'     => 'required',
            'id_tiket'    => 'required',
            'kuantitas'   => 'required',
            'total_harga' => 'required',
            'status'      => 'required',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update($validated);

        return redirect()->route('pemesanan.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->delete();

        return redirect()->route('pemesanan.index')->with('success', 'Data berhasil dihapus');
    }

    public function checkout($id_tiket, $kuantitas)
    {
        $tiket = Tiket::findOrFail($id_tiket);

        // Simpan dulu ke pemesanans sebelum lanjut ke view
        $pemesanan = Pemesanan::create([
            'id_user'     => auth()->id(),
            'id_tiket'    => $tiket->id,
            'kuantitas'   => $kuantitas,
            'total_harga' => $tiket->harga_tiket * $kuantitas,
            'status'      => 'pending',
        ]);

        return view('transaksi', compact('tiket', 'kuantitas', 'pemesanan'));
    }
    public function updateStatus(Request $request, $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        $status = $request->status;

        if ($status === 'success') {
            $pemesanan->status = 'Sudah Bayar';
        } elseif ($status === 'pending') {
            $pemesanan->status = 'Menunggu Pembayaran';
        } elseif ($status === 'error') {
            $pemesanan->status = 'Gagal';
        }

        $pemesanan->save();

        return response()->json(['message' => 'Status pemesanan diperbarui.']);
    }

    public function riwayat()
    {
        $riwayat = Pemesanan::with('tiket.event')
            ->where('id_user', auth()->id())
            ->where('status', 'Sudah Bayar')
            ->latest()
            ->get();

        return view('riwayat', compact('riwayat'));
    }

    // public function proses(Request $request)
    // {
    //     try {
    //         $validated = $request->validate([
    //             'tiket_id' => 'required|exists:tikets,id',
    //             'jumlah'   => 'required|integer|min:1',
    //         ]);

    //         if (! auth()->check()) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Silakan login terlebih dahulu',
    //             ], 401);
    //         }

    //         $tiket = Tiket::findOrFail($validated['tiket_id']);

    //         if ($tiket->kuota_tiket < $validated['jumlah']) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Stok tiket tidak mencukupi',
    //             ], 422);
    //         }

    //         $pemesanan = Pemesanan::create([
    //             'id_user'     => auth()->id(),
    //             'id_tiket'    => $tiket->id,
    //             'kuantitas'   => $validated['jumlah'],
    //             'total_harga' => $tiket->harga_tiket * $validated['jumlah'],
    //             'status'      => 'Pending',
    //         ]);

    //         $orderId = 'TRX-' . Str::random(5) . '-' . $pemesanan->id;

    //         // Midtrans configuration
    //         Config::$serverKey    = config('midtrans.server_key');
    //         Config::$isProduction = config('midtrans.is_production');
    //         Config::$isSanitized  = true;
    //         Config::$is3ds        = true;

    //         $transactionDetails = [
    //             'transaction_details' => [
    //                 'order_id'     => $orderId,
    //                 'gross_amount' => $pemesanan->total_harga,
    //             ],
    //             'customer_details'    => [
    //                 'first_name' => auth()->user()->name,
    //                 'email'      => auth()->user()->email,
    //             ],
    //             'item_details'        => [[
    //                 'id'       => $tiket->id,
    //                 'price'    => $tiket->harga_tiket,
    //                 'quantity' => $validated['jumlah'],
    //                 'name'     => $tiket->jenis_tiket,
    //             ]],
    //         ];

    //         $snapToken = Snap::getSnapToken($transactionDetails);

    //         Pembayaran::create([
    //             'pemesanan_id'          => $pemesanan->id,
    //             'status_pembayaran'     => 'pending',
    //             'snap_token'            => $snapToken,
    //             'midtrans_booking_code' => $orderId,
    //             'metode_pembayaran'     => 'midtrans',
    //         ]);

    //         return response()->json([
    //             'success'      => true,
    //             'snap_token'   => $snapToken,
    //             'pemesanan_id' => $pemesanan->id,
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $e->getMessage(),
    //         ], 500);
    //     }
    // }
}
