<?php

namespace App\Http\Resources;

use Arr;
use Illuminate\Http\Resources\Json\JsonResource;

class LichHocResource extends JsonResource {
    public function toArray($request) {
        $this->resource = (object) $this->resource;
        return [
            'ngay'         => $this->ngay,
            'gio_bat_dau'  => $this->gio_bat_dau,
            'gio_ket_thuc' => $this->gio_ket_thuc,
            'phong'        => $this->phong ?? NULL,
        ];
    }
    public function lichDayCuaGiaoVien() {
        $data = array_map(function ($item) {
            $item = (object) $item;
            try {
                return [
                    'ngay'         => $item->ngay,
                    'gio_bat_dau'  => $item->gio_bat_dau,
                    'gio_ket_thuc' => $item->gio_ket_thuc,
                    'phong'        => $item->phong ?? NULL,
                    'ma_lop'       => $item->ma_lop ?? NULL,
                    'ma_mon_hoc'   => $item->ma_mon_hoc ?? NULL,
                    'so_gio'       => $item->so_gio ?? NULL,
                    'nghi'         => $item->nghi ?? false,
                ];
            } catch (\Exception $e) {
                return (array) $item;
            }
        }, $this->resource);
        $data = collect($data)->unique()->sortBy('ngay')->groupBy('ngay');
        return $data->toArray();
    }
    public function lichPhong() {
        $data = array_map(function ($item) {
            $item = (object) $item;
            try {
                return [
                    'ngay'          => $item->ngay,
                    'gio_bat_dau'   => $item->gio_bat_dau,
                    'gio_ket_thuc'  => $item->gio_ket_thuc,
                    'ma_lop'        => $item->ma_lop ?? NULL,
                    'ma_mon_hoc'    => $item->ma_mon_hoc ?? NULL,
                    'ma_nguoi_dung' => $item->ma_nguoi_dung,
                    'ho_ten'        => $item->ho_ten ?? 'Toàn Trường',
                    'so_gio'        => $item->so_gio ?? NULL,
                    'hoat_dong'     => $item->hoat_dong ?? NULL,
                    'nghi'          => $item->nghi ?? false,
                ];
            } catch (\Exception $e) {
                return (array) $item;
            }
        }, $this->resource);
        $data = collect($data)->unique()->sortBy('ngay')->groupBy('ngay');
        return $data->toArray();
    }
    public function phongTrong() {
        $data = array_map(function ($item) {
            $item = (object) $item;
            try {
                return [
                    'ngay'         => $item->ngay,
                    'ma_phong'     => $item->ma_phong,
                    'ten_phong'    => $item->ten_phong,
                    'ma_ca'        => $item->ma_ca,
                    'gio_bat_dau'  => $item->gio_bat_dau,
                    'gio_ket_thuc' => $item->gio_ket_thuc,
                ];
            } catch (\Exception $e) {
                return (array) $item;
            }
        }, $this->resource);
        $data = collect($data)->unique()->sortBy('ngay')->groupBy('ngay')->map(function ($item) {
            return array_values(Arr::sort($item, function ($value) {
                return $value['ma_phong'];
            }));
        });
        return $data->toArray();
    }
}
