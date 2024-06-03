<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswaM extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $primaryKey = 'idsiswa';
    protected $connection = 'mysql4';
    protected $guarded = [];

    public function kelas()
    {
        return $this->hasOne(kelasM::class, 'idkelas','idkelas');
    }
    public function gambar()
    {
        return $this->hasOne(gambarM::class, 'nisn','nisn');
    }

    public function jurusan()
    {
        return $this->hasOne(jurusanM::class, 'idjurusan','idjurusan');
    }

    public function urutan()
    {
        return $this->setConnection('mysql')->belongsTo(urutanM::class, 'nisn', 'nisn');
    }
}
