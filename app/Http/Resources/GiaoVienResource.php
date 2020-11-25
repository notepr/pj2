<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GiaoVienResource extends JsonResource {
    public function toArray($request) {
        return [
            'ma_can_bo' => $this->ma_can_bo,
            'ho_ten'    => $this->ho_ten,
            'email'     => $this->email,
        ];
    }
}
