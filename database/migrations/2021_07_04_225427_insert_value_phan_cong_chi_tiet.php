<?php

use Illuminate\Database\Migrations\Migration;

class InsertValuePhanCongChiTiet extends Migration {
    private $name         = 'phan_cong_chi_tiet';
    private $ma_phan_cong = ['426', '426', '425', '425', '425', 26, 470];
    private $thu          = ['3', '5', '2', '4', '6', 4, 3];
    private $ma_ca        = ['5', '5', '6', '6', '6', 3, 4];
    private $ma_phong     = ['2', '2', '2', '2', '2', 3, 3];
    public function up() {
        for ($i = 0; $i < count($this->ma_phan_cong); $i++) {
            DB::table($this->name)->insert(array(
                'ma_phan_cong' => $this->ma_phan_cong[$i],
                'thu'          => $this->thu[$i],
                'ma_ca'        => $this->ma_ca[$i],
                'ma_phong'     => $this->ma_phong[$i],
            ));
        };
    }
    public function down() {
        //
    }
}
