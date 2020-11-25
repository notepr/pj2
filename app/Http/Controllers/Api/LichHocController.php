<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ShowCallController;
use App\Http\Controllers\Controller;
use App\Http\Requests\LichHocRequest;
use App\Http\Resources\LichHocResource;
use App\Models\LichDayBoSung;
use App\Models\MonHoc;
use App\Models\NgayNghi;
use App\Models\PhanCong;
use App\Models\PhanCongChiTiet;
use App\Models\Phong;
use Arr;
use DB;
use ResponseMau;

class LichHocController extends Controller {
    use Traits\ReturnError;
    public function lichPhongTrong(LichHocRequest $rq) {
        try {
            $so_gio    = $rq->so_gio == 4 ? 4 : 2;
            $so_ngay   = $rq->has('so_ngay') ? $rq->so_ngay : 7;
            $hom_nay   = date("Y-m-d");
            $phan_cong = PhanCong::where('tinh_trang', 0)
                ->whereHas('phanCongChiTiet', function ($query) use ($rq) {
                    $query->whereHas('phong', function ($q) use ($rq) {
                        $q->where('ma_tinh_trang', 1);
                        $q->where(function ($qu) use ($rq) {
                            if (is_array($rq->ma_phong)) {
                                $qu->whereNotIn('ma_phong', $rq->ma_phong);
                            } else {
                                $qu->where('ma_phong', '<>', $rq->ma_phong);
                            }
                        });
                    });
                })
                ->select('ma_lop', 'ma_mon_hoc', 'ma_phan_cong', 'ma_nguoi_dung')
                ->get();
            $array_ma_nguoi_dung = $phan_cong->map(function ($item) {
                return $item->ma_nguoi_dung;
            })->unique();
            $lich_phong = [];
            if (count($phan_cong) != 0) {
                $lich_day = (new ShowCallController)->checkOnCuArray($phan_cong->toArray());
                foreach ($lich_day as $key => $lich) {
                    $lich               = (object) $lich;
                    $lich->phan_cong    = (object) $lich->phan_cong;
                    $ngay_nghi          = $this->getNgayNghi($lich->phan_cong->ma_nguoi_dung, date("Y-m-d"));
                    $phan_cong_chi_tiet = PhanCongChiTiet::where('ma_phan_cong', $lich->phan_cong->ma_phan_cong)
                        ->join('ca', 'phan_cong_chi_tiet.ma_ca', '=', 'ca.ma_ca')
                        ->with(['phong' => function ($query) {
                            $query->select('ma_phong', 'ten_phong');
                        }])
                        ->select('thu', 'ca.ma_ca', 'ma_phong', 'ca.gio_bat_dau', 'ca.gio_ket_thuc')
                        ->addSelect(DB::raw("(((MINUTE(ca.gio_ket_thuc)+hour(ca.gio_ket_thuc)*60)-(MINUTE(ca.gio_bat_dau)+hour(ca.gio_bat_dau)*60))/60) as so_gio"))
                        ->get();
                    $nguoi_dung = (new PhanCong((array) $lich->phan_cong))->nguoiDung;
                    if ($phan_cong_chi_tiet->count() != 0) {
                        $gio_da_day = $lich->gio_da_day ?? 0;
                        $rt         = $this->checkLichHoc($lich->phan_cong, $ngay_nghi, $phan_cong_chi_tiet, $gio_da_day);
                        $rt         = array_map(function ($item) use ($nguoi_dung) {
                            $item = (object) $item;
                            return [
                                'ngay'          => $item->ngay,
                                'ma_phong'      => $item->ma_phong,
                                'ma_ca'         => $item->ma_ca,
                                'so_gio'        => $item->so_gio ?? NULL,
                                'ma_nguoi_dung' => $nguoi_dung->ma_nguoi_dung,
                            ];
                        }, $rt);
                        $lich_phong = array_merge($lich_phong, $rt);
                    }
                }
            }
            $ngay_nghi        = $this->getNgayNghiMuti($array_ma_nguoi_dung, date("Y-m-d"));
            $lich_day_bo_sung = LichDayBoSung::whereNotIn('ma_phong', $rq->ma_phong)
                ->where('tinh_trang', 1)
                ->where('lich_day_bo_sung.ngay', '>=', date("Y-m-d"))
                ->join('ca', 'lich_day_bo_sung.ma_ca', '=', 'ca.ma_ca')
                ->select('ngay', 'ma_lop', 'ma_mon_hoc', 'lich_day_bo_sung.ma_ca', 'lich_day_bo_sung.ma_phong', 'gio_bat_dau', 'gio_ket_thuc', 'ghi_chu', 'lich_day_bo_sung.ma_nguoi_dung')
                ->addSelect(DB::raw("(((MINUTE(ca.gio_ket_thuc)+hour(ca.gio_ket_thuc)*60)-(MINUTE(ca.gio_bat_dau)+hour(ca.gio_bat_dau)*60))/60) as so_gio"))
                ->get();
            $lich_day_bo_sung_hop_le = $this->checkLichDayBoSungMutiWithNgayNghi($lich_day_bo_sung, $ngay_nghi);
            if (count($lich_day_bo_sung_hop_le) != 0) {
                $lich_day_bo_sung_hop_le = array_map(function ($item) {
                    $item = (object) $item;
                    return [
                        'ngay'          => $item->ngay,
                        'ma_phong'      => $item->ma_phong,
                        'ma_ca'         => $item->ma_ca,
                        'so_gio'        => $item->so_gio ?? NULL,
                        'ma_nguoi_dung' => $item->ma_nguoi_dung,
                    ];
                }, $lich_day_bo_sung_hop_le);
                $lich_phong = array_merge($lich_phong, $lich_day_bo_sung_hop_le);
            }
            $phong = Phong::where('ma_tinh_trang', 1)
                ->where(function ($qu) use ($rq) {
                    if (is_array($rq->ma_phong)) {
                        $qu->whereNotIn('ma_phong', $rq->ma_phong);
                    } else {
                        $qu->where('ma_phong', '<>', $rq->ma_phong);
                    }
                });
            if ($phong->count() == 0) {
                return $this->endCatchValue(ResponseMau::ERROR_GET);
            }
            $ngay_nghi = NgayNghi::where('ngay', '>=', $hom_nay)
                ->where('tinh_trang', 1)
                ->where('ma_giao_vien', 0)
                ->select('ngay', 'ma_ca')
                ->get()
                ->crossJoin($phong->select('ma_phong')->get()->toArray())
                ->map(function ($item) {
                    $data           = (object) [];
                    $ngay_nghi      = (object) $item[0];
                    $data->ngay     = $ngay_nghi->ngay;
                    $data->ma_phong = ((object) $item[1])->ma_phong;
                    $data->ma_ca    = $ngay_nghi->ma_ca;
                    return (array) $data;
                })->toArray();
            $lich_phong = array_merge($lich_phong, $ngay_nghi);
            $lich_phong = array_values(Arr::where($lich_phong, function ($item_lich_phong, $key) use ($hom_nay, $so_ngay, $so_gio) {
                $item_lich_phong = (object) $item_lich_phong;
                if ($item_lich_phong->ngay >= $hom_nay && $item_lich_phong->ngay < date('Y-m-d', strtotime($hom_nay . "+$so_ngay days"))) {
                    return $item_lich_phong;
                }
            }));
            $lich_phong_convent = [];
            foreach ($lich_phong as $key => $lich) {
                $ca_convent = $this->conventCa((object) $lich, $so_gio);
                foreach ($ca_convent as $key => $ca) {
                    array_push($lich_phong_convent, $ca);
                }
            }
            $array_ngay_xu_ly = $this->getArrayNgayXuLy($so_ngay, $hom_nay);
            $array_co_dinh    = $phong->crossJoin('ca')
                ->select('ma_phong', 'ca.ma_ca', 'ten_phong', 'ca.gio_bat_dau', 'ca.gio_ket_thuc')
                ->addSelect(DB::raw("(((MINUTE(ca.gio_ket_thuc)+hour(ca.gio_ket_thuc)*60)-(MINUTE(ca.gio_bat_dau)+hour(ca.gio_bat_dau)*60))/60) as so_gio"))
                ->having('so_gio', $so_gio)
                ->get()->crossJoin($array_ngay_xu_ly)->map(function ($item) {
                $data               = (object) [];
                $phong              = (object) $item[0];
                $data->ngay         = $item[1];
                $data->ma_phong     = $phong->ma_phong;
                $data->ten_phong    = $phong->ten_phong;
                $data->ma_ca        = $phong->ma_ca;
                $data->gio_bat_dau  = $phong->gio_bat_dau;
                $data->gio_ket_thuc = $phong->gio_ket_thuc;
                return $data;
            });
            $array_return       = [];
            $lich_phong_convent = array_unique($lich_phong_convent, SORT_REGULAR);
            foreach ($array_co_dinh as $key => $co_dinh) {
                $array_ss = ['ngay' => $co_dinh->ngay, 'ma_phong' => $co_dinh->ma_phong, 'ma_ca' => $co_dinh->ma_ca];
                if (in_array($array_ss, $lich_phong_convent)) {
                    continue;
                } else {
                    array_push($array_return, $co_dinh);
                }
            }
            // $array_return       = collect($array_return)->sortBy('ngay')->groupBy('ngay')->toArray();
            // $lich_phong_convent = collect($lich_phong_convent)->sortBy('ngay')->groupBy('ngay')->toArray();
            // $array_co_dinh      = collect($array_co_dinh)->sortBy('ngay')->groupBy('ngay')->toArray();
            // dd($array_return, $lich_phong_convent, $array_co_dinh);
            return ResponseMau::Store([
                'string' => ResponseMau::SUCCESS_GET,
                'data'   => (new LichHocResource($array_return))->phongTrong(),
            ]);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_GET);
        }
    }
    public function lichPhong(LichHocRequest $rq) {
        try {
            $phong = Phong::where('ma_tinh_trang', 1)->find($rq->ma_phong);
            if (is_null($phong)) {
                return $this->endCatchValue("Phòng bạn chọn đã hủy hoặc không tồn tại");
            }
            $phan_cong = PhanCong::where('tinh_trang', 0)
                ->whereHas('phanCongChiTiet', function ($query) use ($rq) {
                    $query->where('ma_phong', $rq->ma_phong);
                })
                ->select('ma_lop', 'ma_mon_hoc', 'ma_phan_cong', 'ma_nguoi_dung')
                ->get()
                ->toArray();
            $lich_phong = [];
            if (count($phan_cong) != 0) {
                $lich_day = (new ShowCallController)->checkOnCuArray($phan_cong);
                foreach ($lich_day as $key => $lich) {
                    $lich               = (object) $lich;
                    $lich->phan_cong    = (object) $lich->phan_cong;
                    $ngay_nghi          = $this->getNgayNghi($lich->phan_cong->ma_nguoi_dung, date("Y-m-d"));
                    $phan_cong_chi_tiet = PhanCongChiTiet::where('ma_phan_cong', $lich->phan_cong->ma_phan_cong)
                        ->join('ca', 'phan_cong_chi_tiet.ma_ca', '=', 'ca.ma_ca')
                        ->with(['phong' => function ($query) {
                            $query->select('ma_phong', 'ten_phong');
                        }])
                        ->select('thu', 'ca.ma_ca', 'ma_phong', 'ca.gio_bat_dau', 'ca.gio_ket_thuc')
                        ->addSelect(DB::raw("(((MINUTE(ca.gio_ket_thuc)+hour(ca.gio_ket_thuc)*60)-(MINUTE(ca.gio_bat_dau)+hour(ca.gio_bat_dau)*60))/60) as so_gio"))
                        ->get();
                    $nguoi_dung = (new PhanCong((array) $lich->phan_cong))->nguoiDung;
                    if ($phan_cong_chi_tiet->count() != 0) {
                        $gio_da_day = $lich->gio_da_day ?? 0;
                        $rt         = $this->checkLichHoc($lich->phan_cong, $ngay_nghi, $phan_cong_chi_tiet, $gio_da_day);
                        $rt         = array_map(function ($item) use ($nguoi_dung) {
                            $item = (object) $item;
                            return [
                                'ma_phong'      => $item->ma_phong,
                                'ngay'          => $item->ngay,
                                'gio_bat_dau'   => $item->gio_bat_dau,
                                'gio_ket_thuc'  => $item->gio_ket_thuc,
                                'ma_lop'        => $item->ma_lop ?? NULL,
                                'ma_mon_hoc'    => $item->ma_mon_hoc ?? NULL,
                                'so_gio'        => $item->so_gio ?? NULL,
                                'ma_nguoi_dung' => $nguoi_dung->ma_nguoi_dung,
                                'ho_ten'        => $nguoi_dung->ho_ten,
                                'hoat_dong'     => 'Cố Định',
                            ];
                        }, $rt);
                        $lich_phong = array_merge($lich_phong, $rt);
                    }
                }
            }
            $lich_day_bo_sung = LichDayBoSung::where('ma_phong', $rq->ma_phong)
                ->where('tinh_trang', 1)
                ->where('lich_day_bo_sung.ngay', '>=', date("Y-m-d"))
                ->join('ca', 'lich_day_bo_sung.ma_ca', '=', 'ca.ma_ca')
                ->select('ngay', 'ma_lop', 'ma_mon_hoc', 'lich_day_bo_sung.ma_ca', 'lich_day_bo_sung.ma_phong', 'gio_bat_dau', 'gio_ket_thuc', 'ghi_chu', 'lich_day_bo_sung.ma_nguoi_dung')
                ->addSelect(DB::raw("(((MINUTE(ca.gio_ket_thuc)+hour(ca.gio_ket_thuc)*60)-(MINUTE(ca.gio_bat_dau)+hour(ca.gio_bat_dau)*60))/60) as so_gio"))
                ->with('nguoiDung')
                ->get();
            $array_ma_nguoi_dung = $lich_day_bo_sung->map(function ($item) {
                return $item->ma_nguoi_dung;
            });
            $ngay_nghi               = $this->getNgayNghiMuti($array_ma_nguoi_dung, date("Y-m-d"));
            $lich_day_bo_sung_hop_le = $this->checkLichDayBoSungMutiWithNgayNghi($lich_day_bo_sung, $ngay_nghi);
            if (count($lich_day_bo_sung_hop_le) != 0) {
                $lich_day_bo_sung_hop_le = array_map(function ($item) {
                    $item       = (object) $item;
                    $nguoi_dung = (object) $item->nguoi_dung;
                    return [
                        'ngay'          => $item->ngay,
                        'gio_bat_dau'   => $item->gio_bat_dau,
                        'gio_ket_thuc'  => $item->gio_ket_thuc,
                        'ma_lop'        => $item->ma_lop ?? NULL,
                        'ma_mon_hoc'    => $item->ma_mon_hoc ?? NULL,
                        'so_gio'        => $item->so_gio ?? NULL,
                        'ma_nguoi_dung' => $nguoi_dung->ma_nguoi_dung,
                        'ho_ten'        => $nguoi_dung->ho_ten,
                        'hoat_dong'     => 'Bất Thường',
                    ];
                }, $lich_day_bo_sung_hop_le);
                $lich_phong = array_merge($lich_phong, $lich_day_bo_sung_hop_le);
            }
            $nghi = NgayNghi::where('ma_giao_vien', 0)
                ->where('ngay', '>=', date('Y-m-d'))
                ->where('tinh_trang', 1)
                ->join('ca', 'ngay_nghi.ma_ca', '=', 'ca.ma_ca')
                ->select('ngay', 'gio_bat_dau', 'gio_ket_thuc', 'ghi_chu')
                ->addSelect(DB::raw("(((MINUTE(ca.gio_ket_thuc)+hour(ca.gio_ket_thuc)*60)-(MINUTE(ca.gio_bat_dau)+hour(ca.gio_bat_dau)*60))/60) as so_gio"))
                ->get()
                ->map(function ($item) {
                    $item->nghi          = true;
                    $item->ma_nguoi_dung = 0;
                    $item->hoat_dong     = "Cả Trường Nghỉ";
                    return $item;
                })
                ->toArray();
            $lich_phong = array_merge($lich_phong, $nghi);
            return ResponseMau::Store([
                'string' => ResponseMau::SUCCESS_GET,
                'data'   => (new LichHocResource($lich_phong))->lichPhong(),
            ]);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_GET);
        }
    }
    public function lichDayCuaGiaoVien(LichHocRequest $rq) {
        try {
            if ($rq->cap_do == 1) {
                $ma_nguoi_dung = $rq->ma_giao_vien;
                $phan_cong     = PhanCong::where('ma_nguoi_dung', $rq->ma_giao_vien)
                    ->where('tinh_trang', 0);
            } else {
                $ma_nguoi_dung = $rq->ma_nguoi_dung;
                $phan_cong     = PhanCong::where('ma_nguoi_dung', $rq->ma_nguoi_dung)
                    ->where('tinh_trang', 0);
            }
            $ngay_nghi  = $this->getNgayNghi($ma_nguoi_dung, date("Y-m-d"));
            $array_lich = [];
            if ($phan_cong->count() != 0) {
                $lich_day = (new ShowCallController)->checkOnCuArray(
                    $phan_cong->select('ma_lop', 'ma_mon_hoc', 'ma_phan_cong')->get()->toArray()
                );
                foreach ($lich_day as $key => $lich) {
                    $lich               = (object) $lich;
                    $lich->phan_cong    = (object) $lich->phan_cong;
                    $phan_cong_chi_tiet = PhanCongChiTiet::where('ma_phan_cong', $lich->phan_cong->ma_phan_cong)
                        ->join('ca', 'phan_cong_chi_tiet.ma_ca', '=', 'ca.ma_ca')
                        ->with(['phong' => function ($query) {
                            $query->select('ma_phong', 'ten_phong');
                        }])
                        ->select('thu', 'ca.ma_ca', 'ma_phong', 'ca.gio_bat_dau', 'ca.gio_ket_thuc')
                        ->addSelect(DB::raw("(((MINUTE(ca.gio_ket_thuc)+hour(ca.gio_ket_thuc)*60)-(MINUTE(ca.gio_bat_dau)+hour(ca.gio_bat_dau)*60))/60) as so_gio"))
                        ->get();
                    if ($phan_cong_chi_tiet->count() != 0) {
                        $gio_da_day = $lich->gio_da_day ?? 0;
                        $rt         = $this->checkLichHoc($lich->phan_cong, $ngay_nghi, $phan_cong_chi_tiet, $gio_da_day);
                        $array_lich = array_merge($lich->checkon, $rt, $array_lich);
                    }
                }
            }
            $lich_day_bo_sung = LichDayBoSung::where('ma_nguoi_dung', $ma_nguoi_dung)
                ->where('tinh_trang', 1)
                ->with(['phong' => function ($query) {
                    $query->select('ma_phong', 'ten_phong');
                }])
                ->join('ca', 'lich_day_bo_sung.ma_ca', '=', 'ca.ma_ca')
                ->select('ngay', 'ma_lop', 'ma_mon_hoc', 'lich_day_bo_sung.ma_ca', 'ma_phong', 'gio_bat_dau', 'gio_ket_thuc', 'ghi_chu')
                ->addSelect(DB::raw("(((MINUTE(ca.gio_ket_thuc)+hour(ca.gio_ket_thuc)*60)-(MINUTE(ca.gio_bat_dau)+hour(ca.gio_bat_dau)*60))/60) as so_gio"))
                ->get();
            $lich_day_bo_sung_hop_le = $this->checkLichDayBoSungWithNgayNghi($lich_day_bo_sung, $ngay_nghi);
            if (count($lich_day_bo_sung_hop_le) != 0) {
                $array_lich = array_merge($array_lich, $lich_day_bo_sung_hop_le);
            }
            $ngay_nghi = NgayNghi::whereIn('ma_giao_vien', [0, $ma_nguoi_dung])
                ->where('tinh_trang', 1)
                ->join('ca', 'ngay_nghi.ma_ca', '=', 'ca.ma_ca')
                ->select('ngay', 'gio_bat_dau', 'gio_ket_thuc', 'ghi_chu')
                ->addSelect(DB::raw("(((MINUTE(ca.gio_ket_thuc)+hour(ca.gio_ket_thuc)*60)-(MINUTE(ca.gio_bat_dau)+hour(ca.gio_bat_dau)*60))/60) as so_gio"))
                ->get()
                ->map(function ($item) {
                    $item->nghi = true;
                    return $item;
                })
                ->toArray();
            $array_lich = array_merge($array_lich, $ngay_nghi);
            return ResponseMau::Store([
                'string' => ResponseMau::SUCCESS_GET,
                'data'   => (new LichHocResource($array_lich))->lichDayCuaGiaoVien(),
            ]);
        } catch (\Exception $e) {
            return $this->endCatch();
        }
    }
    public function lichDuKienKetThuc(LichHocRequest $rq) {
        try {
            $phan_cong = PhanCong::find($rq->ma_phan_cong);
            if ($phan_cong->tinh_trang != 0) {
                return $this->endCatchValue(ResponseMau::ERROR_GET);
            }
            if ($rq->cap_do != 1 && $phan_cong->ma_nguoi_dung != $rq->ma_nguoi_dung) {
                return $this->endCatchValue(ResponseMau::ERROR_GET);
            }
            $lich_day       = (new ShowCallController)->checkOnCu($phan_cong->ma_lop, $phan_cong->ma_mon_hoc);
            $gio_dinh_muc   = MonHoc::find($phan_cong->ma_mon_hoc)->so_gio;
            $so_gio_con_lai = $gio_dinh_muc - $lich_day['gio_da_day'];
            if ($so_gio_con_lai > 0) {
                $hom_nay            = date("Y-m-d");
                $phan_cong_chi_tiet = PhanCongChiTiet::where('ma_phan_cong', $phan_cong->ma_phan_cong)
                    ->join('ca', 'phan_cong_chi_tiet.ma_ca', '=', 'ca.ma_ca')
                    ->with(['phong' => function ($query) {
                        $query->select('ma_phong', 'ten_phong');
                    }])
                    ->select('thu', 'ca.ma_ca', 'ma_phong', 'ca.gio_bat_dau', 'ca.gio_ket_thuc')
                    ->addSelect(DB::raw("(((MINUTE(ca.gio_ket_thuc)+hour(ca.gio_ket_thuc)*60)-(MINUTE(ca.gio_bat_dau)+hour(ca.gio_bat_dau)*60))/60) as so_gio"))
                    ->get();
                if ($phan_cong_chi_tiet->count() != 0) {
                    $ngay_nghi = NgayNghi::where(function ($query) use ($phan_cong) {
                        $query->where('ma_giao_vien', $phan_cong->ma_nguoi_dung);
                        $query->orWhere('ma_giao_vien', 0);
                    })
                        ->where('ngay', '>=', $hom_nay)
                        ->where('tinh_trang', 1)
                        ->join(DB::raw("(SELECT * FROM (
                        SELECT 1 as ma_ca,4 as convent UNION
                        SELECT 1 as ma_ca,7 as convent UNION
                        SELECT 2 as ma_ca,4 as convent UNION
                        SELECT 3 as ma_ca,4 as convent UNION
                        SELECT 4 as ma_ca,4 as convent UNION
                        SELECT 5 as ma_ca,7 as convent UNION
                        SELECT 6 as ma_ca,7 as convent UNION
                        SELECT 7 as ma_ca,7 as convent UNION
                        SELECT 4 as ma_ca,2 as convent UNION
                        SELECT 4 as ma_ca,3 as convent UNION
                        SELECT 7 as ma_ca,5 as convent UNION
                        SELECT 7 as ma_ca,6 as convent UNION
                        SELECT 2 as ma_ca,2 as convent UNION
                        SELECT 3 as ma_ca,3 as convent UNION
                        SELECT 5 as ma_ca,5 as convent UNION
                        SELECT 1 as ma_ca,2 as convent UNION
                        SELECT 1 as ma_ca,3 as convent UNION
                        SELECT 1 as ma_ca,5 as convent UNION
                        SELECT 1 as ma_ca,6 as convent UNION
                        SELECT 6 as ma_ca,6 as convent
                    ) as convent_ca) as convent_ca "), 'convent_ca.ma_ca', '=', 'ngay_nghi.ma_ca')
                        ->select('ngay', 'convent_ca.convent as ma_ca')
                        ->get()
                        ->toArray();
                    while ($so_gio_con_lai > 0) {
                        $check = $this->checkTrung($hom_nay, $phan_cong_chi_tiet, $ngay_nghi);
                        if ($check != false) {
                            array_push($lich_day['checkon'], $check);
                            $so_gio_con_lai = $so_gio_con_lai - $check['so_gio'];
                        }
                        $hom_nay = date('Y-m-d', strtotime($hom_nay . "+1 days"));
                    }
                }
            }
            $data = [
                'ma_lop'     => $phan_cong->ma_lop,
                'ma_mon_hoc' => $phan_cong->ma_mon_hoc,
                'giao_vien'  => $phan_cong->nguoiDung,
                'lich_day'   => LichHocResource::collection($lich_day['checkon']),
            ];
            if (isset($phan_cong_chi_tiet) && $phan_cong_chi_tiet->count() != 0) {
                $string = "Dự kiến kết thúc vào ngày " . date('d-m-Y', strtotime($hom_nay . "-1 days"));
            } else {
                $string = "Rất tiếc lựa chọn của bạn không có phân công chi tiết nên không thể dự kiến ngày kết thúc";
            }
            if (($gio_dinh_muc - $lich_day['gio_da_day']) <= 0) {
                $hoan_thanh = $lich_day['checkon'][(count($lich_day['checkon']) - 1)]['ngay'];
                $string     = "Đã hoàn thành lịch dạy vào ngày " . date('d-m-Y', strtotime($hoan_thanh . "-1 days"));
            }
            return ResponseMau::Store([
                'string' => $string,
                'data'   => $data,
            ]);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_GET);
        }
    }
    public function checkTrung($ngay, $array_pccc, $array_ngay_nghi) {
        foreach ($array_pccc as $key => $value) {
            if ($this->getWeek($ngay) == $value->thu) {
                $array_ss = ['ngay' => $ngay, 'ma_ca' => $value->ma_ca];
                if (in_array($array_ss, $array_ngay_nghi)) {
                    return false;
                } else {
                    return array_merge(['ngay' => $ngay], $value->toArray());
                }
            }
        }
        return false;
    }
    public function getWeek($date) {
        $week = date('w', strtotime($date));
        if ($week == 0) {
            return 8;
        } else {
            return $week + 1;
        }
    }
    public function checkLichHoc($phan_cong, $ngay_nghi, $phan_cong_chi_tiet, $gio_da_day) {
        $lich_day       = [];
        $gio_dinh_muc   = MonHoc::find($phan_cong->ma_mon_hoc)->so_gio;
        $so_gio_con_lai = $gio_dinh_muc - $gio_da_day;
        if ($so_gio_con_lai > 0) {
            $hom_nay = date("Y-m-d");
            while ($so_gio_con_lai > 0) {
                $check = $this->checkTrung($hom_nay, $phan_cong_chi_tiet, $ngay_nghi);
                if ($check != false) {
                    array_push($lich_day, array_merge(['ma_lop' => $phan_cong->ma_lop, 'ma_mon_hoc' => $phan_cong->ma_mon_hoc], $check));
                    $so_gio_con_lai = $so_gio_con_lai - $check['so_gio'];
                }
                $hom_nay = date('Y-m-d', strtotime($hom_nay . "+1 days"));
            }
        }
        return $lich_day;
    }
    public function checkLichDayBoSungWithNgayNghi($lich_day_bo_sung, $array_ngay_nghi) {
        $array_rt = [];
        foreach ($lich_day_bo_sung as $key => $bo_sung) {
            $array_ss = ['ngay' => $bo_sung->ngay, 'ma_ca' => $bo_sung->ma_ca];
            if (in_array($array_ss, $array_ngay_nghi)) {
                continue;
            } else {
                array_push($array_rt, $bo_sung->toArray());
            }
        }
        return $array_rt;
    }
    public function checkLichDayBoSungMutiWithNgayNghi($lich_day_bo_sung, $array_ngay_nghi) {
        $array_rt = [];
        foreach ($lich_day_bo_sung as $key => $bo_sung) {
            $array_ss = ['ngay' => $bo_sung->ngay, 'ma_ca' => $bo_sung->ma_ca, 'ma_nguoi_dung' => $bo_sung->ma_nguoi_dung];
            if (in_array($array_ss, $array_ngay_nghi)) {
                continue;
            }
            $array_ss = ['ngay' => $bo_sung->ngay, 'ma_ca' => $bo_sung->ma_ca, 'ma_nguoi_dung' => 0];
            if (in_array($array_ss, $array_ngay_nghi)) {
                continue;
            }
            array_push($array_rt, $bo_sung->toArray());
        }
        return $array_rt;
    }
    public function getNgayNghi($ma_nguoi_dung, $hom_nay) {
        return NgayNghi::where(function ($query) use ($ma_nguoi_dung) {
            $query->where('ma_giao_vien', $ma_nguoi_dung);
            $query->orWhere('ma_giao_vien', 0);
        })
            ->where('ngay', '>=', $hom_nay)
            ->where('tinh_trang', 1)
            ->join(DB::raw("(SELECT * FROM (
                        SELECT 1 as ma_ca,4 as convent UNION
                        SELECT 1 as ma_ca,7 as convent UNION
                        SELECT 2 as ma_ca,4 as convent UNION
                        SELECT 3 as ma_ca,4 as convent UNION
                        SELECT 4 as ma_ca,4 as convent UNION
                        SELECT 5 as ma_ca,7 as convent UNION
                        SELECT 6 as ma_ca,7 as convent UNION
                        SELECT 7 as ma_ca,7 as convent UNION
                        SELECT 4 as ma_ca,2 as convent UNION
                        SELECT 4 as ma_ca,3 as convent UNION
                        SELECT 7 as ma_ca,5 as convent UNION
                        SELECT 7 as ma_ca,6 as convent UNION
                        SELECT 2 as ma_ca,2 as convent UNION
                        SELECT 3 as ma_ca,3 as convent UNION
                        SELECT 5 as ma_ca,5 as convent UNION
                        SELECT 1 as ma_ca,2 as convent UNION
                        SELECT 1 as ma_ca,3 as convent UNION
                        SELECT 1 as ma_ca,5 as convent UNION
                        SELECT 1 as ma_ca,6 as convent UNION
                        SELECT 6 as ma_ca,6 as convent
                    ) as convent_ca) as convent_ca "), 'convent_ca.ma_ca', '=', 'ngay_nghi.ma_ca')
            ->select('ngay', 'convent_ca.convent as ma_ca')
            ->get()
            ->toArray();
    }
    public function getNgayNghiMuti($array_ma_nguoi_dung, $hom_nay) {
        $array_ma_nguoi_dung[] = 0;
        return NgayNghi::whereIn('ma_giao_vien', $array_ma_nguoi_dung)
            ->where('ngay', '>=', $hom_nay)
            ->where('tinh_trang', 1)
            ->join(DB::raw("(SELECT * FROM (
                        SELECT 1 as ma_ca,4 as convent UNION
                        SELECT 1 as ma_ca,7 as convent UNION
                        SELECT 2 as ma_ca,4 as convent UNION
                        SELECT 3 as ma_ca,4 as convent UNION
                        SELECT 4 as ma_ca,4 as convent UNION
                        SELECT 5 as ma_ca,7 as convent UNION
                        SELECT 6 as ma_ca,7 as convent UNION
                        SELECT 7 as ma_ca,7 as convent UNION
                        SELECT 4 as ma_ca,2 as convent UNION
                        SELECT 4 as ma_ca,3 as convent UNION
                        SELECT 7 as ma_ca,5 as convent UNION
                        SELECT 7 as ma_ca,6 as convent UNION
                        SELECT 2 as ma_ca,2 as convent UNION
                        SELECT 3 as ma_ca,3 as convent UNION
                        SELECT 5 as ma_ca,5 as convent UNION
                        SELECT 1 as ma_ca,2 as convent UNION
                        SELECT 1 as ma_ca,3 as convent UNION
                        SELECT 1 as ma_ca,5 as convent UNION
                        SELECT 1 as ma_ca,6 as convent UNION
                        SELECT 6 as ma_ca,6 as convent
                    ) as convent_ca) as convent_ca "), 'convent_ca.ma_ca', '=', 'ngay_nghi.ma_ca')
            ->select('ngay', 'convent_ca.convent as ma_ca', 'ma_giao_vien as ma_nguoi_dung')
            ->get()
            ->toArray();
    }
    public function getArrayNgayXuLy($so_ngay, $ngay) {
        for ($i = 0; $i < $so_ngay; $i++) {
            $array_ngay_xu_ly[] = $ngay;
            $ngay               = date('Y-m-d', strtotime($ngay . "+1 days"));
        }
        return $array_ngay_xu_ly;
    }
    public function conventCa($ca, $so_gio) {
        $data     = [];
        $array_ca = [];
        if ($so_gio == 4) {
            switch ($ca->ma_ca) {
            case 2:
                $array_ca[] = 4;
                break;
            case 3:
                $array_ca[] = 4;
                break;
            case 4:
                $array_ca[] = 4;
                break;
            case 5:
                $array_ca[] = 7;
                break;
            case 6:
                $array_ca[] = 7;
                break;
            case 7:
                $array_ca[] = 7;
                break;
            }
        } else {
            switch ($ca->ma_ca) {
            case 2:
                $array_ca[] = 2;
                break;
            case 3:
                $array_ca[] = 3;
                break;
            case 4:
                {
                    $array_ca[] = 2;
                    $array_ca[] = 3;
                    break;
                }
            case 5:
                $array_ca[] = 5;
                break;
            case 6:
                $array_ca[] = 6;
                break;
            case 7:
                {
                    $array_ca[] = 5;
                    $array_ca[] = 6;
                    break;
                }
            }
        }
        $ca = Arr::only((array) $ca, ['ngay', 'ma_phong']);
        foreach ($array_ca as $key => $ma_ca) {
            array_push($data, Arr::add($ca, 'ma_ca', $ma_ca));
        }
        return $data;
    }
}
