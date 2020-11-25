<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PhanHoiSuCo extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	private $name = 'phan_hoi_su_co';
	public function up() {
		Schema::create($this->name, function (Blueprint $table) {
			$table->increments('ma_phan_hoi');
			$table->integer('ma_nguoi_gui')->unsigned();
			$table->text('noi_dung');
			$table->integer('tinh_trang');
			$table->text('ket_qua');
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
