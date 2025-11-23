<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesertas = Peserta::paginate(10);

        return view('peserta.index', compact('pesertas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('peserta.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'=> 'required',
            'email'=> 'required|email|unique:pesertas,email',
            'nomor_telepon'=> 'nullable',
            'alamat'=> 'nullable',
        ]);

        Peserta::create([
            'nama'=> $request->nama,
            'email'=> $request->email,
            'nomor_telepon'=> $request->nomor_telepon,
            'alamat'=> $request->alamat,
        ]);

        return redirect()->route('peserta.index')->with('success','Peserta berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $peserta = Peserta::findOrFail($id);
        return view('peserta.show', compact('peserta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $peserta = Peserta::findOrFail($id);
        return view('peserta.edit', compact('peserta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $peserta = Peserta::findOrFail($id);

        $request->validate([
            'nama'=> 'required',
            'email'=> 'required|email|unique:pesertas,email,' . $peserta->id . ',id',
            'nomor_telepon'=> 'nullable',
            'alamat' => 'nullable',
        ]);

        $peserta->update([
            'nama'=> $request->nama,
            'email'=> $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('peserta.index')->with('success','Peserta berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $peserta = Peserta::findOrFail($id);
        $peserta->delete();

        return redirect()->route('peserta.index')->with('success','Peserta berhasil dihapus');
    }
}
