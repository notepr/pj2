<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TangResource extends JsonResource {
    public function toArray($request) {
        return [
            'ma_tang'        => $this->ma_tang,
            'ten_tang'       => $this->ten_tang,
            'ma_tinh_trang'  => $this->tinhTrang->ma_tinh_trang,
            'ten_tinh_trang' => $this->tinhTrang->ten_tinh_trang,
            'ma_toa'         => $this->ma_toa,
            'ten_toa'        => $this->toa->ten_toa,
            'dia_chi_toa'    => $this->toa->dia_chi,
        ];
    }
}
