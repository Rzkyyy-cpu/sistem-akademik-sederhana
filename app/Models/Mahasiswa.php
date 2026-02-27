<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $fillable = ['nim', 'nama', 'jurusan'];

    // Relasi ke AlamatMahasiswa
    public function alamat()
    {
        return $this->hasOne(AlamatMahasiswa::class, 'mahasiswa_id');
    }
}