<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Toa extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	private $name = 'toa';
	private $ten_toa = ['Tòa 1', 'Tòa 2'];
	private $dia_chi = ['A17 Tạ Quang Bửu', 'D5 Trần Đại Nghĩa'];
	private $ma_tinh_trang = ['1', '1'];
	public function up() {
		Schema::create($this->name, function (Blueprint $table) {
			$table->increments('ma_toa');
			$table->string('ten_toa', 20);
			$table->string('dia_chi', 100)->nullable();
			$table->integer('ma_tinh_trang')->unsigned();
			$table->foreign('ma_tinh_trang')->references('ma_tinh_trang')->on('tinh_trang');
		});
		for ($i = 0; $i < count($this->ten_toa); $i++) {
			DB::table($this->name)->insert(array(
				'ten_toa' => $this->ten_toa[$i],
				'dia_chi' => $this->dia_chi[$i],
				'ma_tinh_trang' => $this->ma_tinh_trang[$i],
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
