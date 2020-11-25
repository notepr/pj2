<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Loai extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	private $name = 'loai';
	private $ten_loai = ['case', 'ma_hinh', 'chuot', 'ban_phim'];
	private $mo_ta = ['case', 'Màn Hình', 'Chuột', 'Bàn Phím'];
	public function up() {
		Schema::create($this->name, function (Blueprint $table) {
			$table->increments('ma_loai');
			$table->string('ten_loai', 100)->unique();
			$table->text('mo_ta')->nullable();;
		});
		for ($i = 0; $i < count($this->ten_loai); $i++) {
			DB::table($this->name)->insert(array(
				'ten_loai' => $this->ten_loai[$i],
				'mo_ta' => $this->mo_ta[$i],
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
