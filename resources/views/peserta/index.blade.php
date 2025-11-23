@extends('layouts.app')

@section('title', 'Daftar Peserta')

@section('content')

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-gray-600">Kelola data peserta</h2>
        <a href="{{ route('peserta.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
            + Tambah Peserta
        </a>
    </div>

    @if ($pesertas->isEmpty())
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 text-yellow-700">
            <p>Belum ada peserta.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Nama</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($pesertas as $peserta)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-6 text-left whitespace-nowrap font-bold">{{ $peserta->id }}</td>
                            <td class="py-3 px-6 text-left font-medium">{{ $peserta->nama }}</td>
                            <td class="py-3 px-6 text-left">{{ $peserta->email }}</td>
                            <td class="py-3 px-6 text-center space-x-2">
                                <a href="{{ route('peserta.show', $peserta->id) }}"
                                    class="text-blue-500 hover:text-blue-700 font-bold">Detail</a>
                                <span class="text-gray-300">|</span>
                                <a href="{{ route('peserta.edit', $peserta->id) }}"
                                    class="text-yellow-500 hover:text-yellow-700 font-bold">Edit</a>
                                <span class="text-gray-300">|</span>
                                <form action="{{ route('peserta.destroy', $peserta->id) }}" method="POST" class="inline-block"
                                    style="display:inline" onsubmit="return confirm('Yakin hapus?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-bold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $pesertas->links() }}
            </div>

        </div>

    @endif
@endsection
