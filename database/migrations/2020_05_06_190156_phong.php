<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Phong extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	private $name = 'phong';
	private $ten_phong = ['Kho', 'Lab 201', 'Lab 202', 'Lab 203', 'Lab 5'];
	private $so_cho_ngoi = ['0', '20', '40', '50', '35'];
	private $ma_tang = ['4', '4', '4', '1', '4'];
	public function up() {
		Schema::create($this->name, function (Blueprint $table) {
			$table->increments('ma_phong');
			$table->string('ten_phong', 50);
			$table->integer('so_cho_ngoi')->unsigned();
			$table->integer('ma_tang')->unsigned();
			$table->integer('ma_tinh_trang')->unsigned();
			$table->text('ghi_chu')->nullable();
			$table->foreign('ma_tang')->references('ma_tang')->on('tang');
			$table->foreign('ma_tinh_trang')->references('ma_tinh_trang')->on('tinh_trang');
		});
		for ($i = 0; $i < count($this->ten_phong); $i++) {
			DB::table($this->name)->insert(array(
				'ten_phong' => $this->ten_phong[$i],
				'so_cho_ngoi' => $this->so_cho_ngoi[$i],
				'ma_tinh_trang' => '1',
				'ma_tang' => $this->ma_tang[$i],
				'ghi_chu' => '',
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
