<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ruanganM extends Model
{
    use HasFactory;
    protected $table = 'ruangan';
    protected $primaryKey = 'idruangan';
    protected $guarded = [];
    protected $connection = "mysql";
    
    // public function urutan()
    // {
    //     return $this->setConnection('mysql')->belongsTo(urutanM::class, 'nisn', 'nisn');
    // }

    public function siswa()
    {
        return $this->hasOne(siswaM::class, 'nisn','nisn');
    }
}
