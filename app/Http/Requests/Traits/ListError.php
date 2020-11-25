<?php

namespace App\Http\Requests\Traits;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use ResponseMau;
trait ListError {
    public function authorize() {
        return true;
    }
    public function resultError($row) {
        $re = (object) [];
        foreach ($row as $key => $value) {
            $key      = (explode('.', $key))[0];
            $re->$key = $value[0];
        }
        return $re;
    }
    public function defaultMessages() {
        return [
            'exists'         => ResponseMau::RES_KHONG_TON_TAI,
            'regex'          => ResponseMau::RES_KHONG_HOP_LE,
            'unique'         => ResponseMau::RES_DA_TON_TAI,
            'after'          => ResponseMau::RES_PHAI_SAU,
            'distinct'       => ResponseMau::RES_TRUNG_LAP,
            'array'          => ResponseMau::RES_ARRAY,
            'min'            => ResponseMau::RES_ARRAY_MIN,
            'after_or_equal' => ResponseMau::RES_AFTER_OR_EQUAL,
        ];
    }
    public function messages() {
        return [
            'exists'            => ResponseMau::RES_KHONG_TON_TAI,
            'regex'             => ResponseMau::RES_KHONG_HOP_LE,
            'unique'            => ResponseMau::RES_DA_TON_TAI,
            'after'             => ResponseMau::RES_PHAI_SAU,
            'distinct'          => ResponseMau::RES_TRUNG_LAP,
            'array'             => ResponseMau::RES_ARRAY,
            'min'               => ResponseMau::RES_ARRAY_MIN,
            'after_or_equal'    => ResponseMau::RES_AFTER_OR_EQUAL,
            'ngay.regex'        => ':attribute không hợp lệ (ngày/tháng/năm)',
            'ghi_chu.regex'     => ':attribute không hợp lệ (Gồm tiếng việt có thể có dấu hoặc không và từ 0-500 kí tự)',
            'so_cho_ngoi.regex' => ResponseMau::ERROR_PHONG_SO_CHO_NGOI,
            'ten_phong.regex'   => ResponseMau::ERROR_PHONG_TEN_PHONG,
            'so_gio.regex'      => ResponseMau::ERROR_LICH_DAY_BO_SUNG_SO_GIO,
            'so_ngay.regex'     => ResponseMau::ERROR_LICH_DAY_BO_SUNG_SO_NGAY,
        ];
    }
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            ResponseMau::Store([
                'bool'   => false,
                'string' => $this->resultError($validator->messages()->toArray()),
            ])
        );
    }
}