<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CaRequest;
use App\Http\Resources\CaResource;
use App\Models\Ca;
use Exception;
use ResponseMau;

class CaController extends Controller {
    use Traits\ReturnError;
    public function hienThiTatCa(CaRequest $rq) {
        try {
            if ($rq->has('ma_ca')) {
                $ca = Ca::where('ma_ca', $rq->ma_ca)->get();
            } else {
                $ca = Ca::all();
            }
            return ResponseMau::Store([
                'string' => ResponseMau::SUCCESS_GET,
                'data'   => CaResource::collection($ca),
            ]);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_GET);
        }
    }
    public function caReservedNgayNghi() {
        try {
            $ca = Ca::whereIn('ma_ca', [2, 3, 5, 6])->get();
            return ResponseMau::Store([
                'string' => ResponseMau::SUCCESS_GET,
                'data'   => CaResource::collection($ca),
            ]);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_GET);
        }
    }
}
