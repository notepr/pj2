<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Toa extends Model {
    protected $table      = 'toa';
    protected $primaryKey = 'ma_toa';
    protected $fillable   = ['ten_toa', 'dia_chi', 'ma_tinh_trang'];

    public $timestamps = false;
    public function tang() {
        return $this->hasMany('App\Models\Tang', 'ma_toa');
    }
    public function tinhTrang() {
        return $this->hasOne('App\Models\TinhTrang', 'ma_tinh_trang', 'ma_tinh_trang');
    }
    public function tangs() {
        return $this->morphMany('App\Models\Tang', 'tangs');
    }
}
