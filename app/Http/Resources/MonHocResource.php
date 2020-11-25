<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MonHocResource extends JsonResource {
    public function toArray($request) {
        return [
            'ma_mon_hoc'         => $this->ma_mon_hoc,
            'ten_mon_tieng_viet' => $this->ten_mon_tieng_viet,
            'ten_mon_tieng_anh'  => $this->ten_mon_tieng_anh,
        ];
    }
    public function toOne() {
        return [
            'ma_mon_hoc'         => $this->ma_mon_hoc,
            'ten_mon_tieng_viet' => $this->ten_mon_tieng_viet,
            'ten_mon_tieng_anh'  => $this->ten_mon_tieng_anh,
            'so_gio'             => $this->so_gio,
            'ma_kieu_thi'        => $this->ma_kieu_thi,
        ];
    }
}