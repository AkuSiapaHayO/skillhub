@extends('layouts.app')

@section('title', 'Detail Kelas')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Kolom Kiri: Informasi Kelas -->
        <div class="md:col-span-1">
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 sticky top-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Informasi Kelas</h3>

                <div class="mb-4">
                    <span class="block text-xs text-gray-500 uppercase tracking-wide">Nama Kelas</span>
                    <span class="block text-gray-800 font-bold text-xl">{{ $kelas->nama_kelas }}</span>
                </div>

                <div class="mb-4">
                    <span class="block text-xs text-gray-500 uppercase tracking-wide">Instruktur</span>
                    <span class="block text-gray-800 font-medium">{{ $kelas->instruktur }}</span>
                </div>

                <div class="mb-6">
                    <span class="block text-xs text-gray-500 uppercase tracking-wide">Deskripsi</span>
                    <p class="text-gray-700 text-sm leading-relaxed mt-1">
                        {{ $kelas->deskripsi ?: 'Tidak ada deskripsi.' }}
                    </p>
                </div>

                <div class="flex flex-col space-y-2">
                    <a href="{{ route('kelas.edit', $kelas->id) }}"
                        class="w-full text-center bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded">
                        Edit Kelas
                    </a>
                    <a href="{{ route('kelas.index') }}"
                        class="w-full text-center border border-gray-300 text-gray-600 hover:bg-gray-100 font-bold py-2 px-4 rounded">
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Daftar Peserta -->
        <div class="md:col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Peserta Terdaftar</h3>
                <a href="{{ route('pendaftaran.create', ['kelas_id' => $kelas->id]) }}"
                    class="text-sm bg-blue-600 hover:bg-blue-700 text-white py-2 px-3 rounded shadow">
                    + Daftarkan Peserta
                </a>
            </div>

            @if ($kelas->pesertas->isEmpty())
                <div class="bg-blue-50 border-l-4 border-blue-400 p-4 text-blue-700" role="alert">
                    <p>Belum ada peserta yang mendaftar di kelas ini.</p>
                </div>
            @else
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Peserta</th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email</th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal Daftar</th>
                                <th class="py-3 px-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($kelas->pesertas as $p)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4 text-sm font-medium text-gray-900">{{ $p->nama }}</td>
                                    <td class="py-3 px-4 text-sm text-gray-500">{{ $p->email }}</td>
                                    <td class="py-3 px-4 text-sm text-gray-500">{{ $p->pivot->tanggal_daftar }}</td>
                                    <td class="py-3 px-4 text-right text-sm font-medium">
                                        <a href="{{ route('peserta.show', $p->id) }}"
                                            class="text-blue-600 hover:text-blue-900">Lihat</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>
@endsection
