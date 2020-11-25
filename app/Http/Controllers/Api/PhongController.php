<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhongRequest;
use App\Http\Resources\PhongResource;
use App\Models\Phong;
use ResponseMau;

class PhongController extends Controller {
    use Traits\ReturnError;
    public function getPhongTheoTang(PhongRequest $rq) {
        try {
            $phong = Phong::where(function ($query) use ($rq) {
                if ($rq->has('ma_tang')) {
                    $query->where('ma_tang', $rq->ma_tang);
                } else {
                    $query->where('ma_phong', $rq->ma_phong);
                }
            })
                ->with(['thietBiPhong' => function ($query) {
                    $query->with(['cauHinh' => function ($q) {
                        $q->where('ma_loai', 1);
                        $q->select('ma_cau_hinh', 'mo_ta');
                    }]);
                    $query->select('ma_phong', 'ma_cau_hinh');
                }])
                ->get();
            // return $phong;
            return ResponseMau::Store([
                'string' => ResponseMau::SUCCESS_GET,
                'data'   => PhongResource::collection($phong),
            ]);
        } catch (\Exception $e) {
            dd($e);
            return $this->endCatchValue(ResponseMau::ERROR_GET);
        }
    }
    public function taoHoacCapNhatPhong(PhongRequest $rq) {
        try {
            $phong = Phong::updateOrCreate(
                [
                    'ma_phong' => $rq->ma_phong,
                ],
                $rq->only((new Phong)->getFillable())
            );
            if ($phong->wasRecentlyCreated) {
                return ResponseMau::Store([
                    'string' => ResponseMau::SUCCESS_CREATE,
                    'data'   => new PhongResource($phong),
                ]);
            } else {
                if (count($phong->getChanges()) != 0) {
                    return ResponseMau::Store([
                        'string' => ResponseMau::SUCCESS_UPDATE,
                        'data'   => new PhongResource($phong),
                    ]);
                } else {
                    return ResponseMau::Store([
                        'string' => ResponseMau::SUCCESS_NO_DATA_UPDATE,
                        'data'   => new PhongResource($phong),
                    ]);
                }
            }
            return $this->endCatch();
        } catch (\Exception $e) {
            return $this->endCatch();
        }
    }
    public function xoaPhong(PhongRequest $rq) {
        try {
            if ($rq->has('ma_phong')) {
                $phong = Phong::where('ma_phong', $rq->ma_phong)
                    ->whereDoesntHave('phanCongChiTiet', function ($query) {
                        $query->whereHas('phanCong', function ($q) {
                            $q->where('tinh_trang', 0);
                        });
                    })
                    ->whereDoesntHave('lichDayBoSung', function ($query) {
                        $query->where('tinh_trang', 1);
                        $query->where('ngay', '>=', date("Y-m-d"));
                    })
                    ->whereDoesntHave('thietBiPhong')
                    ->delete();
                if ($phong) {
                    return ResponseMau::Store([
                        'string' => ResponseMau::SUCCESS_DELETE,
                    ]);
                }
                return $this->endCatchValue(ResponseMau::ERROR_PHONG_DELETE);
            }
            return $this->endCatchValue(ResponseMau::ERROR_DELETE);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_DELETE);
        }
    }
    public function hienThiPhong(PhongRequest $rq) {
        try {
            $phong = Phong::find($rq->ma_phong);
            dd((new PhongResource($phong))->motPhong());
        } catch (\Exception $e) {

        }
    }
    public function kiemTra(PhongRequest $rq) {
        return ResponseMau::Store([]);
    }
}
