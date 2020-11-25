<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use RegexRule;

class PhanCongChiTietRequest extends FormRequest {
    use Traits\ListError;
    public function rules() {
        return [
            'ma_phan_cong' => RegexRule::REGEX_EXISTS_MA_PHAN_CONG,
            'thu'          => RegexRule::REGEX_THU,
            'ma_ca'        => RegexRule::REGEX_EXISTS_MA_CA,
            'ma_phong'     => RegexRule::REGEX_EXISTS_MA_PHONG,
        ];
    }
    public function attributes() {
        return [
            'ma_phan_cong'       => 'Phân công',
            'thu'                => 'Thứ',
            'ma_ca'              => 'Ca học',
            'ma_phong'           => 'Phòng học',
            'phan_cong_chi_tiet' => 'Phân công chi tiết',
        ];
    }
}
