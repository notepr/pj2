<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TinhTrangThietBi extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	private $name = 'tinh_trang_thiet_bi';
	private $ten_tinh_trang = ['Thêm', 'Cho Mượn', 'Sửa', 'Trả Về'];
	public function up() {
		Schema::create($this->name, function (Blueprint $table) {
			$table->increments('ma_tinh_trang_thiet_bi');
			$table->string('ten_tinh_trang', 100);
		});
		for ($i = 0; $i < count($this->ten_tinh_trang); $i++) {
			DB::table($this->name)->insert(array(
				'ten_tinh_trang' => $this->ten_tinh_trang[$i],
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
