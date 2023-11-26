<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $table = 'semester';
    public $incrementing = false;
    protected $primaryKey = 'id_smt';
    protected $keyType = 'string';

    protected $fillable = [
        'id_smt',
        'nm_semester',
        'a_periode_aktif'
    ];
}
