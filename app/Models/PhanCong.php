<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhanCong extends Model {
    protected $table      = 'phan_cong';
    protected $primaryKey = 'ma_phan_cong';
    protected $fillable   = [
        'ma_lop',
        'ma_mon_hoc',
        'ma_nguoi_dung',
        'tinh_trang',
    ];
    //0: Đang dạy
    //1: Hoàn thành bởi giáo viên
    //2: Hoàn thành bởi giáo vụ
    protected $attributes = array(
        'tinh_trang'    => '0',
        'ma_nguoi_dung' => null,
    );
    public $timestamps = false;
    public function phanCongChiTiet() {
        return $this->hasMany('App\Models\PhanCongChiTiet', 'ma_phan_cong', 'ma_phan_cong')->orderBy('thu', 'ASC');
    }
    public function nguoiDung() {
        return $this->belongsTo('App\Models\NguoiDung', 'ma_nguoi_dung', 'ma_nguoi_dung');
    }
    public function monHoc() {
        return $this->belongsTo('App\Models\MonHoc', 'ma_mon_hoc', 'ma_mon_hoc');
    }
    public function tinhTrang() {
        switch ($this->tinh_trang) {
        case 0:
            return "Đang dạy";
            break;
        case 1:
            return "Hoàn thành bởi giáo viên";
            break;
        case 2:
            return "Hoàn thành bởi giáo vụ";
            break;
        default:
            return "Chưa có tình trạng này";
            break;
        }
    }
}
