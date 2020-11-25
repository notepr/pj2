<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PhanCongChiTietResource extends JsonResource {
    public function toArray($request) {
        return [
            'ma_phan_cong'       => $this->ma_phan_cong,
            'ma_lop'             => $this->ma_lop,
            'ma_mon_hoc'         => $this->ma_mon_hoc,
            'ma_nguoi_dung'      => $this->ma_nguoi_dung,
            'tinh_trang'         => $this->tinh_trang,
            'phan_cong_chi_tiet' => $this->phanCongChiTiet,
            'ho_ten_nguoi_dung'  => $this->nguoiDung->ho_ten,
            'ma_cap_do'          => $this->nguoiDung->ma_cap_do,
        ];
    }
    public function toOne() {
        return [
            'ma_phan_cong'       => $this->ma_phan_cong,
            'ma_lop'             => $this->ma_lop,
            'ma_mon_hoc'         => $this->ma_mon_hoc,
            'ma_nguoi_dung'      => $this->ma_nguoi_dung,
            'ho_ten_nguoi_dung'  => $this->nguoiDung->ho_ten,
            'ma_cap_do'          => $this->nguoiDung->ma_cap_do,
            'ten_cap_do'         => $this->nguoiDung->capDo->ten_cap_do,
            'ma_tinh_trang'      => $this->tinh_trang,
            'ten_tinh_trang'     => $this->tinhTrang(),
            'phan_cong_chi_tiet' => $this->toOneDeital(),
        ];
    }
    public function toOneDeital() {
        $data = [];
        foreach ($this->phanCongChiTiet as $key => $value) {
            $cache               = (object) [];
            $cache->thu          = $value->thu;
            $cache->ma_phong     = $value->ma_phong;
            $cache->ten_phong    = $value->phong->ten_phong;
            $cache->ma_ca        = $value->ma_ca;
            $cache->gio_bat_dau  = $value->ca->gio_bat_dau;
            $cache->gio_ket_thuc = $value->ca->gio_ket_thuc;
            array_push($data, $cache);
        }
        return $data;
    }
    public function deXuat() {
        $data = [];
        foreach ($this->resource as $key => $value) {
            $cache               = (object) [];
            $cache->ma_phong     = $value->ma_phong;
            $cache->thu          = $value->thu;
            $cache->ma_ca        = $value->ma_ca;
            $cache->gio_bat_dau  = $value->gio_bat_dau;
            $cache->gio_ket_thuc = $value->gio_ket_thuc;
            $cache->ten_phong    = $value->ten_phong;
            $cache->so_cho_ngoi  = $value->so_cho_ngoi;
            $cache->ma_tang      = $value->ma_tang;
            $cache->ten_tang     = $value->ten_tang;
            $cache->ma_toa       = $value->ma_toa;
            $cache->ten_toa      = $value->ten_toa;
            array_push($data, $cache);
        }
        return $data;
    }
}
