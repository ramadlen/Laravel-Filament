<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suhu extends Model
{
protected $fillable = [
    "kelembapan",
    "suhu",
    "tanggal_dan_waktu_pencatatan",
];
}
