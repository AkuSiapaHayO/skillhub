<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use App\Models\Peserta;

class Pendaftaran extends Model
{
    protected $table = "pendaftaran";

    protected $fillable = ["peserta_id","kelas_id","tanggal_daftar"];

    public function peserta() {
        return $this->belongsTo(Peserta::class);
    }

    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }
}
