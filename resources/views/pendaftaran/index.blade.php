@extends('layouts.app')

@section('title', 'Daftar Pendaftaran')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-gray-600">Kelola data pendaftaran peserta ke kelas</h2>
        <a href="{{ route('pendaftaran.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
            + Tambah Pendaftaran
        </a>
    </div>

    @if ($pendaftaran->isEmpty())
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 text-yellow-700">
            <p>Belum ada data pendaftaran saat ini.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Nama Peserta</th>
                        <th class="py-3 px-6 text-left">Kelas</th>
                        <th class="py-3 px-6 text-left">Tanggal Daftar</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($pendaftaran as $p)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-6 text-left whitespace-nowrap font-bold">{{ $p->id }}</td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span class="font-medium">{{ $p->peserta->nama }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <span class="bg-blue-100 text-blue-800 py-1 px-3 rounded-full text-xs">
                                    {{ $p->kelas->nama_kelas }}
                                </span>
                            </td>
                            <td class="py-3 px-6 text-left">{{ $p->tanggal_daftar }}</td>
                            <td class="py-3 px-6 text-center">
                                <form action="{{ route('pendaftaran.destroy', $p->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pendaftaran ini?');"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-500 hover:text-red-700 font-bold transform hover:scale-110 transition">
                                        <span class="flex items-center gap-1">Hapus</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $pendaftaran->links() }}
            </div>
        </div>
    @endif
@endsection
