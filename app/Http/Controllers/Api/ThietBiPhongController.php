<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ThietBiPhongRequest;
use App\Models\CauHinh;
use App\Models\ThietBiPhong;
use ResponseMau;

class ThietBiPhongController extends Controller {
    use Traits\ReturnError;
    public function taoHoacSua(ThietBiPhongRequest $rq) {
        try {
            $cau_hinh = CauHinh::where('ma_loai', 1)->where('ma_cau_hinh', $rq->ma_cau_hinh)->count();
            if ($cau_hinh == 1) {
                $thiet_bi_phong = ThietBiPhong::updateOrCreate([
                    'ma_phong' => $rq->ma_phong,
                ], [
                    'ma_cau_hinh' => $rq->ma_cau_hinh,
                    'ma_phong'    => $rq->ma_phong,
                ]);
                if ($thiet_bi_phong->wasRecentlyCreated) {
                    return ResponseMau::Store([
                        'string' => ResponseMau::SUCCESS_CREATE,
                    ]);
                } else {
                    return ResponseMau::Store([
                        'string' => ResponseMau::SUCCESS_UPDATE,
                    ]);
                }
                return $this->endCatch();
            }
        } catch (\Exception $e) {
            return $this->endCatch();
        }
    }
    public function xoaThietBi(ThietBiPhongRequest $rq) {
        try {
            $thiet_bi_phong = ThietBiPhong::where('ma_phong', $rq->ma_phong)->delete();
            if ($thiet_bi_phong) {
                return ResponseMau::Store([
                    'string' => ResponseMau::SUCCESS_DELETE,
                ]);
            }
            return $this->endCatchValue(ResponseMau::ERROR_DELETE);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_DELETE);
        }
    }
}
