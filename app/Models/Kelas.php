<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Peserta;
use App\Models\Pendaftaran;

class Kelas extends Model
{
    use HasFactory;

    protected $table = "kelas";

    protected $fillable = ['nama_kelas', 'deskripsi', 'instruktur'];

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class);
    }

    public function pesertas()
    {
        return $this->belongsToMany(Peserta::class, 'pendaftaran', 'kelas_id', 'peserta_id')
            ->withPivot('id', 'tanggal_daftar')
            ->withTimestamps();
    }
}
