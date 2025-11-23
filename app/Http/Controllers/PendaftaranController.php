<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Kelas;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendaftaran = Pendaftaran::with(['peserta', 'kelas'])->get();

        return view('pendaftaran.index', compact('pendaftaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $pesertas = Peserta::all();
        $kelas = Kelas::all();

        $selectedPeserta = $request->query('peserta_id');
        $selectedKelas = $request->query('kelas_id');

        return view('pendaftaran.create', compact('pesertas', 'kelas', 'selectedPeserta', 'selectedKelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'peserta_id' => 'required|exists:pesertas,id',
            'kelas_id' => [
                'required',
                'exists:kelas,id',
                Rule::unique('pendaftaran')->where(function ($query) use ($request) {
                    return $query->where('peserta_id', $request->peserta_id)
                        ->where('kelas_id', $request->kelas_id);
                }),
            ],
            'tanggal_daftar' => 'nullable|date'
        ], [
            'kelas_id.unique' => 'Peserta ini sudah terdaftar di kelas tersebut.'
        ]);

        Pendaftaran::create([
            'peserta_id' => $request->peserta_id,
            'kelas_id' => $request->kelas_id,
            'tanggal_daftar' => $request->tanggal_daftar ?? date('Y-m-d'),
        ]);

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->delete();

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil dihapus');
    }
}
