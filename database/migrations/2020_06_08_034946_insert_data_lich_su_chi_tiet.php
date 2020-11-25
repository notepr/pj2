<?php

use Illuminate\Database\Migrations\Migration;

class InsertDataLichSuChiTiet extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    private $name                   = 'lich_su_chi_tiet';
    private $ma_lich_su             = ['1', '1', '2'];
    private $ma_thiet_bi            = ['4', '1', '1'];
    private $ma_tinh_trang_thiet_bi = ['1', '2', '4'];
    private $gia                    = ['1500000', '200000', '200000'];
    public function up() {
        // for ($i = 0; $i < count($this->ma_lich_su); $i++) {
        //     DB::table($this->name)->insert(array(
        //         'ma_lich_su' => $this->ma_lich_su[$i],
        //         'ma_thiet_bi' => $this->ma_thiet_bi[$i],
        //         'ma_tinh_trang_thiet_bi' => $this->ma_tinh_trang_thiet_bi[$i],
        //         'gia' => $this->gia[$i],
        //     ));
        // }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //nothing
    }
}
