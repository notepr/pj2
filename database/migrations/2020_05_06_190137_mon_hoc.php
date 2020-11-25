<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MonHoc extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    private $name = 'mon_hoc';
    public function up() {
        Schema::create($this->name, function (Blueprint $table) {
            $table->string('ma_mon_hoc', 30);
            $table->string('ten_mon_tieng_anh', 100)->nullable();
            $table->string('ten_mon_tieng_viet', 100)->nullable();
            $table->string('so_gio', 10)->nullable();
            $table->integer('ma_kieu_thi')->nullable();
            $table->primary('ma_mon_hoc');
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
