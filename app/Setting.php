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
    public $incrementing = false;

    protected $fillable = [
        'fungsional',
        'a_ajr',
        'a_soal',
        'a_aws',
        'a_krk'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function fungsional()
    {
        return $this->belongsTo('App\Fungsional','fungsional','id');
    }
}

