<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ca extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	private $name = 'ca';
	public function up() {
		Schema::create($this->name, function (Blueprint $table) {
			$table->integer('ma_ca')->unsigned()->unique();
			$table->time('gio_bat_dau', 0);
			$table->time('gio_ket_thuc', 0);
			$table->primary('ma_ca');
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
