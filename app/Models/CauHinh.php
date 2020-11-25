<?php

namespace App\Models;
use App\Models\CauHinhMon;
use App\Models\Loai;
use Illuminate\Database\Eloquent\Model;

class CauHinh extends Model {
    protected $table      = 'cau_hinh';
    protected $primaryKey = 'ma_cau_hinh';
    protected $fillable   = ['mo_ta', 'ma_loai'];

    public $timestamps = false;
    public function loai() {
        return $this->hasOne(new Loai, 'ma_loai', 'ma_loai');
    }
    public function cauHinhMon() {
        return $this->hasMany(new CauHinhMon, 'ma_cau_hinh', 'ma_cau_hinh');
    }
    public function thietBiPhong() {
        return $this->hasOne('App\Models\ThietBiPhong', 'ma_cau_hinh', 'ma_cau_hinh');
    }
}
