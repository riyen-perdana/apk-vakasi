<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Perangkat extends Model
{
    use HasFactory;
    protected $table = 'perangkat';
    public $keyType = 'string';
    public $incrementing = 'false';

    protected $fillable = [
        'nip',
        'nama',
        'glr_dpn',
        'glr_blk',
        'is_jabatan',
        'is_plt',
        'is_aktif',
        'awal_jabatan',
        'akhir_jabatan'
    ];

    /**
    * The Custom attributes that should add to JSON response.
    *
    * @var array
    */
    protected $appends = ['nama_perangkat'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = ucwords($value);
    }

    /**
     * Get Nama Full Dosen Luar Biasa
     * @return void
     * 
     */
    public function getNamaPerangkatAttribute()
    {
        if ($this->glr_dpn == null || strlen(trim($this->glr_dpn) == 0)) 
      	{
        	return "{$this->name}.{$this->glr_blk}";
      	} elseif ($this->glr_blk == null || strlen(trim($this->glr_blk) == 0))
      	{
        	return "{$this->glr_dpn}.{$this->name}";
      	} elseif (($this->glr_dpn != null || strlen(trim($this->glr_dpn) != 0)) && ($this->glr_blk != null || strlen(trim($this->glr_blk) != 0))) 
      	{
        	return "{$this->glr_dpn}.{$this->name}.{$this->glr_blk}";
      	} else 
      	{
        	return "{$this->name}";
      	}
    }
}
