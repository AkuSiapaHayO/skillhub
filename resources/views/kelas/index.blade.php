@extends('layouts.app')

@section('title', 'Daftar Kelas')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-gray-600">Kelola data kelas pelatihan</h2>
        <a href="{{ route('kelas.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
            + Tambah Kelas
        </a>
    </div>

    @if ($kelas->isEmpty())
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 text-yellow-700">
            <p>Belum ada kelas yang tersedia.</p>
        </div>
    @else
        <div class="">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Nama Kelas</th>
                        <th class="py-3 px-6 text-left">Instruktur</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($kelas as $k)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-6 text-left whitespace-nowrap font-bold">{{ $k->id }}</td>
                            <td class="py-3 px-6 text-left font-medium">{{ $k->nama_kelas }}</td>
                            <td class="py-3 px-6 text-left">{{ $k->instruktur }}</td>
                            <td class="py-3 px-6 text-center space-x-2">
                                <a href="{{ route('kelas.show', $k->id) }}"
                                    class="text-blue-500 hover:text-blue-700 font-bold">Detail</a>
                                <span class="text-gray-300">|</span>
                                <a href="{{ route('kelas.edit', $k->id) }}"
                                    class="text-yellow-500 hover:text-yellow-700 font-bold">Edit</a>
                                <span class="text-gray-300">|</span>
                                <form action="{{ route('kelas.destroy', $k->id) }}" method="POST" class="inline-block"
                                    onsubmit="return confirm('Yakin hapus kelas ini? Semua data pendaftaran terkait juga akan terhapus.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-bold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
