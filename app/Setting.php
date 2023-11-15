<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'setting';
    public $keyType = 'string';
    public $incrementing = 'false';

    protected $fillable = [
        'koreksi',
        'soal',
        'mengawas',
        'pph_21',
        'is_aktif'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }
}

