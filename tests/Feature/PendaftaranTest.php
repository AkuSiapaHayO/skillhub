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
        $peserta = Peserta::factory()->create();
        $kelas = Kelas::factory()->create();

        $response = $this->post(route('pendaftaran.store'), [
            'peserta_id' => $peserta->id,
            'kelas_id' => $kelas->id,
            'tanggal_daftar' => date('Y-m-d'),
        ]);

        $response->assertRedirect(route('pendaftaran.index'));

        $this->assertDatabaseHas('pendaftaran', [
            'peserta_id' => $peserta->id,
            'kelas_id' => $kelas->id,
        ]);
    }

    /** @test */
    public function dapat_menampilkan_daftar_kelas_yang_diikuti_peserta()
    {
        $peserta = Peserta::factory()->create();
        $kelas = Kelas::factory()->create(['nama_kelas' => 'Kelas Spesial PHP']);

        $peserta->kelas()->attach($kelas->id, ['tanggal_daftar' => now()]);

        $response = $this->get(route('peserta.show', $peserta->id));

        $response->assertStatus(200);
        $response->assertSee('Kelas Spesial PHP');
    }

    /** @test */
    public function dapat_menampilkan_daftar_peserta_pada_kelas_tertentu()
    {
        $kelas = Kelas::factory()->create();
        $peserta = Peserta::factory()->create(['nama' => 'Budi Santoso']);

        $kelas->pesertas()->attach($peserta->id, ['tanggal_daftar' => now()]);

        $response = $this->get(route('kelas.show', $kelas->id));

        $response->assertStatus(200);
        $response->assertSee('Budi Santoso');
    }

    /** @test */
    public function dapat_menghapus_pendaftaran()
    {
        $peserta = Peserta::factory()->create();
        $kelas = Kelas::factory()->create();

        $pendaftaran = Pendaftaran::create([
            'peserta_id' => $peserta->id,
            'kelas_id' => $kelas->id,
            'tanggal_daftar' => now(),
        ]);

        $response = $this->delete(route('pendaftaran.destroy', $pendaftaran->id));

        $response->assertRedirect(route('pendaftaran.index'));

        $this->assertDatabaseMissing('pendaftaran', ['id' => $pendaftaran->id]);
    }
}
