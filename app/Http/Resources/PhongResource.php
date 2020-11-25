<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PhongResource extends JsonResource {
    public function toArray($request) {
        return [
            'ma_phong'    => $this->ma_phong,
            'ten_phong'   => $this->ten_phong,
            'so_cho_ngoi' => $this->so_cho_ngoi,
            'ma_tang'     => $this->ma_tang,
            'ghi_chu'     => $this->ghi_chu,
            'tinh_trang'  => $this->tinhTrang,
            'cau_hinh'    => $this->getCauHinh($this->thietBiPhong),
        ];
    }
    public function getCauHinh($thiet_bi_phong) {
        foreach ($thiet_bi_phong as $key => $thiet_bi) {
            return $thiet_bi->cauHinh;
        }
        return NULL;
    }
}
