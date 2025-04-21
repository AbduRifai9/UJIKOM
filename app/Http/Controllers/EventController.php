<?php
namespace App\Http\Controllers;

use App\Models\event;
use App\Models\lokasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function detail($slug)
    {
        // Ambil event berdasarkan slug + relasi lokasi dan tiket
        $event = Event::with(['lokasi', 'tiket'])->where('slug', $slug)->firstOrFail();

        // Ambil tiket-tiket dari relasi
        $tikets = $event->tiket;

        return view('detail', compact('event', 'tikets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $event  = event::all();
        $lokasi = lokasi::all();
        return view('event.create', compact('event', 'lokasi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_event'      => 'required',
            'deskripsi'       => 'required',
            'tanggal_mulai'   => 'required|date',
            'waktu_mulai'     => 'required',
            'tanggal_selesai' => 'required|date',
            'waktu_selesai'   => 'required',
            'id_lokasi'       => 'required',
            'poster'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Gabungkan tanggal dan waktu dari request
        $startDateTime   = Carbon::parse($request->tanggal_mulai . ' ' . $request->waktu_mulai);
        $endDateTime     = Carbon::parse($request->tanggal_selesai . ' ' . $request->waktu_selesai);
        $currentDateTime = now();

        // Cek apakah lokasi sudah dipakai oleh event lain dalam rentang waktu yang sama
        $conflict = DB::table('events')
            ->where('id_lokasi', $request->id_lokasi)
            ->where(function ($query) use ($startDateTime, $endDateTime) {
                $query->whereBetween(DB::raw("CONCAT(tanggal_mulai, ' ', waktu_mulai)"), [$startDateTime, $endDateTime])
                    ->orWhereBetween(DB::raw("CONCAT(tanggal_selesai, ' ', waktu_selesai)"), [$startDateTime, $endDateTime])
                    ->orWhere(function ($q) use ($startDateTime, $endDateTime) {
                        $q->where(DB::raw("CONCAT(tanggal_mulai, ' ', waktu_mulai)"), '<=', $startDateTime)
                            ->where(DB::raw("CONCAT(tanggal_selesai, ' ', waktu_selesai)"), '>=', $endDateTime);
                    });
            })
            ->exists();

        if ($conflict) {
            return redirect()->back()->withInput()->with('error', 'Lokasi sudah digunakan untuk event lain pada waktu tersebut/Gunakan lokasi lain.');
        }

        // Tentukan status berdasarkan waktu
        if ($startDateTime > $currentDateTime) {
            $status = 'Segera'; // Belum dimulai
        } elseif ($startDateTime <= $currentDateTime && $endDateTime >= $currentDateTime) {
            $status = 'Sedang Berlangsung';
        } else {
            $status = 'Selesai';
        }

        // Simpan data event
        $event             = new event();
        $event->nama_event = $request->nama_event;
        $event->deskripsi  = $request->deskripsi;

        // Upload poster
        if ($request->hasFile('poster')) {
            $img  = $request->file('poster');
            $name = rand(1000, 9999) . '_' . $img->getClientOriginalName();
            $img->move(public_path('images/event'), $name);
            $event->poster = $name;
        }

        $event->tanggal_mulai   = $request->tanggal_mulai;
        $event->waktu_mulai     = $request->waktu_mulai;
        $event->tanggal_selesai = $request->tanggal_selesai;
        $event->waktu_selesai   = $request->waktu_selesai;
        $event->id_lokasi       = $request->id_lokasi;
        $event->status          = $status;

        $event->save();

        return redirect()->route('event.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event  = event::FindOrFail($id);
        $lokasi = lokasi::all();
        return view('event.show', compact('event', 'lokasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lokasi = lokasi::all();
        $event  = event::FindOrFail($id);
        return view('event.edit', compact('event', 'lokasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_event'      => 'required',
            'deskripsi'       => 'required',
            'tanggal_mulai'   => 'required|date',
            'waktu_mulai'     => 'required',
            'tanggal_selesai' => 'required|date',
            'waktu_selesai'   => 'required',
            'id_lokasi'       => 'required|exists:lokasis,id',
        ]);

        // Gabungkan tanggal dan waktu
        $startDateTime   = Carbon::parse("{$request->tanggal_mulai} {$request->waktu_mulai}");
        $endDateTime     = Carbon::parse("{$request->tanggal_selesai} {$request->waktu_selesai}");
        $currentDateTime = now();

        // Cek konflik jadwal dengan event lain
        $conflict = DB::table('events')
            ->where('id_lokasi', $request->id_lokasi)
            ->where('id', '!=', $id) // Abaikan dirinya sendiri
            ->where(function ($query) use ($startDateTime, $endDateTime) {
                $query->whereBetween(DB::raw("CONCAT(tanggal_mulai, ' ', waktu_mulai)"), [$startDateTime, $endDateTime])
                    ->orWhereBetween(DB::raw("CONCAT(tanggal_selesai, ' ', waktu_selesai)"), [$startDateTime, $endDateTime])
                    ->orWhere(function ($q) use ($startDateTime, $endDateTime) {
                        $q->where(DB::raw("CONCAT(tanggal_mulai, ' ', waktu_mulai)"), '<=', $startDateTime)
                            ->where(DB::raw("CONCAT(tanggal_selesai, ' ', waktu_selesai)"), '>=', $endDateTime);
                    });
            })
            ->exists();

        if ($conflict) {
            return redirect()->back()->withInput()->with('error', 'Lokasi sudah digunakan untuk event lain pada waktu tersebut. Gunakan lokasi lain.');
        }

        // Tentukan status event
        if ($startDateTime > $currentDateTime) {
            $status = 'Segera';
        } elseif ($startDateTime <= $currentDateTime && $endDateTime >= $currentDateTime) {
            $status = 'Sedang Berlangsung';
        } else {
            $status = 'Selesai';
        }

        $event = Event::findOrFail($id);

        // Update data event
        $event->nama_event      = $request->nama_event;
        $event->deskripsi       = $request->deskripsi;
        $event->tanggal_mulai   = $request->tanggal_mulai;
        $event->waktu_mulai     = $request->waktu_mulai;
        $event->tanggal_selesai = $request->tanggal_selesai;
        $event->waktu_selesai   = $request->waktu_selesai;
        $event->id_lokasi       = $request->id_lokasi;
        $event->status          = $status;

        // Jika ada file poster baru
        if ($request->hasFile('poster')) {
            $img  = $request->file('poster');
            $name = rand(1000, 9999) . '_' . $img->getClientOriginalName();
            $img->move(public_path('images/event'), $name);
            $event->poster = $name;
        }

        $event->save();

        return redirect()->route('event.index')->with('success', 'Event berhasil diperbarui.');
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
