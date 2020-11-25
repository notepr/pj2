<?php

namespace App\Rules;

use App\Http\Controllers\Api\PhanCongChiTietController;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use ResponseMau;

class PhanCongChiTietRule implements Rule {
    private $rq;
    public function __construct($rq) {
        $this->rq = new Request($rq);
    }
    public function passes($attribute, $value) {
        if (empty($value) && !is_array($value)) {
            return false;
        }
        $result = (new PhanCongChiTietController)->deXuatTho($this->rq);
        if ($result == false) {
            return false;
        }
        $result = array_map(function ($value) {
            return (array) $value;
        }, $result);
        foreach ($value as $key => $val) {
            if (!in_array($val, $result)) {
                return false;
            }
        }
        return true;
    }
    public function message() {
        return ResponseMau::ERROR_PCCT_ADD_PCCT;
    }
}
