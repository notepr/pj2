<?php

namespace App\Http\Controllers\Api\Traits;
use Exception;
use ResponseMau;
trait ReturnError {
    public function endCatch() {
        return ResponseMau::Store([
            'string' => ResponseMau::ERROR_NOT_DETERMINED,
            'bool'   => false,
        ]);
    }
    public function error(Exception $e) {
        return ResponseMau::Store([
            'string' => $e->getMessage(),
            'bool'   => false,
        ]);
    }
    public function endCatchValue($mess) {
        return ResponseMau::Store([
            'string' => $mess,
            'bool'   => false,
        ]);
    }
}