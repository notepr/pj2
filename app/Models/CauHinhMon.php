<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CauHinhMon extends Model {
    use Traits\HasCompositePrimaryKey;
    protected $table      = 'cau_hinh_mon';
    protected $primaryKey = [
        'ma_cau_hinh',
        'ma_mon_hoc',
    ];
    protected $fillable = [
        'ma_cau_hinh',
        'ma_mon_hoc',
    ];

    public $timestamps = false;
    public function monHoc() {
        return $this->belongsTo('App\Models\MonHoc', 'ma_mon_hoc', 'ma_mon_hoc');
    }
    public function cauHinh() {
        return $this->belongsTo('App\Models\CauHinh', 'ma_cau_hinh', 'ma_cau_hinh');
    }
}
