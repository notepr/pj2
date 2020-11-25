<?php

namespace App\Http\Requests;
use App\Rules\RegexRule;
use Illuminate\Foundation\Http\FormRequest;

class TangRequest extends FormRequest {
    use Traits\ListError;
    public function rules() {
        return [
            'ma_toa'        => RegexRule::REGEX_TANG_MA_TOA,
            'ma_tang'       => RegexRule::REGEX_TANG_MA_TANG,
            'ten_tang'      => RegexRule::REGEX_TANG_NAME,
            'ma_tinh_trang' => RegexRule::REGEX_TANG_TINH_TRANG,
        ];
    }
    public function attributes() {
        return [
            'ma_toa'        => 'Tòa',
            'ma_tang'       => 'Tầng',
            'ten_tang'      => 'Tên tầng',
            'ma_tinh_trang' => 'Tình trạng',
        ];
    }
}
