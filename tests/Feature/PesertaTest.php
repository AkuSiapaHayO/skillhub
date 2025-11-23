<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Peserta;

class PesertaTest extends TestCase
{
    use RefreshDatabase; // Wajib: Reset database setiap test

    /** @test */
    public function dapat_menambah_peserta_baru()
    {
        // Soal: Menambah peserta baru
        $data = [
            'nama' => 'Peserta Uji Coba',
            'email' => 'uji@coba.com',
            'nomor_telepon' => '08123456789',
            'alamat' => 'Jl. Testing No. 1',
        ];

        $response = $this->post(route('peserta.store'), $data);

        $response->assertRedirect(route('peserta.index'));
        $this->assertDatabaseHas('pesertas', ['email' => 'uji@coba.com']);
    }

    /** @test */
    public function dapat_menampilkan_daftar_seluruh_peserta()
    {
        // Soal: Menampilkan daftar seluruh peserta
        Peserta::factory(3)->create(); // Buat 3 peserta dummy

        $response = $this->get(route('peserta.index'));

        $response->assertStatus(200);
        $response->assertViewHas('pesertas'); // Pastikan variabel dikirim ke view
    }

    /** @test */
    public function dapat_menampilkan_detail_satu_peserta()
    {
        // Soal: Menampilkan detail satu peserta
        $peserta = Peserta::factory()->create();

        $response = $this->get(route('peserta.show', $peserta->id));

        $response->assertStatus(200);
        $response->assertSee($peserta->nama); // Pastikan nama muncul di layar
        $response->assertSee($peserta->email);
    }

    /** @test */
    public function dapat_mengubah_data_peserta()
    {
        // Soal: Mengubah data peserta
        $peserta = Peserta::factory()->create();

        $updateData = [
            'nama' => 'Nama Berubah',
            'email' => 'berubah@test.com',
            'nomor_telepon' => '0899999',
            'alamat' => 'Alamat Baru',
        ];

        $response = $this->put(route('peserta.update', $peserta->id), $updateData);

        $response->assertRedirect(route('peserta.index'));
        $this->assertDatabaseHas('pesertas', ['email' => 'berubah@test.com']);
    }

    /** @test */
    public function dapat_menghapus_peserta()
    {
        // Soal: Menghapus peserta
        $peserta = Peserta::factory()->create();

        $response = $this->delete(route('peserta.destroy', $peserta->id));

        $response->assertRedirect(route('peserta.index'));
        $this->assertDatabaseMissing('pesertas', ['id' => $peserta->id]);
    }
}
