<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('user', ['user' => $user]);
    }

    public function pdf()
    {
        $users = User::all();
        $pdf = PDF::loadView('user.pdf', compact('users'));
        return $pdf->download('Laporan.pdf');
    }

}
