<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CauHinhMonResource extends JsonResource {
    public function toArray($request) {
        return [
            'ma_cau_hinh'        => $this->ma_cau_hinh,
            'ma_mon_hoc'         => $this->ma_mon_hoc,
            'ten_mon_tieng_viet' => $this->monHoc->ten_mon_tieng_viet,
            'ten_mon_tieng_anh'  => $this->monHoc->ten_mon_tieng_anh,
        ];
    }
    public function cauHinhCoMonHoc() {
        $data = [];
        foreach ($this->resource as $key => $value) {
            $cache              = (object) [];
            $cache->ma_cau_hinh = $value->cauHinh->ma_cau_hinh;
            $cache->mo_ta       = $this->deleteChar($value->cauHinh->mo_ta);
            //$cache->ma_loai     = $value->cauHinh->loai;
            array_push($data, $cache);
        }
        return $data;
    }
    public function deleteChar($mo_ta) {
        $mo_ta = $mo_ta;
        $mo_ta = str_replace('``', ' ', $mo_ta);
        $mo_ta = str_replace('`', '', $mo_ta);
        return $mo_ta;
    }
}
