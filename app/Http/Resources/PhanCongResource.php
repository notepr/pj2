<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PhanCongResource extends JsonResource {

    public function toArray($request) {
        return [
            'ma_phan_cong'   => $this->ma_phan_cong,
            'ma_lop'         => $this->ma_lop,
            'ma_mon_hoc'     => $this->ma_mon_hoc,
            'ma_tinh_trang'  => $this->tinh_trang,
            'ten_tinh_trang' => $this->tinhTrang(),
            'nguoidung'      => $this->nguoidung,
        ];
    }
}
