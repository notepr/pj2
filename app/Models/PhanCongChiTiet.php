<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhanCongChiTiet extends Model {
    use Traits\HasCompositePrimaryKey;
    protected $table      = 'phan_cong_chi_tiet';
    protected $primaryKey = [
        'ma_phan_cong',
        'thu',
        'ma_ca',
        'ma_phong',
    ];
    protected $fillable = [
        'ma_phan_cong',
        'thu',
        'ma_ca',
        'ma_phong',
    ];

    public $timestamps = false;
    public function phanCong() {
        return $this->belongsTo('App\Models\PhanCong', 'ma_phan_cong', 'ma_phan_cong');
    }
    public function phong() {
        return $this->belongsTo('App\Models\Phong', 'ma_phong', 'ma_phong');
    }
    public function ca() {
        return $this->belongsTo('App\Models\Ca', 'ma_ca', 'ma_ca');
    }
}
