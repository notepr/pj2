<?php

use Illuminate\Database\Migrations\Migration;

class InsertNgayNghi extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    private $name         = 'ngay_nghi';
    private $ngay         = ['2020-06-23', '2020-07-01', '2020-06-29'];
    private $ma_giao_vien = ['1', '0', '7'];
    private $ma_ca        = ['2', '4', '5'];
    public function up() {
        for ($i = 0; $i < count($this->ngay); $i++) {
            DB::table($this->name)->insert(array(
                'ngay'         => $this->ngay[$i],
                'ma_giao_vien' => $this->ma_giao_vien[$i],
                'ma_ca'        => $this->ma_ca[$i],
            ));
        }
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
