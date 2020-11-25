<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use RegexRule;

class CauHinhRequest extends FormRequest {
    use Traits\ListError;
    public function rules() {
        return [
            'cpu'         => RegexRule::REGEX_CAU_HINH_CPU,
            'ram'         => RegexRule::REGEX_CAU_HINH_RAM,
            'main'        => RegexRule::REGEX_CAU_HINH_MAIN,
            'o_cung'      => RegexRule::REGEX_CAU_HINH_O_CUNG,
            'ma_cau_hinh' => RegexRule::REGEX_CAU_HINH_MA_CAU_HINH,
            'mo_ta'       => RegexRule::REGEX_CAU_HINH_MO_TA,
            'ma_loai'     => RegexRule::REGEX_EXISTS_MA_LOAI,
        ];
    }
    public function attributes() {
        return [
            'cpu'         => 'CPU',
            'ram'         => 'RAM',
            'main'        => 'Main',
            'o_cung'      => 'Ổ Cứng',
            'ma_cau_hinh' => 'Cấu hình',
            'mo_ta'       => 'Mô tả',
            'ma_loai'     => 'Loại',
        ];
    }
}
