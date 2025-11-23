@extends('layouts.app')

@section('title', 'Tambah Peserta Baru')

@section('content')
    <div class="max-w-2xl mx-auto">

        <form action="{{ route('peserta.store') }}" method="POST">
            @csrf

            <!-- Nama -->
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                    class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Masukkan nama peserta">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="contoh@email.com">
            </div>

            <!-- Nomor Telepon -->
            <div class="mb-4">
                <label for="nomor_telepon" class="block text-gray-700 text-sm font-bold mb-2">Nomor Telepon</label>
                <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon') }}"
                    class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="0812...">
            </div>

            <!-- Alamat -->
            <div class="mb-6">
                <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">Alamat Lengkap</label>
                <textarea name="alamat" id="alamat" rows="3"
                    class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Masukkan alamat domisili">{{ old('alamat') }}</textarea>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('peserta.index') }}" class="text-gray-500 hover:text-gray-700 font-medium">
                    Batal
                </a>
                <button type="submit"
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Simpan Peserta
                </button>
            </div>
        </form>
    </div>
@endsection
