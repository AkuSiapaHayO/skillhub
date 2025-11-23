@extends('layouts.app')

@section('title', 'Edit Data Kelas')

@section('content')
    <div class="max-w-2xl mx-auto">

        <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Kelas -->
            <div class="mb-4">
                <label for="nama_kelas" class="block text-gray-700 text-sm font-bold mb-2">Nama Kelas</label>
                <input type="text" name="nama_kelas" id="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}"
                    required
                    class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>

            <!-- Instruktur -->
            <div class="mb-4">
                <label for="instruktur" class="block text-gray-700 text-sm font-bold mb-2">Nama Instruktur</label>
                <input type="text" name="instruktur" id="instruktur" value="{{ old('instruktur', $kelas->instruktur) }}"
                    required
                    class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>

            <!-- Deskripsi -->
            <div class="mb-6">
                <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Singkat</label>
                <textarea name="deskripsi" id="deskripsi" rows="4"
                    class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">{{ old('deskripsi', $kelas->deskripsi) }}</textarea>
            </div>

            <!-- Tombol -->
            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('kelas.index') }}" class="text-gray-500 hover:text-gray-700 font-medium">
                    Batal
                </a>
                <button type="submit"
                    class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection
