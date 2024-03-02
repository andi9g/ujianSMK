<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class urutanM extends Model
{
    use HasFactory;
    protected $table = 'urutan';
    protected $primaryKey = 'idurutan';
    protected $guarded = [];
    protected $connection = "mysql";
    
    public function ujian()
    {
        return $this->hasOne(ujianM::class, 'idujian','idujian');
    }
    public function ruangan()
    {
        return $this->hasOne(ruanganM::class, 'idruangan','idruangan');
    }
    public function siswa()
    {
        return $this->hasOne(siswaM::class, 'nisn','nisn');
    }
}
