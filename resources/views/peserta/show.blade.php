@extends('layouts.app')

@section('title', 'Detail Peserta')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Kolom Kiri: Informasi Peserta -->
        <div class="md:col-span-1">
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Profil Peserta</h3>

                <div class="mb-3">
                    <span class="block text-xs text-gray-500 uppercase tracking-wide">Nama</span>
                    <span class="block text-gray-800 font-medium text-lg">{{ $peserta->nama }}</span>
                </div>

                <div class="mb-3">
                    <span class="block text-xs text-gray-500 uppercase tracking-wide">Email</span>
                    <span class="block text-gray-800">{{ $peserta->email }}</span>
                </div>

                <div class="mb-3">
                    <span class="block text-xs text-gray-500 uppercase tracking-wide">Nomor Telepon</span>
                    <span class="block text-gray-800">{{ $peserta->nomor_telepon ?? '-' }}</span>
                </div>

                <div class="mb-6">
                    <span class="block text-xs text-gray-500 uppercase tracking-wide">Alamat</span>
                    <span class="block text-gray-800">{{ $peserta->alamat ?? '-' }}</span>
                </div>

                <div class="flex flex-col space-y-2">
                    <a href="{{ route('peserta.edit', $peserta->id) }}"
                        class="w-full text-center bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded">
                        Edit Profil
                    </a>
                    <a href="{{ route('peserta.index') }}"
                        class="w-full text-center border border-gray-300 text-gray-600 hover:bg-gray-100 font-bold py-2 px-4 rounded">
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Kelas yang Diikuti -->
        <div class="md:col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Kelas yang Diikuti</h3>
                <a href="{{ route('pendaftaran.create', ['peserta_id' => $peserta->id]) }}"
                    class="text-sm bg-blue-600 hover:bg-blue-700 text-white py-2 px-3 rounded shadow">
                    + Daftar Kelas Baru
                </a>
            </div>

            @if ($peserta->kelas->isEmpty())
                <div class="bg-blue-50 border-l-4 border-blue-400 p-4 text-blue-700" role="alert">
                    <p>Peserta ini belum terdaftar di kelas mana pun.</p>
                </div>
            @else
                <div class="grid grid-cols-1 gap-4">
                    @foreach ($peserta->kelas as $k)
                        <div
                            class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition flex justify-between items-center">
                            <div>
                                <h4 class="text-lg font-bold text-gray-800">{{ $k->nama_kelas }}</h4>
                                <p class="text-sm text-gray-600">Instruktur: {{ $k->instruktur }}</p>
                                <p class="text-xs text-gray-400 mt-1">Terdaftar pada: {{ $k->pivot->tanggal_daftar }}</p>
                            </div>
                            <div>
                                <a href="{{ route('kelas.show', $k->id) }}"
                                    class="text-blue-500 hover:text-blue-700 text-sm font-semibold">
                                    Lihat Kelas &rarr;
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
@endsection
