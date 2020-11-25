<?php

namespace App\Http\Requests;

use App\Rules\RegexRule;
use Illuminate\Foundation\Http\FormRequest;

class PhongRequest extends FormRequest {
    use Traits\ListError;
    public function rules() {
        return [
            'ma_phong'      => RegexRule::REGEX_EXISTS_MA_PHONG,
            'ma_tang'       => RegexRule::REGEX_EXISTS_MA_TANG,
            'ma_tinh_trang' => RegexRule::REGEX_EXISTS_MA_TINH_TRANG,
            'ten_phong'     => RegexRule::REGEX_PHONG_NAME,
            'so_cho_ngoi'   => RegexRule::REGEX_PHONG_SO_CHO_NGOI,
            'ghi_chu'       => RegexRule::REGEX_GHI_CHU,
        ];
    }
    public function attributes() {
        return [
            'ma_phong'      => 'Phòng',
            'ma_tang'       => 'Tầng',
            'ma_tinh_trang' => 'Tình trạng',
            'ten_phong'     => 'Tên phòng',
            'so_cho_ngoi'   => 'Số chỗ ngồi',
        ];
    }
}
