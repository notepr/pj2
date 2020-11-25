<?php

namespace App\Rules;

use App\Http\Controllers\Api\ShowCallController;
use Illuminate\Contracts\Validation\Rule;
use ResponseMau;

class MaLopRule implements Rule {
    public function passes($attribute, $value) {
        $data = (new ShowCallController)->lopCheck($value);
        if (isset($data->scalar)) {
            return $data->scalar;
        }
        return $data->success;
    }
    public function message() {
        return ResponseMau::RES_KHONG_TON_TAI;
    }
}
