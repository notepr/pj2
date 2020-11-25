<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ToaResource extends JsonResource {
    public function toArray($request) {
        return [
            'ma_toa'         => $this->ma_toa,
            'ten_toa'        => $this->ten_toa,
            'dia_chi'        => $this->dia_chi,
            'ma_tinh_trang'  => $this->ma_tinh_trang,
            'ten_tinh_trang' => $this->tinhTrang->ten_tinh_trang,
        ];
    }
}
