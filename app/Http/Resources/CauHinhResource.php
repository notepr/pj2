<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CauHinhResource extends JsonResource {
    public function toArray($request) {
        return [
            'ma_cau_hinh' => $this->ma_cau_hinh,
            'mo_ta'       => $this->deleteChar(),
            'ma_loai'     => $this->ma_loai,
            'ten_loai'    => $this->loai->ten_loai,
            'mo_ta_loai'  => $this->loai->mo_ta,
        ];
    }
    public function infoCase() {
        $mo_ta = explode('`', $this->mo_ta);
        for ($i = 0; $i < count($mo_ta); $i++) {
            if (!empty($mo_ta[$i])) {
                $key        = strtolower(substr($mo_ta[$i], 0, strpos($mo_ta[$i], ':')));
                $value      = substr($mo_ta[$i], strpos($mo_ta[$i], ':') + 1);
                $list[$key] = $value;
            }
        }
        $list = (object) $list;
        return [
            'ma_cau_hinh' => $this->ma_cau_hinh,
            'ma_loai'     => $this->ma_loai,
            'cpu'         => isset($list->cpu) ? $list->cpu : '',
            'main'        => isset($list->main) ? $list->main : '',
            'ram'         => isset($list->ram) ? $list->ram : '',
            'o_cung'      => isset($list->o_cung) ? $list->o_cung : '',
            'vga'         => isset($list->vga) ? $list->vga : '',
            'ten_loai'    => $this->loai->ten_loai,
            'mo_ta_loai'  => $this->loai->mo_ta,
        ];
    }
    public function deleteChar() {
        $mo_ta = $this->mo_ta;
        $mo_ta = str_replace('``', ' ', $mo_ta);
        $mo_ta = str_replace('`', '', $mo_ta);
        return $mo_ta;
    }
}
