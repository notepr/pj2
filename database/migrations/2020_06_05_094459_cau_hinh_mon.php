<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CauHinhMon extends Migration {
    private $name = 'cau_hinh_mon';
    public function up() {
        Schema::create($this->name, function (Blueprint $table) {
            $table->integer('ma_cau_hinh')->unsigned();
            $table->string('ma_mon_hoc', 30);
            $table->foreign('ma_cau_hinh')->references('ma_cau_hinh')->on('cau_hinh');
            $table->foreign('ma_mon_hoc')->references('ma_mon_hoc')->on('mon_hoc');
            $table->primary(['ma_cau_hinh', 'ma_mon_hoc']);
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
