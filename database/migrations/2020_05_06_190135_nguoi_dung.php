<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class NguoiDung extends Migration {
    private $name      = 'nguoi_dung';
    private $tai_khoan = ['superadmin', 'user', 'duong', 'cuong', 'kithuat'];
    private $mat_khau  = ['1', '1', '1', '1', '1'];
    private $email     = ['a@gmail.com', 'b@gmail.com', 'c@gmail.com', 'd@gmail.com', 'kithuat@gmail.com'];
    private $sdt       = ['0', '1', '2', '4', '6'];
    private $ma_cap_do = ['1', '2', '1', '1', '2'];
    private $key       = ['0', '8', '1', '4', '3'];
    public function up() {
        Schema::create($this->name, function (Blueprint $table) {
            $table->increments('ma_nguoi_dung');
            $table->string('ho_ten', 100)->nullable(true);
            $table->string('tai_khoan', 50)->nullable(false)->unique();
            $table->string('mat_khau', 256)->nullable(false);
            $table->string('email', 50)->nullable(false)->unique();
            $table->string('sdt', 12)->nullable(false)->unique();
            $table->integer('ma_cap_do');
            $table->string('key', 256)->nullable(false)->unique();
            $table->foreign('ma_cap_do')->references('ma_cap_do')->on('cap_do');
        });
        for ($i = 0; $i < count($this->tai_khoan); $i++) {
            DB::table($this->name)->insert(array(
                'tai_khoan' => $this->tai_khoan[$i],
                'mat_khau'  => Hash::make(md5($this->mat_khau[$i])),
                'email'     => $this->email[$i],
                'sdt'       => $this->sdt[$i],
                'ma_cap_do' => $this->ma_cap_do[$i],
                'key'       => $this->key[$i],
            ));
        }
    }
    public function down() {
        Schema::dropIfExists($this->name);
    }
}
