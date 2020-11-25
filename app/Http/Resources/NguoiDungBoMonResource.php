<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NguoiDungBoMonResource extends JsonResource {
    public function toArray($request) {
        return parent::toArray($request);
        // return [
        //     'ma_nguoi_dung'     => $this->ma_nguoi_dung,
        //     'ho_ten'            => $this->ho_ten,
        //     'email'             => $this->email,
        //     'so_mon_day_duoc'   => $this->so_mon_day_duoc,
        //     'nguoi_dung_bo_mon' => $this->nguoiDungBoMon,
        // ];
    }
}
