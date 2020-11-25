<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NgayNghiRequest;
use App\Http\Resources\LichDayBoSungResource;
use App\Http\Resources\NguoiDungResource;
use App\Models\Ca;
use App\Models\LichDayBoSung;
use App\Models\NgayNghi;
use App\Models\NguoiDung;
use DB;
use Exception;
use Illuminate\Http\Request;
use ResponseMau;

class NgayNghiController extends Controller {
    use Traits\ReturnError;
    public function hienThiTatCa(NgayNghiRequest $rq) {
        $rq = new Request($rq->request->all());
        try {
            $ngay_nghi = NgayNghi::where(function ($query) use ($rq) {
                if ($rq->has('ngay')) {
                    $query->where('ngay', $rq->ngay);
                } else {
                    if ($rq->has('tuong_lai')) {
                        $query->whereRaw('ngay >= CURDATE()');
                    }
                }
            })
                ->where(function ($query) use ($rq) {
                    if ($rq->cap_do != 1) {
                        $query->where('ma_giao_vien', $rq->ma_nguoi_dung);
                    } else {
                        if ($rq->has('ma_giao_vien')) {
                            $query->where('ma_giao_vien', $rq->ma_giao_vien);
                        }
                    }
                })
                ->where(function ($query) use ($rq) {
                    if ($rq->has('tinh_trang')) {
                        $query->where('tinh_trang', $rq->tinh_trang);
                    } else {
                        $query->where('tinh_trang', 1);
                    }
                })
                ->orderBy('ngay', 'ASC')
                ->with('nguoiDung')
                ->get();
            $nhom_ngay = collect($ngay_nghi)->groupBy('ngay')->transform(function ($item) use ($rq) {
                $data = [];
                foreach ($item as $key => $value) {
                    array_push($data, $value->only(['ngay', 'tinh_trang', 'ma_giao_vien', 'nguoidung']));
                }
                $data = array_unique($data, SORT_REGULAR);
                $temp = [];
                foreach ($data as $key => $value) {
                    $value = (object) $value;
                    $ca    = Ca::whereHas('ngayNghi', function ($query) use ($value, $rq) {
                        $query->where('ngay_nghi.ngay', $value->ngay);
                        $query->where('ngay_nghi.ma_giao_vien', $value->ma_giao_vien);
                        if ($rq->has('tinh_trang')) {
                            $query->where('ngay_nghi.tinh_trang', $rq->tinh_trang);
                        } else {
                            $query->where('ngay_nghi.tinh_trang', 1);
                        }
                    })
                        ->with(['ngayNghi' => function ($query) use ($value, $rq) {
                            $query->where('ngay_nghi.ngay', $value->ngay);
                            $query->where('ngay_nghi.ma_giao_vien', $value->ma_giao_vien);
                            if ($rq->has('tinh_trang')) {
                                $query->where('ngay_nghi.tinh_trang', $rq->tinh_trang);
                            } else {
                                $query->where('ngay_nghi.tinh_trang', 1);
                            }
                            $query->select('ma_ca', 'ghi_chu');
                        }])
                        ->get();
                    $value->ca = $ca;
                    $value     = collect($value)->only(['tinh_trang', 'nguoidung', 'ca']);
                    array_push($temp, $value);
                }
                return $temp;
            });
            return ResponseMau::Store([
                'string' => ResponseMau::SUCCESS_GET,
                'data'   => $nhom_ngay,
            ]);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_GET);
        }
    }
    public function ngayNghiTheoGiaoVien(NgayNghiRequest $rq) {
        $rq = new Request($rq->request->all());
        try {
            $ngay_nghi = NguoiDung::withCount(['ngayNghi' => function ($query) {
                $query->where('ngay_nghi.tinh_trang', 1);
                $query->select(DB::raw('count(DISTINCT(ngay))'));
            }])
                ->where(function ($query) use ($rq) {
                    if ($rq->cap_do != 1) {
                        $query->where('ma_nguoi_dung', $rq->ma_nguoi_dung);
                    } else {
                        if ($rq->has('ma_giao_vien')) {
                            $query->where('ma_nguoi_dung', $rq->ma_giao_vien);
                        }
                    }
                })
                ->orderBy('ngay_nghi_count', 'DESC')
                ->get();
            return ResponseMau::Store([
                'string' => ResponseMau::SUCCESS_GET,
                'data'   => (new NguoiDungResource($ngay_nghi))->withNgayNghi(),
            ]);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_GET);
        }
    }
    public function themNgayNghi(NgayNghiRequest $rq) {
        $rq = new Request($rq->request->all());
        try {
            if (!$rq->has('ma_giao_vien')) {
                return $this->endCatchValue(ResponseMau::ERROR_CREATE);
            }
            $create = 0;
            $exists = 0;
            $update = 0;
            $data   = (object) ['create' => [], 'exists' => [], 'update' => [], 'lich_day_bo_sung' => []];
            if (in_array('0', $rq->ma_giao_vien)) {
                if (count($rq->ma_giao_vien) > 1) {
                    return $this->endCatchValue(ResponseMau::ERROR_NGAY_NGHI_TOAN_TRUONG);
                }
                foreach ($rq->ma_ca as $k_ca => $ma_ca) {
                    $ngay_nghi = NgayNghi::firstOrCreate([
                        'ngay'         => $rq->ngay,
                        'ma_giao_vien' => 0,
                        'ma_ca'        => $ma_ca,
                    ], $this->arrayInsert($rq, 0, $ma_ca));
                    if ($ngay_nghi->wasRecentlyCreated) {
                        $create++;
                    } else {
                        if ($ngay_nghi->tinh_trang == 2) {
                            $ngay_nghi->tinh_trang = 1;
                            $ngay_nghi->save();
                            $update++;
                        } else {
                            $exists++;
                        }
                    }
                }
                $lich_day_bo_sung = LichDayBoSung::where('ngay', $rq->ngay)
                    ->whereIn('ma_ca', $this->arrayMaCaConvent($rq->ma_ca))
                    ->where('tinh_trang', 1);
                $data->lich_day_bo_sung = (new LichDayBoSungResource($lich_day_bo_sung->get()))->onlyPreview();
                $lich_day_bo_sung       = $lich_day_bo_sung->update(['tinh_trang' => 2]);
            } else {
                foreach ($rq->ma_giao_vien as $key => $ma_giao_vien) {
                    foreach ($rq->ma_ca as $k_ca => $ma_ca) {
                        $ngay_nghi = NgayNghi::whereIn('ma_giao_vien', [0, $ma_giao_vien])
                            ->firstOrCreate([
                                'ngay'  => $rq->ngay,
                                'ma_ca' => $ma_ca,
                            ], $this->arrayInsert($rq, $ma_giao_vien, $ma_ca));
                        if ($ngay_nghi->wasRecentlyCreated) {
                            $create++;
                        } else {
                            if ($ngay_nghi->tinh_trang == 2) {
                                $ngay_nghi->tinh_trang = 1;
                                $ngay_nghi->save();
                                $update++;
                            } else {
                                $exists++;
                            }
                        }
                    }
                }
                $lich_day_bo_sung = LichDayBoSung::where('ngay', $rq->ngay)
                    ->whereIn('ma_ca', $this->arrayMaCaConvent($rq->ma_ca))
                    ->whereIn('ma_nguoi_dung', $rq->ma_giao_vien)
                    ->where('tinh_trang', 1);
                $data->lich_day_bo_sung = (new LichDayBoSungResource($lich_day_bo_sung->get()))->onlyPreview();
                $lich_day_bo_sung       = $lich_day_bo_sung->update(['tinh_trang' => 2]);
            }
            $string = '';
            if ($create != 0) {
                $string .= "Đã tạo mới $create ngày nghỉ";
            }
            if ($exists != 0) {
                if (!empty($string)) {
                    $string .= ", ";
                }
                $string .= "Tồn tại $exists ngày nghỉ";
            }
            if ($update != 0) {
                if (!empty($string)) {
                    $string .= ", ";
                }
                $string .= "Đã Cập Nhật tình trạng $update ngày nghỉ";
            }
            if ($lich_day_bo_sung != 0) {
                if (!empty($string)) {
                    $string .= ", ";
                }
                $string .= "Đã cập nhật hủy bỏ $lich_day_bo_sung Lịch Dạy Bổ Sung";
            }
            if (empty($string)) {
                $string = ResponseMau::SUCCESS_NO_DATA_UPDATE;
            }
            return ResponseMau::Store([
                'string' => $string,
                'data'   => $data,
            ]);
        } catch (\Exception $e) {
            dd($e);
            return $this->endCatchValue(ResponseMau::ERROR_CREATE);
        }
    }
    public function suaNgayNghi(NgayNghiRequest $rq) {
        $rq = new Request($rq->request->all());
        try {
            $ngay_nghi = NgayNghi::where('ngay', $rq->ngay_cu)
                ->where('ma_ca', $rq->ma_ca_cu)
                ->where('ma_giao_vien', $rq->ma_giao_vien_cu)
                ->update($rq->only((new NgayNghi)->getFillable()));
            if ($ngay_nghi) {
                return ResponseMau::Store([
                    'string' => ResponseMau::SUCCESS_UPDATE,
                ]);
            } else {
                return $this->endCatchValue(ResponseMau::ERROR_NGAY_NGHI_SUA);
            }
        } catch (\Exception $e) {
            return $this->error($e);
            return $this->endCatchValue(ResponseMau::ERROR_NGAY_NGHI_SUA);
        }
    }
    public function kiemTra(NgayNghiRequest $rq) {
        return ResponseMau::Store([]);
    }
    public function arrayInsert($rq, $ma_giao_vien, $ma_ca) {
        $array = [
            'ngay'         => $rq->ngay,
            'ma_ca'        => $ma_ca,
            'ma_giao_vien' => $ma_giao_vien,
        ];
        if ($rq->has('tinh_trang')) {
            $array = array_merge($array, ['tinh_trang' => $rq->tinh_trang]);
        }
        if ($rq->has('ghi_chu')) {
            $array = array_merge($array, ['ghi_chu' => $rq->ghi_chu]);
        }
        return $array;
    }
    public function arrayMaCaConvent($ma_ca) {
        $array_return = [];
        if (in_array(2, $ma_ca) || in_array(3, $ma_ca)) {
            array_push($array_return, 4);
        }
        if (in_array(5, $ma_ca) || in_array(6, $ma_ca)) {
            array_push($array_return, 7);
        }
        return array_merge($array_return, $ma_ca);
    }
}
