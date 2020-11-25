<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LichSuChiTiet extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	private $name = 'lich_su_chi_tiet';
	public function up() {
		Schema::create($this->name, function (Blueprint $table) {
			$table->integer('ma_lich_su')->unsigned();
			$table->integer('ma_thiet_bi')->unsigned();
			$table->string('gia', 20)->default('0');
			$table->integer('ma_tinh_trang_thiet_bi')->unsigned();
			$table->foreign('ma_lich_su')->references('ma_lich_su')->on('lich_su');
			$table->foreign('ma_thiet_bi')->references('ma_thiet_bi')->on('thiet_bi_phong');
			$table->foreign('ma_tinh_trang_thiet_bi')->references('ma_tinh_trang_thiet_bi')->on('tinh_trang_thiet_bi');
			$table->primary(['ma_lich_su', 'ma_thiet_bi']);
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
