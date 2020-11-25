<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NgayNghiResource extends JsonResource {
    public function toArray($request) {
        return [
            'ngay'          => $this->ngay,
            'so_nguoi_nghi' => $this->soNguoiNghi(),
            'can_bo'        => $this->canBo(),
        ];
    }
    public function canBo() {
        $value = (object) $this->can_bo[0]->toArray();
        if (count($this->can_bo) == 1 && is_null($value->nguoi_dung)) {
            return [
                'ma_giao_vien' => $value->ma_giao_vien,
                'ma_ca'        => $value->ma_ca,
                'ghi_chu'      => $value->ghi_chu,
                'nguoi_dung'   => [
                    'ho_ten' => 'Toàn Trường',
                ],
                'ca'           => $value->ca,
            ];
        } else {
            return $this->can_bo;
        }
    }
    public function soNguoiNghi() {
        $value = (object) $this->can_bo[0]->toArray();
        if (count($this->can_bo) == 1 && is_null($value->nguoi_dung)) {
            return 'all';
        } else {
            return $this->so_nguoi_nghi;
        }
    }
}
