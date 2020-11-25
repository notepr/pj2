<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ThietBiPhong extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    private $name        = 'thiet_bi_phong';
    private $ma_phong    = ['2', '3', '4'];
    private $ma_cau_hinh = ['1', '1', '2'];
    public function up() {
        Schema::create($this->name, function (Blueprint $table) {
            $table->increments('ma_thiet_bi');
            $table->integer('ma_phong')->unsigned()->unique();
            $table->integer('ma_cau_hinh')->unsigned();
            $table->foreign('ma_phong')->references('ma_phong')->on('phong');
            $table->foreign('ma_cau_hinh')->references('ma_cau_hinh')->on('cau_hinh');
        });
        for ($i = 0; $i < count($this->ma_phong); $i++) {
            DB::table($this->name)->insert(array(
                'ma_phong'    => $this->ma_phong[$i],
                'ma_cau_hinh' => $this->ma_cau_hinh[$i],
            ));
        }
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
