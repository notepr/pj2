<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Tang extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	private $name = 'tang';
	private $ten_tang = ['Tầng 1','Tầng 2','Tầng 3','Tầng 4'];
	private $ma_toa = ['1','2'];
	public function up() {
		Schema::create($this->name, function (Blueprint $table) {
			$table->increments('ma_tang');
			$table->string('ten_tang', 50);
			$table->integer('ma_toa')->unsigned();
			$table->integer('ma_tinh_trang')->unsigned();
			$table->foreign('ma_toa')->references('ma_toa')->on('toa');
			$table->foreign('ma_tinh_trang')->references('ma_tinh_trang')->on('tinh_trang');
		});
		for ($i = 0; $i < count($this->ma_toa); $i++) {
			for ($j=0; $j < count($this->ten_tang); $j++) { 
				DB::table($this->name)->insert(array(
				'ten_tang' => $this->ten_tang[$j],
				'ma_toa' => $this->ma_toa[$i],
				'ma_tinh_trang' => 1,
			));
			}
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
