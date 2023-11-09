<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Fungsional extends Model
{
    use HasFactory;
    protected $table = 'fungsional';
    public $incrementing = 'false';
    public $keyType = 'string';
    protected $fillable = ['jbtn_fungsional'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function dosen()
    {
        return $this->hasMany('App\Dosen','fungsional');
    }
}
