<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TangRequest;
use App\Http\Resources\TangResource;
use App\Models\Tang;
use Exception;
use ResponseMau;

class TangController extends Controller {
    use Traits\ReturnError;
    public function hienthiCacTang(TangRequest $rq) {
        try {
            $tang = Tang::where(function ($query) use ($rq) {
                if ($rq->has('ma_toa')) {
                    $query->where('ma_toa', $rq->ma_toa);
                } else {
                    if ($rq->has('ma_tang')) {
                        $query->where('ma_tang', $rq->ma_tang);
                    }
                }
                if ($rq->has('ma_tinh_trang')) {
                    $query->where('ma_tinh_trang', $rq->ma_tinh_trang);
                } else {
                    $query->where('ma_tinh_trang', 1);
                }
            })->get();
            return ResponseMau::Store([
                'string' => ResponseMau::SUCCESS_GET,
                'data'   => TangResource::collection($tang),
            ]);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_GET);
        }
    }
    public function taoTang(TangRequest $rq) {
        try {
            $tang = Tang::create($rq->all());
            return ResponseMau::Store([
                'string' => ResponseMau::SUCCESS_CREATE,
                'data'   => new TangResource($tang),
            ]);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_CREATE);
        }
    }
    public function capNhatTang(TangRequest $rq) {
        try {
            $tang = Tang::where('ma_tang', $rq->ma_tang)->update(
                $rq->only((new Tang)->getFillable())
            );
            if ($tang) {
                return ResponseMau::Store([
                    'string' => ResponseMau::SUCCESS_UPDATE,
                    'data'   => new TangResource(Tang::find($rq->ma_tang)),
                ]);
            } else {
                return $this->endCatchValue(ResponseMau::ERROR_TANG_UPDATE_INFO);
            }
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_UPDATE);
        }
    }
    public function kiemTra(TangRequest $rq) {
        return ResponseMau::Store([]);
    }
}
