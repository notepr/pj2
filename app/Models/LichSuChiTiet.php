<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LichSuChiTiet extends Model {
	protected $table = 'lich_su_chi_tiet';
	protected $primaryKey = ['ma_lich_su', 'ma_thiet_bi'];
	protected $fillable = ['ma_lich_su', 'ma_thiet_bi', 'ma_kieu'];

	public $timestamps = false;
	public $incrementing = false;
}
