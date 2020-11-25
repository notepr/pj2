<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PhanCongChiTiet extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    private $name = 'phan_cong_chi_tiet';
    public function up() {
        Schema::create($this->name, function (Blueprint $table) {
            $table->integer('ma_phan_cong')->unsigned();
            $table->integer('thu');
            $table->integer('ma_ca')->unsigned();
            $table->integer('ma_phong')->unsigned();
            $table->foreign('ma_phan_cong')->references('ma_phan_cong')->on('phan_cong');
            $table->foreign('ma_ca')->references('ma_ca')->on('ca');
            // $table->foreign('ma_phong')->references('ma_phong')->on('phong');
            $table->primary(['ma_phan_cong', 'ma_ca', 'ma_phong', 'thu']);
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
