<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NguoiDungBoMonRequest;
use App\Http\Resources\NguoiDungBoMonResource;
use App\Models\NguoiDung;
use App\Models\NguoiDungBoMon;
use App\Models\PhanCong;
use ResponseMau;

class NguoiDungBoMonController extends Controller {
    use Traits\ReturnError;
    public function hienThi(NguoiDungBoMonRequest $rq) {
        try {
            $nguoi_dung_bo_mon = NguoiDung::where(function ($query) use ($rq) {
                if ($rq->cap_do == 1) {
                    if ($rq->has('ma_giao_vien')) {
                        if (is_array($rq->ma_giao_vien)) {
                            $query->whereIn('ma_nguoi_dung', $rq->ma_giao_vien);
                        } else {
                            $query->where('ma_nguoi_dung', $rq->ma_giao_vien);
                        }
                    }
                } else {
                    $query->where('ma_nguoi_dung', $rq->ma_nguoi_dung);
                }
            })
                ->with(['nguoiDungBoMon' => function ($query) {
                    $query->with(['monHoc' => function ($q) {
                        $q->select('ma_mon_hoc', 'ten_mon_tieng_viet', 'ten_mon_tieng_anh');
                    }]);
                }])
                ->whereHas('nguoiDungBoMon')
                ->select('ma_nguoi_dung', 'ho_ten', 'email')
                ->withCount('nguoiDungBoMon as so_mon_day_duoc')
                ->orderBy('so_mon_day_duoc', 'DESC')
                ->get();
            return ResponseMau::Store([
                'string' => ResponseMau::SUCCESS_GET,
                'data'   => NguoiDungBoMonResource::collection($nguoi_dung_bo_mon),
            ]);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_GET);
        }
    }
    public function giaoVienSoMon(NguoiDungBoMonRequest $rq) {
        try {
            $nguoi_dung_bo_mon = NguoiDung::where(function ($query) use ($rq) {
                if ($rq->cap_do == 1) {
                    if ($rq->has('ma_giao_vien')) {
                        $query->whereIn('ma_nguoi_dung', $rq->ma_giao_vien);
                    }
                } else {
                    $query->where('ma_nguoi_dung', $rq->ma_nguoi_dung);
                }
            })
                ->select('ma_nguoi_dung', 'ho_ten', 'email')
                ->withCount('nguoiDungBoMon as so_mon_day_duoc')
                ->orderBy('so_mon_day_duoc', 'DESC')
                ->get();
            return ResponseMau::Store([
                'string' => ResponseMau::SUCCESS_GET,
                'data'   => $nguoi_dung_bo_mon,
            ]);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_GET);
        }
    }
    public function themHoacSua(NguoiDungBoMonRequest $rq) {
        try {
            $data   = (object) ['create' => [], 'exists' => []];
            $insert = [];
            foreach (array_unique($rq->ma_giao_vien) as $key => $ma_giao_vien) {
                $nguoi_dung_bo_mon = NguoiDungBoMon::where('ma_nguoi_dung', $ma_giao_vien)
                    ->whereDoesntHave('monHoc', function ($query) use ($ma_giao_vien) {
                        $query->whereHas('phanCong', function ($q) use ($ma_giao_vien) {
                            $q->where('ma_nguoi_dung', $ma_giao_vien);
                            $q->where('tinh_trang', 0);
                        });
                    })
                    ->delete();
                $array_mon_hoc = NguoiDungBoMon::where('ma_nguoi_dung', $ma_giao_vien)
                    ->whereIn('ma_mon_hoc', $rq->ma_mon_hoc)
                    ->get();
                $list_mon_hoc = [];
                foreach ($array_mon_hoc as $key => $value) {
                    array_push($data->exists, $value->toArray());
                    array_push($list_mon_hoc, $value->ma_mon_hoc);
                }
                $array_mon_hoc = array_diff(array_unique($rq->ma_mon_hoc), $list_mon_hoc);
                foreach ($array_mon_hoc as $key => $ma_mon_hoc) {
                    $cache = [
                        'ma_nguoi_dung' => $ma_giao_vien,
                        'ma_mon_hoc'    => $ma_mon_hoc,
                    ];
                    array_push($data->create, $cache);
                }
            }
            NguoiDungBoMon::insert($data->create);
            return ResponseMau::Store([
                'string' => "Cập nhật thành công , Các môn đang được phân công sẽ tự động được chọn",
                'data'   => $data,
            ]);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_UPDATE);
        }
    }
    public function kiemTra(NguoiDungBoMonRequest $rq) {
        return ResponseMau::Store([]);
    }
    public function cloneWithPhanCong() {
        try {
            $phan_cong = PhanCong::whereNotNull(['ma_nguoi_dung', 'ma_mon_hoc'])
                ->select('ma_mon_hoc', 'ma_nguoi_dung')
                ->distinct()
                ->get();
            $a = NguoiDungBoMon::insert($phan_cong->toArray());
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
