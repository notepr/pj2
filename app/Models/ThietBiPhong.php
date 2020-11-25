<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThietBiPhong extends Model {
    protected $table      = 'thiet_bi_phong';
    protected $primaryKey = 'ma_thiet_bi';
    protected $fillable   = ['ma_phong', 'ma_cau_hinh'];

    public $timestamps = false;

    public function phong() {
        return $this->belongsTo('App\Models\Phong', 'ma_phong', 'ma_phong');
    }
    public function cauHinh() {
        return $this->belongsTo('App\Models\CauHinh', 'ma_cau_hinh', 'ma_cau_hinh');
    }
}
