<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class durasiM extends Model
{
    use HasFactory;
    protected $table = 'durasi';
    protected $primaryKey = 'iddurasi';
    protected $guarded = [];

}
