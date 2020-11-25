<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChuongTrinhDaoTao extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	private $name = 'chuong_trinh_dao_tao';
	public function up() {
		Schema::create($this->name, function (Blueprint $table) {
			$table->increments('ma_chuong_trinh_dao_tao');
			$table->string('ma_mon_hoc', 10);
			$table->text('ghi_chu');
			$table->integer('hoc_ki');
			$table->foreign('ma_mon_hoc')->references('ma_mon_hoc')->on('mon_hoc');
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
