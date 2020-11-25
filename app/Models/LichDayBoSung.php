<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LichDayBoSung extends Model {
    protected $table      = 'lich_day_bo_sung';
    protected $primaryKey = 'ma_lich_day_bo_sung';
    protected $fillable   = ['ngay', 'ma_lop', 'ma_nguoi_dung', 'ma_mon_hoc', 'ma_ca', 'ma_phong', 'ghi_chu', 'tinh_trang'];
    protected $attributes = array(
        'ghi_chu'    => null,
        'tinh_trang' => 1,
    );
    public $timestamps = false;
    public function nguoiDung() {
        return $this->belongsTo('App\Models\NguoiDung', 'ma_nguoi_dung', 'ma_nguoi_dung');
    }
    public function monHoc() {
        return $this->belongsTo('App\Models\MonHoc', 'ma_mon_hoc', 'ma_mon_hoc');
    }
    public function phong() {
        return $this->belongsTo('App\Models\Phong', 'ma_phong', 'ma_phong');
    }
    public function ca() {
        return $this->belongsTo('App\Models\Ca', 'ma_ca', 'ma_ca');
    }
}
