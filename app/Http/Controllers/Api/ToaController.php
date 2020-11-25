<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ToaRequest;
use App\Http\Resources\ToaResource;
use App\Models\Toa;
use Exception;
use ResponseMau;

class ToaController extends Controller {
    use Traits\ReturnError;
    public function hienThiTatCaToa(ToaRequest $rq) {
        try {
            $toa = Toa::where(function ($query) use ($rq) {
                if ($rq->has('ma_toa')) {
                    $query->where('ma_toa', $rq->ma_toa);
                }
            })->get();
            return ResponseMau::Store([
                'string' => ResponseMau::SUCCESS_GET,
                'data'   => ToaResource::collection($toa),
            ]);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_GET);
        }
    }
    public function capNhatToa(ToaRequest $rq) {
        try {
            if ($rq->has('ma_toa')) {
                $toa = Toa::find($rq->ma_toa)
                    ->update([
                        'ten_toa'       => $rq->get('ten_toa'),
                        'dia_chi'       => $rq->get('dia_chi'),
                        'ma_tinh_trang' => $rq->get('ma_tinh_trang'),
                    ]);
                return ResponseMau::Store([
                    'string' => ResponseMau::SUCCESS_UPDATE,
                    'data'   => new ToaResource(Toa::find($rq->ma_toa)),
                ]);
            } else {
                return $this->endCatchValue(ResponseMau::ERROR_TOA_MA_TOA);
            }
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_UPDATE);
        }
    }
    public function kiemTra(ToaRequest $rq) {
        return ResponseMau::Store([]);
    }
}
