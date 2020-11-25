<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ShowCallController;
use App\Http\Controllers\Controller;
use App\Http\Custom\QueryRaw;
use App\Http\Requests\LichDayBoSungRequest;
use App\Http\Resources\LichDayBoSungResource;
use App\Models\Ca;
use App\Models\LichDayBoSung;
use Exception;
use Illuminate\Http\Request;
use ResponseMau;

class LichDayBoSungController extends Controller {
    use Traits\ReturnError;
    public function hienThi(LichDayBoSungRequest $rq) {
        try {
            $rq               = new Request($rq->request->all());
            $lich_day_bo_sung = LichDayBoSung::where(function ($q) use ($rq) {
                if ($rq->cap_do == 1) {
                    if ($rq->has('ma_giao_vien')) {
                        $q->where('ma_nguoi_dung', $rq->ma_giao_vien);
                    }
                } else {
                    $q->where('ma_nguoi_dung', $rq->ma_nguoi_dung);
                }
                if ($rq->has('tinh_trang')) {
                    $q->where('tinh_trang', $rq->tinh_trang);
                } else {
                    $q->where('tinh_trang', 1);
                }
                if ($rq->has('ngay')) {
                    $q->where('ngay', $rq->ngay);
                } else {
                    $q->where('ngay', '>=', date("Y-m-d"));
                }
                if ($rq->has('ma_lich_day_bo_sung')) {
                    $q->where('ma_lich_day_bo_sung', $rq->ma_lich_day_bo_sung);
                }
            })->get();
            return ResponseMau::Store([
                'string' => ResponseMau::SUCCESS_GET,
                'data'   => LichDayBoSungResource::collection($lich_day_bo_sung),
            ]);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_GET);
        }
    }
    public function deXuatLich(LichDayBoSungRequest $rq) {
        try {
            $rq           = new Request($rq->request->all());
            $so_sinh_vien = (new ShowCallController)->soSinhVien($rq->ma_lop);
            $so_gio       = $rq->so_gio == 4 ? 4 : 2;
            $so_ngay      = $rq->has('so_ngay') ? $rq->so_ngay : 7;
            $ngay         = $rq->has('ngay') ? $rq->ngay : date("Y-m-d");
            if ($rq->cap_do == 1) {
                $ma_giao_vien = $rq->ma_giao_vien;
            } else {
                $ma_giao_vien = $rq->ma_nguoi_dung;
            }
            if (!is_int($so_sinh_vien) || !empty($so_sinh_vien->success)) {
                return $this->endCatchValue(ResponseMau::ERROR_PCCT_SO_SINH_VIEN);
            }
            $data = [];
            for ($i = 0; $i < $so_ngay; $i++) {
                $result      = QueryRaw::deXuatLichDayBoSungTho($ngay, $ma_giao_vien, $rq->ma_mon_hoc, $so_gio, $rq->ma_lop, $so_sinh_vien);
                $data[$ngay] = $result;
                $ngay        = date('Y-m-d', strtotime("+1 day", strtotime($ngay)));
            }
            return ResponseMau::Store([
                'string' => ResponseMau::SUCCESS_GET,
                'data'   => $data,
            ]);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_GET);
        }
    }
    public function themLich(LichDayBoSungRequest $rq) {
        try {
            $rq           = new Request($rq->request->all());
            $so_sinh_vien = (new ShowCallController)->soSinhVien($rq->ma_lop);
            $so_gio       = Ca::where('ma_ca', $rq->ma_ca)->selectRaw("HOUR(TIMEDIFF(gio_ket_thuc,gio_bat_dau)) as gio")->first()->gio;
            $ngay         = $rq->ngay;
            if (!$rq->has('ma_phong')) {
                return $this->endCatchValue(ResponseMau::ERROR_PROPOSED);
            } else {
                $ma_phong = $rq->ma_phong;
            }
            if (!is_int($so_sinh_vien) || !empty($so_sinh_vien->success)) {
                return $this->endCatchValue(ResponseMau::ERROR_PCCT_SO_SINH_VIEN);
            }
            $result = QueryRaw::deXuatLichDayBoSungTho($ngay, $rq->ma_giao_vien, $rq->ma_mon_hoc, $so_gio, $rq->ma_lop, $so_sinh_vien);
            if (count($result) == 0) {
                return $this->endCatchValue(ResponseMau::ERROR_PROPOSED);
            }
            foreach ($result as $key => $phan_cong) {
                if ($phan_cong->ma_phong == $ma_phong &&
                    $phan_cong->ma_ca == $rq->ma_ca) {
                    $lich_day_bo_sung = LichDayBoSung::updateOrCreate(
                        [
                            'ngay'          => $rq->ngay,
                            'ma_nguoi_dung' => $rq->ma_giao_vien,
                            'ma_phong'      => $phan_cong->ma_phong,
                            'ma_lop'        => $rq->ma_lop,
                            'ma_ca'         => $phan_cong->ma_ca,
                            'ma_mon_hoc'    => $rq->ma_mon_hoc,
                        ],
                        [
                            'tinh_trang' => 1,
                            'ghi_chu'    => $rq->ghi_chu,
                        ]
                    );
                    if ($lich_day_bo_sung->wasRecentlyCreated) {
                        return ResponseMau::Store([
                            'string' => ResponseMau::SUCCESS_CREATE,
                        ]);
                    } else {
                        if (count($lich_day_bo_sung->getChanges()) != 0) {
                            return ResponseMau::Store([
                                'string' => ResponseMau::ERROR_LICH_DAY_BO_SUNG_CREATE_UPDATE,
                            ]);
                        }
                    }
                }
            }
            return $this->endCatchValue(ResponseMau::ERROR_PROPOSED);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_CREATE);
        }
    }
    public function suaLich(LichDayBoSung $lichDayBoSung) {

    }
    public function xoaLich(LichDayBoSungRequest $rq) {
        try {
            $lich_day_bo_sung = LichDayBoSung::find($rq->ma_lich_day_bo_sung);
            if ($lich_day_bo_sung->ngay >= date('Y-m-d')) {
                if ($lich_day_bo_sung->delete()) {
                    return ResponseMau::Store([
                        'string' => ResponseMau::SUCCESS_DELETE,
                    ]);
                }
                return $this->endCatchValue(ResponseMau::ERROR_DELETE);
            }
            return $this->endCatchValue(ResponseMau::ERROR_LICH_DAY_BO_SUNG_DELETE);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_DELETE);
        }
    }
    public function kiemTra(LichDayBoSungRequest $rq) {
        return ResponseMau::Store([]);
    }
}
