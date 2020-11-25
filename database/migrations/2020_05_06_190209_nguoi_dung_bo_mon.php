<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NguoiDungBoMon extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    private $name = 'nguoi_dung_bo_mon';
    public function up() {
        Schema::create($this->name, function (Blueprint $table) {
            $table->integer('ma_nguoi_dung')->unsigned();
            $table->string('ma_mon_hoc', 30);
            $table->foreign('ma_mon_hoc')->references('ma_mon_hoc')->on('mon_hoc');
            $table->foreign('ma_nguoi_dung')->references('ma_nguoi_dung')->on('nguoi_dung');
            $table->primary(['ma_nguoi_dung', 'ma_mon_hoc']);
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
