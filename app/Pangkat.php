<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pangkat extends Model
{
    use HasFactory;
    protected $table = 'pangkat';
    public $keyType = 'string';
    public $incrementing = 'false';
    protected $fillable = ['pangkat','golongan'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }
}
