<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Peserta;
use App\Models\Kelas;
use App\Models\Pendaftaran;

class PendaftaranTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function dapat_mencatat_pendaftaran_peserta_ke_kelas()
    {
        // Soal: Mencatat pendaftaran satu peserta ke satu atau lebih kelas
        $peserta = Peserta::factory()->create();
        $kelas = Kelas::factory()->create();

        $response = $this->post(route('pendaftaran.store'), [
            'peserta_id' => $peserta->id,
            'kelas_id' => $kelas->id,
            'tanggal_daftar' => date('Y-m-d'),
        ]);

        $response->assertRedirect(route('pendaftaran.index'));

        // Cek di tabel pendaftaran apakah data masuk
        $this->assertDatabaseHas('pendaftaran', [
            'peserta_id' => $peserta->id,
            'kelas_id' => $kelas->id,
        ]);
    }

    /** @test */
    public function dapat_menampilkan_daftar_kelas_yang_diikuti_peserta()
    {
        // Soal: Menampilkan daftar kelas yang diikuti oleh seorang peserta tertentu
        // Logika: Kita buka halaman Detail Peserta, harusnya ada nama kelas disitu.

        $peserta = Peserta::factory()->create();
        $kelas = Kelas::factory()->create(['nama_kelas' => 'Kelas Spesial PHP']);

        // Daftarkan manual lewat factory/attach
        $peserta->kelas()->attach($kelas->id, ['tanggal_daftar' => now()]);

        // Buka halaman detail peserta
        $response = $this->get(route('peserta.show', $peserta->id));

        $response->assertStatus(200);
        // Pastikan nama kelas muncul di halaman detail peserta
        $response->assertSee('Kelas Spesial PHP');
    }

    /** @test */
    public function dapat_menampilkan_daftar_peserta_pada_kelas_tertentu()
    {
        // Soal: Menampilkan daftar peserta yang terdaftar pada suatu kelas tertentu
        // Logika: Kita buka halaman Detail Kelas, harusnya ada nama peserta disitu.

        $kelas = Kelas::factory()->create();
        $peserta = Peserta::factory()->create(['nama' => 'Budi Santoso']);

        // Daftarkan
        $kelas->pesertas()->attach($peserta->id, ['tanggal_daftar' => now()]);

        // Buka halaman detail kelas
        $response = $this->get(route('kelas.show', $kelas->id));

        $response->assertStatus(200);
        // Pastikan nama peserta muncul di halaman detail kelas
        $response->assertSee('Budi Santoso');
    }

    /** @test */
    public function dapat_menghapus_pendaftaran()
    {
        // Soal: Menghapus pendaftaran (pembatalan peserta)
        $peserta = Peserta::factory()->create();
        $kelas = Kelas::factory()->create();

        // Buat data pendaftaran dulu
        $pendaftaran = Pendaftaran::create([
            'peserta_id' => $peserta->id,
            'kelas_id' => $kelas->id,
            'tanggal_daftar' => now(),
        ]);

        // Lakukan penghapusan
        $response = $this->delete(route('pendaftaran.destroy', $pendaftaran->id));

        $response->assertRedirect(route('pendaftaran.index'));

        // Pastikan data hilang dari database
        $this->assertDatabaseMissing('pendaftaran', ['id' => $pendaftaran->id]);
    }
}
