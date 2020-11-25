<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NgayNghi extends Model {
    use Traits\HasCompositePrimaryKey;
    protected $table      = 'ngay_nghi';
    protected $primaryKey = [
        'ngay',
        'ma_giao_vien',
        'ma_ca',
    ];
    protected $fillable = [
        'ngay',
        'ma_giao_vien',
        'ma_ca',
        'ghi_chu',
        'tinh_trang',
    ];
    protected $attributes = array(
        'ghi_chu'    => null,
        'tinh_trang' => 1,
    );
    public $timestamps   = false;
    public $incrementing = false;
    public function ca() {
        return $this->hasOne('App\Models\Ca', 'ma_ca', 'ma_ca');
    }
    public function nguoiDung() {
        return $this->hasOne('App\Models\NguoiDung', 'ma_nguoi_dung', 'ma_giao_vien');
    }
}
