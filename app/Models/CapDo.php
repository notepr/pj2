<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CapDo extends Model {
    protected $table      = 'cap_do';
    protected $primaryKey = 'ma_cap_do';
    protected $fillable   = ['ten_cap_do'];

    public $timestamps = false;
}
