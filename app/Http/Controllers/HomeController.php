<?php
namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Hitung jumlah event yang telah dibuat
        $eventCount = Event::count();

        // Hitung jumlah tiket yang terjual (misalnya status 'Sudah Bayar')
        $tiketTerjual = Pemesanan::where('status', 'Sudah Bayar')->sum('kuantitas');

        // Hitung total pendapatan (misalnya total harga tiket yang terjual)
        $totalPendapatan = Pemesanan::where('status', 'Sudah Bayar')->sum('total_harga');

        // Hitung jumlah user
        $userCount = User::count();

        return view('home', compact('eventCount', 'tiketTerjual', 'totalPendapatan', 'userCount'));
    }
}
