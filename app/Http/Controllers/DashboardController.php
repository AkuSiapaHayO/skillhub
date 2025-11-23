<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\Kelas;
use App\Models\Pendaftaran;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPeserta = Peserta::count();
        $totalKelas = Kelas::count();
        $totalPendaftaran = Pendaftaran::count();

        $kelasPopuler = Kelas::withCount('pesertas')
            ->orderBy('pesertas_count', 'desc')
            ->first();

        $pendaftaranTerbaru = Pendaftaran::with(['peserta', 'kelas'])
            ->latest('created_at')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalPeserta',
            'totalKelas',
            'totalPendaftaran',
            'kelasPopuler',
            'pendaftaranTerbaru'
        ));
    }
}
