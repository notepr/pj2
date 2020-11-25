<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class InsertCa extends Migration {
    private $name         = 'ca';
    private $gio_bat_dau  = ['08:00:00', '08:00:00', '10:00:00', '08:00:00', '13:30:00', '15:30:00', '13:30:00'];
    private $gio_ket_thuc = ['17:30:00', '10:00:00', '12:00:00', '12:00:00', '15:30:00', '17:30:00', '17:30:00'];
    public function up() {
        for ($i = 0; $i < count($this->gio_bat_dau); $i++) {
            DB::table($this->name)->insert(array(
                'ma_ca'        => $i + 1,
                'gio_bat_dau'  => $this->gio_bat_dau[$i],
                'gio_ket_thuc' => $this->gio_ket_thuc[$i],
            ));
        }
    }
    public function down() {
        //
    }
}
