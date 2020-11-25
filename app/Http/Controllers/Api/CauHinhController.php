<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CauHinhRequest;
use App\Http\Resources\CauHinhResource;
use App\Models\CauHinh;
use Exception;
use ResponseMau;

class CauHinhController extends Controller {
    use Traits\ReturnError;
    public function hienThi(CauHinhRequest $rq) {
        try {
            $cau_hinh = CauHinh::where(function ($query) use ($rq) {
                if ($rq->has('ma_loai')) {
                    $query->where('ma_loai', $rq->get('ma_loai'));
                } else {
                    if ($rq->has('ma_cau_hinh')) {
                        $query->where('ma_cau_hinh', $rq->ma_cau_hinh);
                    }
                }
            })->get();
            return ResponseMau::Store([
                'string' => ResponseMau::SUCCESS_GET,
                'data'   => CauHinhResource::collection($cau_hinh),
            ]);
        } catch (\Exception $e) {
            return $this->endCatchValue(R1esponseMau::ERROR_GET);
        }
    }
    public function hienThiCase(CauHinhRequest $rq) {
        try {
            $cau_hinh = CauHinh::where('ma_cau_hinh', $rq->get('ma_cau_hinh'))
                ->where('ma_loai', 1)
                ->first();
            if (!is_null($cau_hinh)) {
                return ResponseMau::Store([
                    'data'   => (new CauHinhResource($cau_hinh))->infoCase(),
                    'string' => ResponseMau::SUCCESS_GET,
                ]);
            } else {
                return $this->endCatchValue(ResponseMau::ERROR_CAU_HINH_CASE);
            }
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_GET);
        }
    }
    public function themCauHinh(CauHinhRequest $rq) {
        try {
            if ($rq->get('ma_loai') != 1) {
                if ($this->cauHinhExists($rq->ma_loai, $rq->mo_ta)) {
                    $cau_hinh = CauHinh::create($rq->all());
                } else {
                    return $this->endCatchValue(ResponseMau::ERROR_CAU_HINH_DA_TON_TAI);
                }
            } else {
                $cau_hinh          = new CauHinh();
                $cau_hinh->mo_ta   = $this->prossCase($rq);
                $cau_hinh->ma_loai = $rq->get('ma_loai');
                if ($this->cauHinhExists($rq->ma_loai, $cau_hinh->mo_ta)) {
                    $cau_hinh->save();
                } else {
                    return $this->endCatchValue(ResponseMau::ERROR_CAU_HINH_DA_TON_TAI);
                }
            }
            return ResponseMau::Store([
                'string' => ResponseMau::SUCCESS_CREATE,
                'data'   => new CauHinhResource($cau_hinh),
            ]);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_CAU_HINH_TAO);
        }
    }
    public function capNhatCauHinh(CauHinhRequest $rq) {
        try {
            $cau_hinh = CauHinh::find($rq->get('ma_cau_hinh'));
            if ($rq->get('ma_loai') != 1) {
                if ($this->cauHinhExists($rq->ma_loai, $rq->mo_ta)) {
                    $cau_hinh->update($rq->all());
                } else {
                    return $this->endCatchValue(ResponseMau::ERROR_CAU_HINH_UPDATE);
                }
            } else {
                $cau_hinh->mo_ta   = $this->prossCase($rq);
                $cau_hinh->ma_loai = $rq->get('ma_loai');
                if ($this->cauHinhExists($rq->ma_loai, $cau_hinh->mo_ta)) {
                    $cau_hinh->save();
                } else {
                    return $this->endCatchValue(ResponseMau::ERROR_CAU_HINH_UPDATE);
                }
            }
            return ResponseMau::Store([
                'string' => ResponseMau::SUCCESS_UPDATE,
                'data'   => new CauHinhResource($cau_hinh),
            ]);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_UPDATE);
        }
    }
    public function layThongTinCauHinh($ma_cau_hinh) {
        try {
            return new CauHinhResource(
                CauHinh::find($ma_cau_hinh)
            );
        } catch (\Exception $e) {
            return "null";
        }
    }
    public function prossCase($rq) {
        $du_lieu = ['cpu', 'ram', 'main', 'o_cung', 'vga'];
        $re      = '';
        foreach ($rq->only($du_lieu) as $key => $value) {
            $re = $re . "`" . strtoupper($key) . ":$value`";
        }
        return $re;
    }
    public function cauHinhExists($ma_loai, $mo_ta) {
        $cau_hinh = CauHinh::where('mo_ta', $mo_ta)
            ->where('ma_loai', $ma_loai)
            ->get();
        if (empty($cau_hinh->toArray())) {
            return true;
        }
        return false;
    }
    public function kiemTra(CauHinhRequest $rq) {
        return ResponseMau::Store([]);
    }
}
