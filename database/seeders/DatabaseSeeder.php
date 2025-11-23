<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peserta;
use App\Models\Kelas;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $pd = Kelas::create([
            'nama_kelas' => 'Pemrograman Dasar',
            'instruktur' => 'Budi Santoso',
            'deskripsi' => 'Mempelajari logika dasar algoritma dan coding.'
        ]);

        $dg = Kelas::create([
            'nama_kelas' => 'Desain Grafis',
            'instruktur' => 'Siti Aminah',
            'deskripsi' => 'Belajar membuat aset visual menggunakan tools desain.'
        ]);

        $ev = Kelas::create([
            'nama_kelas' => 'Editing Video',
            'instruktur' => 'Joko Anwar',
            'deskripsi' => 'Teknik memotong dan menggabungkan video secara sinematik.'
        ]);

        $ps = Kelas::create([
            'nama_kelas' => 'Public Speaking',
            'instruktur' => 'Merry Riana',
            'deskripsi' => 'Meningkatkan kepercayaan diri berbicara di depan umum.'
        ]);

        $fk = Kelas::create([
            'nama_kelas' => 'Fisika Kuantum',
            'instruktur' => 'Albert Einstein',
            'deskripsi' => 'Mempelajari perilaku materi dan energi pada skala atom.'
        ]);

        $kelasAktif = collect([$pd, $dg, $ev, $ps]);

        $semuaPeserta = Peserta::factory(70)->create();

        $batch4Kelas = $semuaPeserta->splice(0, 5);
        foreach ($batch4Kelas as $peserta) {
            $peserta->kelas()->attach($kelasAktif->pluck('id'), ['tanggal_daftar' => now()]);
        }

        $batch3Kelas = $semuaPeserta->splice(0, 10);
        foreach ($batch3Kelas as $peserta) {
            $kelasAcak = $kelasAktif->random(3)->pluck('id');
            $peserta->kelas()->attach($kelasAcak, ['tanggal_daftar' => now()]);
        }

        $batch2Kelas = $semuaPeserta->splice(0, 15);
        foreach ($batch2Kelas as $peserta) {
            $kelasAcak = $kelasAktif->random(2)->pluck('id');
            $peserta->kelas()->attach($kelasAcak, ['tanggal_daftar' => now()]);
        }

        $batch1Kelas = $semuaPeserta->splice(0, 35);
        foreach ($batch1Kelas as $peserta) {
            $kelasAcak = $kelasAktif->random(1)->pluck('id');
            $peserta->kelas()->attach($kelasAcak, ['tanggal_daftar' => now()]);
        }
    }
}
