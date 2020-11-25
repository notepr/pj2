<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\CauHinhController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CauHinhMonRequest;
use App\Http\Resources\CauHinhMonResource;
use App\Models\CauHinhMon;
use DB;
use Exception;
use ResponseMau;

class CauHinhMonController extends Controller {
    use Traits\ReturnError;
    public function danhSachCauHinhCoCHM(CauHinhMonRequest $rq) {
        try {
            $cau_hinh_mon = CauHinhMon::select('ma_cau_hinh')
                ->groupBy('ma_cau_hinh')
                ->get();
            return ResponseMau::Store([
                'data'   => (new CauHinhMonResource($cau_hinh_mon))->cauHinhCoMonHoc(),
                'string' => ResponseMau::SUCCESS_GET,
            ]);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_GET);
        }
    }
    public function hienThiDanhSachMon(CauHinhMonRequest $rq) {
        try {
            $return_data  = (object) ['cau_hinh' => null, 'list_mon' => null];
            $cau_hinh_mon = CauHinhMon::where('ma_cau_hinh', $rq->get('ma_cau_hinh'))->get();
            if ($cau_hinh_mon->count() == 0) {
                return $this->endCatchValue(ResponseMau::ERROR_CAU_HINH_MON);
            }
            $return_data->cau_hinh = (new CauHinhController())->layThongTinCauHinh($rq->get('ma_cau_hinh'));
            $return_data->list_mon = CauHinhMonResource::collection($cau_hinh_mon);
            return ResponseMau::Store([
                'data'   => $return_data,
                'string' => ResponseMau::SUCCESS_GET,
            ]);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_GET);
        }
    }
    public function monHocDuocTheoCauHinh(CauHinhMonRequest $rq) {
        try {
            $data = DB::select(DB::raw("SELECT DISTINCT phan_cong.ma_mon_hoc
                FROM phong as p
                INNER JOIN phan_cong_chi_tiet on p.ma_phong = phan_cong_chi_tiet.ma_phong
                INNER JOIN phan_cong on phan_cong.ma_phan_cong = phan_cong_chi_tiet.ma_phan_cong
                WHERE p.ma_phong IN (SELECT DISTINCT ma_phong FROM phan_cong_chi_tiet)
                HAVING (
                SELECT thiet_bi_phong.ma_cau_hinh FROM `thiet_bi_phong`
                    INNER JOIN cau_hinh ON cau_hinh.ma_cau_hinh = thiet_bi_phong.ma_cau_hinh AND cau_hinh.ma_loai = 1
                    WHERE ma_phong = p.ma_phong
                    GROUP BY ma_cau_hinh
                    ORDER BY COUNT(*) DESC
                    LIMIT 1
                ) = $rq->ma_cau_hinh"));
            $array_ma_mon_hoc = [];
            foreach ($data as $key => $value) {
                array_push($array_ma_mon_hoc, $value->ma_mon_hoc);
            }
            $cau_hinh_mon = CauHinhMon::where('ma_cau_hinh', $rq->ma_cau_hinh)
                ->whereNotIn('ma_mon_hoc', $array_ma_mon_hoc)
                ->delete();
            $data = [];
            if (is_array($rq->get('ma_mon_hoc'))) {
                $array_ma_mon_hoc_moi = array_diff(array_unique($rq->ma_mon_hoc), $array_ma_mon_hoc);
                foreach ($array_ma_mon_hoc_moi as $key => $ma_mon_hoc) {
                    $cache = [
                        'ma_cau_hinh' => $rq->get('ma_cau_hinh'),
                        'ma_mon_hoc'  => $ma_mon_hoc,
                    ];
                    array_push($data, $cache);
                }
                CauHinhMon::insert($data);
                return ResponseMau::Store([
                    'string' => ResponseMau::SUCCESS_UPDATE,
                ]);
            }
            return $this->endCatchValue(ResponseMau::ERROR_UPDATE);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_UPDATE);
        }
    }
    public function kiemTra(CauHinhMonRequest $rq) {
        return ResponseMau::Store([]);
    }
}
