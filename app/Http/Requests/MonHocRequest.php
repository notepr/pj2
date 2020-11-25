<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use RegexRule;

class MonHocRequest extends FormRequest {
    use Traits\ListError;
    public function rules() {
        return [
            'ma_mon_hoc' => RegexRule::REGEX_MON_HOC_MA_MON_HOC,
        ];
    }
    public function attributes() {
        return [
            'ma_mon_hoc' => 'Môn học',
        ];
    }
}
