@extends('layouts.app')

@section('title', 'Tambah Pendaftaran Baru')

@section('content')
    <div class="max-w-2xl mx-auto">

        <form action="{{ route('pendaftaran.store') }}" method="POST">
            @csrf

            <!-- Pilih Peserta -->
            <div class="mb-4">
                <label for="peserta_id" class="block text-gray-700 text-sm font-bold mb-2">Pilih Peserta</label>
                <select name="peserta_id" id="peserta_id" required
                    class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="">-- Cari nama peserta --</option>
                    @foreach ($pesertas as $peserta)
                        <option value="{{ $peserta->id }}" @if ($selectedPeserta == $peserta->id) selected @endif>
                            {{ $peserta->nama }} ({{ $peserta->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Pilih Kelas -->
            <div class="mb-4">
                <label for="kelas_id" class="block text-gray-700 text-sm font-bold mb-2">Pilih Kelas</label>
                <select name="kelas_id" id="kelas_id" required
                    class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="">-- Cari kelas --</option>
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id }}" @if ($selectedKelas == $k->id) selected @endif>
                            {{ $k->nama_kelas }} (Instruktur: {{ $k->instruktur }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tanggal Daftar -->
            <div class="mb-6">
                <label for="tanggal_daftar" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Pendaftaran</label>
                <input type="date" name="tanggal_daftar" id="tanggal_daftar" value="{{ date('Y-m-d') }}"
                    class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('pendaftaran.index') }}" class="text-gray-500 hover:text-gray-700 font-medium">
                    Batal
                </a>
                <button type="submit"
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Simpan Pendaftaran
                </button>
            </div>
        </form>
    </div>
@endsection
