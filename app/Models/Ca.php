<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ca extends Model {
    protected $table      = 'ca';
    protected $primaryKey = 'ma_ca';
    protected $fillable   = ['gio_bat_dau', 'gio_ket_thuc'];

    public $timestamps = false;
    public function ngayNghi() {
        return $this->hasMany('App\Models\NgayNghi', 'ma_ca', 'ma_ca');
    }
}
