<?php

use Illuminate\Database\Migrations\Migration;

class InsertValue extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //nn
        DB::select(DB::raw("INSERT INTO `ngay_nghi` (`ngay`, `ma_giao_vien`, `ma_ca`, `ghi_chu`, `tinh_trang`) VALUES
('2020-07-01', 10, 3, NULL, 2),
('2020-07-09', 1, 3, NULL, 1),
('2020-07-09', 6, 4, NULL, 1),
('2020-07-10', 10, 2, 'Đi chơi', 1),
('2020-07-10', 15, 5, 'Đi chơi', 1),
('2020-07-10', 20, 6, 'Đi chơi', 1),
('2020-07-10', 25, 5, 'Đi chơi', 1),
('2020-07-17', 10, 6, NULL, 1),
('2020-07-29', 5, 3, NULL, 1)"));
        DB::select(DB::raw("UPDATE `ngay_nghi` SET ngay_nghi.ngay = DATE_ADD(ngay_nghi.ngay, INTERVAL 2 MONTH)"));
        // DB::select(DB::raw("UPDATE `ngay_nghi` SET ngay_nghi.ngay = DATE_ADD(ngay_nghi.ngay, INTERVAL 20 DAY)"));
        //pccc
        // DB::select(DB::raw("INSERT INTO `phan_cong_chi_tiet` (`ma_phan_cong`, `thu`, `ma_ca`, `ma_phong`) VALUES
        // (17, 2, 3, 4),
        // (257, 2, 4, 3),
        // (329, 5, 3, 3),
        // (400, 2, 2, 2),
        // (425, 2, 3, 2),
        // (425, 4, 3, 2),
        // (425, 6, 3, 2),
        // (425, 2, 6, 2),
        // (425, 4, 6, 2),
        // (425, 6, 6, 2),
        // (426, 3, 5, 2),
        // (426, 5, 5, 2),
        // (443, 5, 2, 3),
        // (443, 2, 4, 3)"));
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
