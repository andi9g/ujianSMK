<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class soalM extends Model
{
    use HasFactory;
    protected $table = 'soal';
    protected $primaryKey = 'idsoal';
    protected $guarded = ["jam"];
}
