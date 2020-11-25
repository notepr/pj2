<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NgayNghi extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    private $name = 'ngay_nghi'; //
    public function up() {
        Schema::create($this->name, function (Blueprint $table) {
            $table->date('ngay');
            $table->integer('ma_giao_vien')->unsigned();
            $table->integer('ma_ca')->unsigned();
            $table->text('ghi_chu')->nullable();
            $table->integer('tinh_trang')->default(1);
            $table->foreign('ma_ca')->references('ma_ca')->on('ca');
            $table->primary(['ngay', 'ma_giao_vien', 'ma_ca']);
        });
    }
    public function down() {
        Schema::dropIfExists($this->name);
    }
}
