<?php

namespace App\Http\Requests;

use App\Rules\PhanCongChiTietRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use RegexRule;

class PhanCongChiTietRequest2 extends FormRequest {
    use Traits\ListError;
    public function rules() {
        return [
            'ma_phan_cong'       => RegexRule::REGEX_EXISTS_MA_PHAN_CONG,
            'thu'                => RegexRule::REGEX_THU,
            'ma_ca'              => RegexRule::REGEX_EXISTS_MA_CA,
            'ma_phong'           => RegexRule::REGEX_EXISTS_MA_PHONG,
            'phan_cong_chi_tiet' => new PhanCongChiTietRule($this->request->all()),
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
    public function withValidator(Validator $validator) {
        $error = $validator->messages();
        if (
            $this->request->has('ma_phan_cong') && !$error->has('ma_phan_cong')
            && $this->request->has('phan_cong_chi_tiet') && !$error->has('phan_cong_chi_tiet')) {
            $after = [];
            foreach ($this->request->get('phan_cong_chi_tiet') as $key => $val) {
                $val['ma_phan_cong'] = $this->request->get('ma_phan_cong');
                array_push($after, $val);
            }
            $this->request->add([
                'phan_cong_chi_tiet' => $after,
            ]);
        }
    }
}
