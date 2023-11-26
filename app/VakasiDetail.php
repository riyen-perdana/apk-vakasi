<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VakasiDetail extends Model
{
    use HasFactory;
    protected $table = 'vakasi_detail';
    public $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id_vakasi',
        'id_dsn',
        'id_kls',
        'kode_mk',
        'kd_prd',
        'sks_mk',
        'kode_ruangan',
        'hari',
        'lokal',
        'mhs'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function vakasi()
    {
        return $this->belongsTo(Vakasi::class,'id_vakasi');
    }

    public function dosenlb()
    {
        return $this->belongsTo(Dosenlb::class,'id_dsn');
    }
}
