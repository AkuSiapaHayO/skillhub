@extends('layouts.app')

@section('title', 'Edit Data Peserta')

@section('content')
    <div class="max-w-2xl mx-auto">

        <form action="{{ route('peserta.update', $peserta->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $peserta->nama) }}" required
                    class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $peserta->email) }}" required
                    class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>

            <!-- Nomor Telepon -->
            <div class="mb-4">
                <label for="nomor_telepon" class="block text-gray-700 text-sm font-bold mb-2">Nomor Telepon</label>
                <input type="text" name="nomor_telepon" id="nomor_telepon"
                    value="{{ old('nomor_telepon', $peserta->nomor_telepon) }}"
                    class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>

            <!-- Alamat -->
            <div class="mb-6">
                <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">Alamat Lengkap</label>
                <textarea name="alamat" id="alamat" rows="3"
                    class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">{{ old('alamat', $peserta->alamat) }}</textarea>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('peserta.index') }}" class="text-gray-500 hover:text-gray-700 font-medium">
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
