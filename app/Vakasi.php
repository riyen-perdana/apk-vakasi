<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Vakasi extends Model
{
    use HasFactory;
    protected $table = 'vakasi';
    public $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id_smt',
        'nip_dkn',
        'nm_dkn',
        'nip_ppk',
        'nm_ppk',
        'nip_bp',
        'nm_bp',
        'nip_ppk_rm',
        'nm_ppk_rm',
        'nip_bpp_rm',
        'nm_bpp_rm'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function semester()
    {
        return $this->hasOne('App\Semester','id_smt');
    }

}
