<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ShowCallController;
use App\Http\Controllers\Controller;
use App\Http\Custom\QueryRaw;
use App\Http\Requests\PhanCongChiTietRequest2;
use App\Http\Requests\PhanCongChiTietRequest;
use App\Http\Resources\PhanCongChiTietResource;
use App\Models\PhanCong;
use App\Models\PhanCongChiTiet;
use Exception;
use Illuminate\Http\Request;
use ResponseMau;

class PhanCongChiTietController extends Controller {
    use Traits\ReturnError;
    public function hienThi(PhanCongChiTietRequest $rq) {
        try {
            $phan_cong_ct = PhanCong::where('ma_phan_cong', $rq->ma_phan_cong)
                ->where(function ($query) use ($rq) {
                    if ($rq->cap_do != 1) {
                        $query->where('ma_nguoi_dung', $rq->ma_nguoi_dung);
                    }
                })
                ->first();
            return ResponseMau::Store([
                'string' => ResponseMau::SUCCESS_GET,
                'data'   => (new PhanCongChiTietResource($phan_cong_ct))->toOne(),
            ]);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_GET);
        }
    }
    public function deXuatPcct(PhanCongChiTietRequest $rq) {
        try {
            $phan_cong = PhanCong::where('ma_phan_cong', $rq->ma_phan_cong)
                ->where('tinh_trang', 0)
                ->whereRaw('ma_mon_hoc IS NOT NULL')
                ->whereRaw('ma_lop IS NOT NULL')
                ->first();
            if (empty($phan_cong->ma_nguoi_dung)) {
                return $this->endCatchValue(ResponseMau::ERROR_PCCT_PHAN_CONG);
            }
            $so_sinh_vien = (new ShowCallController)->soSinhVien($phan_cong->ma_lop);
            if (!is_int($so_sinh_vien) || !empty($so_sinh_vien->success)) {
                return $this->endCatchValue(ResponseMau::ERROR_PCCT_SO_SINH_VIEN);
            }
            $so_gio = $rq->so_gio == 4 ? 4 : 2;
            $result = QueryRaw::deXuatPCCT($phan_cong, $so_gio, $so_sinh_vien);
            if (empty($result)) {
                return $this->endCatchValue(ResponseMau::ERROR_PCCT_KHONG_CO_DX);
            } else {
                return ResponseMau::Store([
                    'string' => ResponseMau::SUCCESS_GET,
                    'data'   => (new PhanCongChiTietResource($result))->deXuat(),
                ]);
            }
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_GET);
        }
    }
    public function taoPcct(PhanCongChiTietRequest2 $rq) {
        $rq = new Request($rq->request->all());
        try {
            if (PhanCongChiTiet::insert($rq->phan_cong_chi_tiet)) {
                return ResponseMau::Store([
                    'string' => ResponseMau::SUCCESS_CREATE,
                    'data'   => $rq->phan_cong_chi_tiet,
                ]);
            }
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_CREATE);
        }
    }
    public function xoaPCCT(PhanCongChiTietRequest $rq) {
        try {
            $phan_cong_chi_tiet = PhanCongChiTiet::where('ma_phan_cong', $rq->ma_phan_cong)
                ->where(function ($query) use ($rq) {
                    if ($rq->has('thu')) {
                        $query->where('thu', $rq->thu);
                    }
                    if ($rq->has('ma_ca')) {
                        $query->where('ma_ca', $rq->ma_ca);
                    }
                    if ($rq->has('ma_phong')) {
                        $query->where('ma_phong', $rq->ma_phong);
                    }
                })->delete();
            if ($phan_cong_chi_tiet) {
                return ResponseMau::Store([
                    'string' => ResponseMau::SUCCESS_DELETE,
                ]);
            } else {
                return $this->endCatchValue(ResponseMau::ERROR_DELETE);
            }
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_DELETE);
        }
    }
    public function kiemTra(PhanCongChiTietRequest $rq) {
        return ResponseMau::Store([]);
    }
    public function deXuatTho($rq) {
        $phan_cong = PhanCong::where('ma_phan_cong', $rq->ma_phan_cong)
            ->where('tinh_trang', 0)
            ->whereRaw('ma_mon_hoc IS NOT NULL')
            ->whereRaw('ma_lop IS NOT NULL')
            ->first();
        if (empty($phan_cong->ma_nguoi_dung)) {
            return false;
        }
        $so_sinh_vien = (new ShowCallController)->soSinhVien($phan_cong->ma_lop);
        if (!is_int($so_sinh_vien) || !empty($so_sinh_vien->success)) {
            return false;
        }
        $so_gio = $rq->so_gio == 4 ? 4 : 2;
        $result = QueryRaw::deXuatTho($phan_cong, $so_gio, $so_sinh_vien);
        if (empty($result)) {
            return false;
        } else {
            return $result;
        }
    }
}
