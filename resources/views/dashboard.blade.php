<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <!-- Card 1 -->
        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded shadow">
            <div class="font-bold text-xl mb-2">Total Peserta</div>
            <div class="text-3xl">{{ $totalPeserta }}</div>
        </div>

        <!-- Card 2 -->
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow">
            <div class="font-bold text-xl mb-2">Total Kelas</div>
            <div class="text-3xl">{{ $totalKelas }}</div>
        </div>

        <!-- Card 3 -->
        <div class="bg-purple-100 border-l-4 border-purple-500 text-purple-700 p-4 rounded shadow">
            <div class="font-bold text-xl mb-2">Pendaftaran</div>
            <div class="text-3xl">{{ $totalPendaftaran }}</div>
        </div>

        <!-- Card 4 -->
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded shadow">
            <div class="font-bold text-xl mb-2">Kelas Populer</div>
            <div class="text-lg truncate font-semibold">
                {{ $kelasPopuler ? $kelasPopuler->nama_kelas : '-' }}
            </div>
            <div class="text-sm">
                {{ $kelasPopuler ? $kelasPopuler->pesertas_count . ' Peserta' : '' }}
            </div>
        </div>
    </div>

    <!-- Tabel Pendaftaran Terbaru -->
    <h2 class="text-xl font-bold text-gray-800 mb-4">Pendaftaran Terbaru</h2>

    @if ($pendaftaranTerbaru->isEmpty())
        <p class="text-gray-500">Belum ada data pendaftaran.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-2 px-4 border-b text-left">Peserta</th>
                        <th class="py-2 px-4 border-b text-left">Kelas</th>
                        <th class="py-2 px-4 border-b text-left">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendaftaranTerbaru as $p)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b">{{ $p->peserta->nama }}</td>
                            <td class="py-2 px-4 border-b">{{ $p->kelas->nama_kelas }}</td>
                            <td class="py-2 px-4 border-b">{{ $p->tanggal_daftar }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="mt-6 text-right">
        <a href="{{ route('pendaftaran.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Tambah Pendaftaran Baru
        </a>
    </div>
@endsection
