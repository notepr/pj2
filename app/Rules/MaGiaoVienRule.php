<?php

namespace App\Rules;

use App\Models\NguoiDung;
use Illuminate\Contracts\Validation\Rule;
use ResponseMau;

class MaGiaoVienRule implements Rule {
    public function passes($attribute, $value) {
        if ($value == 0 || NguoiDung::where('ma_nguoi_dung', $value)->exists()) {
            return true;
        }
        return false;

    }
    public function message() {
        return ResponseMau::RES_KHONG_TON_TAI;
    }
}
