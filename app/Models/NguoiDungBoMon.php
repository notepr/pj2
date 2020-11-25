<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NguoiDungBoMon extends Model {
    use Traits\HasCompositePrimaryKey;
    protected $table      = 'nguoi_dung_bo_mon';
    protected $primaryKey = ['ma_nguoi_dung', 'ma_mon_hoc'];
    protected $fillable   = ['ma_nguoi_dung', 'ma_mon_hoc'];
    public $timestamps    = false;
    public function nguoiDung() {
        return $this->belongsTo('App\Models\NguoiDung', 'ma_nguoi_dung', 'ma_nguoi_dung');
    }
    public function monHoc() {
        return $this->belongsTo('App\Models\MonHoc', 'ma_mon_hoc', 'ma_mon_hoc');
    }
}
