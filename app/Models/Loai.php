<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loai extends Model {
	protected $table = 'loai';
	protected $primaryKey = 'ma_loai';
	protected $fillable = [
		'ten_loai', 'mo_ta',
	];

	public $timestamps = false;
}
