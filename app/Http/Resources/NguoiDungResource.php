<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NguoiDungResource extends JsonResource {
    public function toArray($request) {
        return [
            'ma_nguoi_dung' => $this->ma_nguoi_dung,
            'ho_ten'        => $this->ho_ten,
            'tai_khoan'     => $this->tai_khoan,
            'email'         => $this->email,
            'sdt'           => $this->sdt,
            'ma_cap_do'     => $this->ma_cap_do,
            'ten_cap_do'    => $this->capDo->ten_cap_do,
        ];
    }
    public function fullInfo() {
        return [
            'ma_nguoi_dung' => $this->ma_nguoi_dung,
            'ho_ten'        => $this->ho_ten,
            'tai_khoan'     => $this->tai_khoan,
            'email'         => $this->email,
            'sdt'           => $this->sdt,
            'ma_cap_do'     => $this->ma_cap_do,
            'ten_cap_do'    => $this->capDo->ten_cap_do,
            'key'           => $this->key,
        ];
    }
    public function withNgayNghi() {
        $return = [];
        foreach ($this->resource as $key => $value) {
            $cache                  = (object) [];
            $cache->ma_nguoi_dung   = $value->ma_nguoi_dung;
            $cache->ho_ten          = $value->ho_ten;
            $cache->ma_cap_do       = $value->ma_cap_do;
            $cache->ten_cap_do      = $value->capDo->ten_cap_do;
            $cache->ngay_nghi_count = $value->ngay_nghi_count;
            $cache->ngay_nghi       = $value->ngayNghiTinhTrang;
            array_push($return, $cache);
        }
        return $return;
    }
    public function key() {
        return [
            'key' => $this->key,
        ];
    }
}
