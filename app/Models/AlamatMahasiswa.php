<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlamatMahasiswa extends Model
{
    protected $table = 'alamat_mahasiswa';
    protected $fillable = ['mahasiswa_id', 'alamat', 'kota', 'provinsi', 'kode_pos'];

    // Relasi balik ke Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}