<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Loai extends JsonResource {
    public function toArray($request) {
        return [
            'ma_loai'  => $this->ma_loai,
            'ten_loai' => $this->ten_loai,
            'mo_ta'    => $this->mo_ta,
        ];
    }
    public static function one($value) {
        return [
            'ten_loai' => $value->ten_loai,
            'mo_ta'    => $value->mo_ta,
        ];
    }
}
