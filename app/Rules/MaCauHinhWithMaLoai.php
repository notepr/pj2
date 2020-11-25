<?php

namespace App\Rules;

use App\Models\CauHinh;
use Illuminate\Contracts\Validation\Rule;

class MaCauHinhWithMaLoai implements Rule {
    public function __construct() {
        //
    }
    public function passes($attribute, $value) {
        $cau_hinh = CauHinh::where($attribute, $value)
            ->where('ma_loai', 1)
            ->first();
        if (is_null($cau_hinh)) {
            return false;
        } else {
            return true;
        }
    }
    public function message() {
        return ':attribute không phải là Case';
    }
}
