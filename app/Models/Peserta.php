<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Kelas;
use App\Models\Pendaftaran;

class Peserta extends Model
{
    use HasFactory;

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
