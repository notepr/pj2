<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LichSu extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	private $name = 'lich_su';
	private $ma_nguoi_dung = ['1', '2'];
	public function up() {
		Schema::create($this->name, function (Blueprint $table) {
			$table->increments('ma_lich_su');
			$table->integer('ma_nguoi_dung')->unsigned();
			$table->timestamp('thoi_gian', 0);
			$table->foreign('ma_nguoi_dung')->references('ma_nguoi_dung')->on('nguoi_dung');
		});
		for ($i = 0; $i < count($this->ma_nguoi_dung); $i++) {
			DB::table($this->name)->insert(array(
				'ma_nguoi_dung' => $this->ma_nguoi_dung[$i],
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
