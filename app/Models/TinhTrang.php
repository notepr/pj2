<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TinhTrang extends Model {
    protected $table      = 'tinh_trang';
    protected $primaryKey = 'ma_tinh_trang';
    protected $fillable   = ['ma_tinh_trang'];

    public $timestamps = false;
}
