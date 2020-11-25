<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use RegexRule;

class LoaiRequest extends FormRequest {
    use Traits\ListError;
    public function rules() {
        return [
            'ma_loai'  => RegexRule::REGEX_LOAI_MA_LOAI,
            'ten_loai' => RegexRule::REGEX_LOAI_TEN_LOAI,
            'mo_ta'    => RegexRule::REGEX_LOAI_MO_TA,
        ];
    }
    public function attributes() {
        return [
            'ma_loai'  => 'Loại',
            'ten_loai' => 'Tên loại',
            'mo_ta'    => 'Mô tả loại',
        ];
    }
}
