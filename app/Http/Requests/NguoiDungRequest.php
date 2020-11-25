<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use RegexRule;
use ResponseMau;

class NguoiDungRequest extends FormRequest {
    use Traits\ListError;
    public function rules() {
        return [
            'ma'           => RegexRule::REGEX_EXISTS_MA_NGUOI_DUNG,
            'email'        => RegexRule::REGEX_EMAIL_RULE,
            'sdt'          => RegexRule::REGEX_SDT_RULE,
            'tai_khoan'    => RegexRule::REGEX_USER_NAME_RULE,
            'mat_khau'     => RegexRule::REGEX_PASSWORD_RULE,
            'mat_khau_moi' => RegexRule::REGEX_PASSWORD_RULE,
            'ma_cap_do'    => RegexRule::REGEX_MA_CAP_DO,
            'ho_ten'       => RegexRule::REGEX_TEN_LIMIT_100,
        ];
    }
    public function attributes() {
        return [
            'ma'           => 'Người dùng',
            'email'        => 'Email',
            'sdt'          => 'Số điện thoại',
            'tai_khoan'    => 'Tài khoản',
            'mat_khau'     => 'Mật khẩu',
            'mat_khau_moi' => 'Mật khẩu mới',
            'ma_cap_do'    => 'Cấp độ',
            'ho_ten'       => 'Họ tên',
        ];
    }
    public function messages() {
        return array_merge($this->defaultMessages(), [
            'tai_khoan.regex' => ResponseMau::ERROR_USER_NAME,
            'ma_cap_do.regex' => ResponseMau::ERROR_USER_MA_CAP_DO,
        ]);
    }
}
