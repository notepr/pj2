<?php

use App\Http\Controllers\Api\MonHocController;
use App\Http\Controllers\Api\NguoiDungBoMonController;
use App\Http\Controllers\Api\NguoiDungController;
use App\Http\Controllers\Api\PhanCongController;
use Illuminate\Database\Migrations\Migration;

class InsertCloneAuto extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        (new NguoiDungController)->giaoVienClone();
        (new PhanCongController)->cloneBKACADToLocal();
        (new MonHocController)->cloneBKACADToLocal();
        (new NguoiDungBoMonController)->cloneWithPhanCong();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }
}
