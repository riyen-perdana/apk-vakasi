<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
  use HasApiTokens, Notifiable, HasRoles;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  
  protected $fillable = [
      'nip','code_red','glr_dpn','glr_blk','name','email', 'password','avatar',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The Custom attributes that should add to JSON response.
   *
   * @var array
   */
  protected $appends = ['nama_pengguna'];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  /**
   * Set Gelar Depan
   * @return void
   * 
   */
  // public function setGlrDpnAttribute($value)
  // {
  //   $this->attributes['glr_dpn'] = ucwords($value);
  // }

  /**
   * Set Nama Pengguna
   * @return void
   * 
   */
  public function setNameAttribute($value)
  {
    $this->attributes['name'] = ucwords($value);
  }

  /**
   * Get Nama Full Pengguna
   * @return void
   * 
   */
  public function getNamaPenggunaAttribute()
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
