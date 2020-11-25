<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use RegexRule;

class ThietBiPhongRequest extends FormRequest {
    use Traits\ListError;
    public function rules() {
        return [
            'ma_phong'    => RegexRule::REGEX_EXISTS_MA_PHONG,
            'ma_cau_hinh' => RegexRule::REGEX_EXISTS_MA_CAU_HINH,
            'ma_thiet_bi' => RegexRule::REGEX_EXISTS_MA_THIET_BI,
        ];
    }
    public function attributes() {
        return [
            'ma_phong'    => 'Phòng',
            'ma_cau_hinh' => 'Cấu hình',
            'ma_thiet_bi' => 'Mã thiết bị',
        ];
    }
}
