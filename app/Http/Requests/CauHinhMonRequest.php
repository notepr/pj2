<?php

namespace App\Http\Requests;

use App\Rules\MaCauHinhWithMaLoai;
use Illuminate\Foundation\Http\FormRequest;
use RegexRule;

class CauHinhMonRequest extends FormRequest {
    use Traits\ListError;
    public function rules() {
        return [
            'ma_mon_hoc'  => RegexRule::REGEX_EXISTS_MA_MON_HOC,
            'ma_cau_hinh' => new MaCauHinhWithMaLoai(),
        ];
    }
    public function attributes() {
        return [
            'ma_mon_hoc'  => 'Môn học',
            'ma_cau_hinh' => 'Cấu hình',
        ];
    }
}
