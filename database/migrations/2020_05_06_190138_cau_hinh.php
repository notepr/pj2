<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CauHinh extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    private $name    = 'cau_hinh';
    private $mo_ta   = ['`CPU:I9-9900XE``RAM:8Gb``MAIN:Z350`', '`CPU:XEON E5-2670``RAM:16Gb``MAIN:Z10PA-D8C`', 'DELL U2417H', 'DURGOD'];
    private $ma_loai = ['1', '1', '2', '3'];
    public function up() {
        Schema::create($this->name, function (Blueprint $table) {
            $table->increments('ma_cau_hinh');
            $table->text('mo_ta');
            $table->integer('ma_loai')->unsigned();
            $table->foreign('ma_loai')->references('ma_loai')->on('loai');
        });
        for ($i = 0; $i < count($this->mo_ta); $i++) {
            DB::table($this->name)->insert(array(
                'mo_ta'   => $this->mo_ta[$i],
                'ma_loai' => $this->ma_loai[$i],
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
