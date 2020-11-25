<?php

use Illuminate\Database\Migrations\Migration;

class InsertCauHinhMon extends Migration {
    private $name        = 'cau_hinh_mon';
    private $ma_cau_hinh = ['1', '2', '1', '1', '2', '1', '2', '1', '2'];
    private $ma_mon_hoc  = ['BIT_ACC', 'BIT_AP', 'BIT_CMS', 'BIT_DB1', 'BIT_DB2', 'BIT_DMAR1', 'BIT_PHP1', 'BKA_ESE', 'BKA_ESE'];
    public function up() {
        for ($i = 0; $i < count($this->ma_mon_hoc); $i++) {
            DB::table($this->name)->insert(array(
                'ma_cau_hinh' => $this->ma_cau_hinh[$i],
                'ma_mon_hoc'  => $this->ma_mon_hoc[$i],
            ));
        };
    }
    public function down() {
        //
    }
}
