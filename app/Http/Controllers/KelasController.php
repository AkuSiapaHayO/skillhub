<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::paginate(10);
        return view("kelas.index", compact("kelas"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("kelas.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'instruktur' => 'required',
            'deskripsi' => 'nullable',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'instruktur' => $request->instruktur,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('kelas.show', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('kelas.edit', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'nama_kelas' => 'required',
            'instruktur' => 'required',
            'deskripsi' => 'nullable',
        ]);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'instruktur' => $request->instruktur,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('kelas.index')->with('success','Kelas berhasil dihapus');
    }
}
