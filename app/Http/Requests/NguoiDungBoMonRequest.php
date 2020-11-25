<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use RegexRule;

class NguoiDungBoMonRequest extends FormRequest {
    use Traits\ListError;
    public function rules() {
        return [
            'ma_giao_vien'   => RegexRule::REGEX_ARRAY_MIN_1,
            'ma_giao_vien.*' => RegexRule::REGEX_EXISTS_MA_NGUOI_DUNG,
            'ma_mon_hoc'     => RegexRule::REGEX_ARRAY_MIN_1,
            'ma_mon_hoc.*'   => RegexRule::REGEX_EXISTS_MA_MON_HOC,
        ];
    }
    public function attributes() {
        return [
            'ma_giao_vien'   => 'Giáo viên',
            'ma_giao_vien.*' => 'Giáo viên',
            'ma_mon_hoc'     => 'Môn học',
            'ma_mon_hoc.*'   => 'Môn học',
        ];
    }
}
