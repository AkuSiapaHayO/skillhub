<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use App\Models\Pendaftaran;

class Peserta extends Model
{
    protected $fillable = ['nama', 'email', 'nomor_telepon', 'alamat'];

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class);
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'pendaftaran', 'peserta_id', 'kelas_id')
            ->withPivot('id', 'tanggal_daftar')
            ->withTimestamps();
    }
}
