<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Kelas;

class KelasTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function dapat_menambah_kelas_baru()
    {
        $data = [
            'nama_kelas' => 'Kelas Laravel Testing',
            'instruktur' => 'Pak Budi',
            'deskripsi' => 'Belajar testing di Laravel',
        ];

        $response = $this->post(route('kelas.store'), $data);

        $response->assertRedirect(route('kelas.index'));
        $this->assertDatabaseHas('kelas', ['nama_kelas' => 'Kelas Laravel Testing']);
    }

    /** @test */
    public function dapat_menampilkan_daftar_seluruh_kelas()
    {
        Kelas::factory(3)->create();

        $response = $this->get(route('kelas.index'));

        $response->assertStatus(200);
        $response->assertViewHas('kelas');
    }

    /** @test */
    public function dapat_menampilkan_detail_satu_kelas()
    {
        $kelas = Kelas::factory()->create();

        $response = $this->get(route('kelas.show', $kelas->id));

        $response->assertStatus(200);
        $response->assertSee($kelas->nama_kelas);
        $response->assertSee($kelas->instruktur);
    }

    /** @test */
    public function dapat_mengubah_data_kelas()
    {
        $kelas = Kelas::factory()->create();

        $updateData = [
            'nama_kelas' => 'Kelas Update',
            'instruktur' => 'Instruktur Baru',
            'deskripsi' => 'Deskripsi Baru',
        ];

        $response = $this->put(route('kelas.update', $kelas->id), $updateData);

        $response->assertRedirect(route('kelas.index'));
        $this->assertDatabaseHas('kelas', ['nama_kelas' => 'Kelas Update']);
    }

    /** @test */
    public function dapat_menghapus_kelas()
    {
        $kelas = Kelas::factory()->create();

        $response = $this->delete(route('kelas.destroy', $kelas->id));

        $response->assertRedirect(route('kelas.index'));
        $this->assertDatabaseMissing('kelas', ['id' => $kelas->id]);
    }
}
