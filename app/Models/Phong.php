<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phong extends Model {
    protected $table      = 'phong';
    protected $primaryKey = 'ma_phong';
    protected $fillable   = [
        'ten_phong', 'so_cho_ngoi', 'ma_tang', 'ma_tinh_trang', 'ghi_chu',
    ];

    protected $attributes = array(
        'ma_tinh_trang' => 1,
        'ghi_chu'       => null,
    );

    public $timestamps = false;

    public function thietBiPhong() {
        return $this->hasMany('App\Models\ThietBiPhong', 'ma_phong', 'ma_phong');
    }
    public function phanCongChiTiet() {
        return $this->hasMany('App\Models\PhanCongChiTiet', 'ma_phong', 'ma_phong');
    }
    public function lichDayBoSung() {
        return $this->hasMany('App\Models\LichDayBoSung', 'ma_phong', 'ma_phong');
    }
    public function tinhTrang() {
        return $this->belongsto('App\Models\TinhTrang', 'ma_tinh_trang');
    }
    public function tang() {
        return $this->belongsto('App\Models\Tang', 'ma_tang');
    }
    public function phongTable() {
        return $this->morphTo();
    }
}
