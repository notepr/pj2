<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use RegexRule;

class CaRequest extends FormRequest {
    use Traits\ListError;
    public function rules() {
        return [
            'ma_ca' => RegexRule::REGEX_EXISTS_MA_CA,
        ];
    }
    public function attributes() {
        return [
            'ma_ca' => 'Ca',
        ];
    }
}
