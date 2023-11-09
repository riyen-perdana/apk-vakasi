<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Dosenlb extends Model
{
    use HasFactory;
    protected $table = 'dosenlb';
    public $keyType = 'string';
    public $incrementing = 'false';
    protected $fillable = [
        'nup_nidn',
        'glr_dpn',
        'glr_blk',
        'name',
        'npwp',
        'no_rek',
        'name_no_rek',
        'pangkat',
        'fungsional'
    ];

  /**
   * The Custom attributes that should add to JSON response.
   *
   * @var array
   */
  protected $appends = ['nama_dosen'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function pangkat()
    {
        return $this->belongsTo('App\Pangkat','pangkat','id');
    }

    public function fungsional()
    {
        return $this->belongsTo('App\Fungsional','fungsional','id');
    }

    public function setNameNoRekAttribute($value)
    {
        $this->attributes['name_no_rek'] = ucwords($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }

   /**
   * Get Nama Full Dosen Luar Biasa
   * @return void
   * 
   */
  public function getNamaDosenAttribute()
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
