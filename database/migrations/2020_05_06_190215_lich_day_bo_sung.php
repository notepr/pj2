<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LichDayBoSung extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    private $name = 'lich_day_bo_sung';
    public function up() {
        Schema::create($this->name, function (Blueprint $table) {
            $table->increments('ma_lich_day_bo_sung');
            $table->date('ngay');
            $table->string('ma_lop', 15);
            $table->integer('ma_nguoi_dung')->unsigned();
            $table->string('ma_mon_hoc', 10);
            $table->integer('ma_ca')->unsigned();
            $table->integer('ma_phong')->unsigned();
            $table->text('ghi_chu')->nullable();
            $table->integer('tinh_trang')->default(1);
            $table->foreign('ma_nguoi_dung')->references('ma_nguoi_dung')->on('nguoi_dung');
            $table->foreign('ma_mon_hoc')->references('ma_mon_hoc')->on('mon_hoc');
            $table->foreign('ma_ca')->references('ma_ca')->on('ca');
            // $table->foreign('ma_phong')->references('ma_phong')->on('phong');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists($this->name);
    }
}
