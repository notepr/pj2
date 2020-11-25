<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhanCongRequest;
use App\Http\Resources\PhancongResource;
use App\Models\MonHoc;
use App\Models\NguoiDung;
use App\Models\PhanCong;
use ResponseMau;

class PhanCongController extends Controller {
    use Traits\ReturnError;
    use Traits\CallApi;
    public function phanCongWithTtGv(PhanCongRequest $rq) {
        try {
            $phan_cong = PhanCong::where(function ($query) use ($rq) {
                if ($rq->get('cap_do') == 1) {
                    if ($rq->has('ma_giao_vien')) {
                        $query->where('ma_nguoi_dung', $rq->get('ma_giao_vien'));
                    }
                } else {
                    $query->where('ma_nguoi_dung', $rq->get('ma_nguoi_dung'));
                }
                if ($rq->has('ma_phan_cong')) {
                    $query->where('ma_phan_cong', $rq->get('ma_phan_cong'));
                } else {
                    if ($rq->has('ma_mon_hoc')) {
                        $query->where('ma_mon_hoc', $rq->ma_mon_hoc);
                    }
                    if ($rq->has('ma_lop')) {
                        $query->where('ma_lop', $rq->ma_lop);
                    }
                }
                if ($rq->has('tinh_trang')) {
                    $query->where('tinh_trang', $rq->get('tinh_trang'));
                } else {
                    $query->whereIn('tinh_trang', [0, 1]);
                }
            })
                ->with('nguoiDung')
                ->orderBy('tinh_trang', 'ASC')
                ->get();
            return ResponseMau::Store([
                'string' => ResponseMau::SUCCESS_GET,
                'data'   => PhancongResource::collection($phan_cong),
            ]);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_GET);
        }
    }
    public function kiemTra(PhanCongRequest $rq) {
        return ResponseMau::Store([]);
    }
    public function cloneBKACADToLocal() {
        try {
            $list = (object) $this->postApi('phancongdayhoc');
            if ($list->success == false) {
                return $this->endCatch();
            }
            $create = 0;
            $update = 0;
            $data   = (object) ['create' => [], 'update' => []];
            foreach ($list->data as $key) {
                $value         = (object) $key;
                $nguoi_dung    = NguoiDung::where('email', $value->email)->first();
                $ma_nguoi_dung = is_null($nguoi_dung) ? null : $nguoi_dung->ma_nguoi_dung;
                $mon_hoc       = MonHoc::updateOrCreate(
                    [
                        'ma_mon_hoc' => $value->ma_mon_hoc,
                    ],
                    [
                        'ma_mon_hoc' => $value->ma_mon_hoc,
                    ]
                );
                try {
                    $flight = PhanCong::updateOrCreate(
                        [
                            'ma_lop'     => $value->ma_lop,
                            'ma_mon_hoc' => $value->ma_mon_hoc,
                        ],
                        [
                            'ma_lop'        => $value->ma_lop,
                            'ma_nguoi_dung' => $ma_nguoi_dung,
                            'ma_mon_hoc'    => $value->ma_mon_hoc,
                            'tinh_trang'    => $value->tinh_trang,
                        ]
                    );
                } catch (\Exception $e) {
                    return $this->endCatch();
                }
                if (count($flight->getChanges()) > 0) {
                    $update++;
                    $arr = (object) [
                        'ma_lop'     => $value->ma_lop,
                        'ma_mon_hoc' => $value->ma_mon_hoc,
                        'changer'    => $flight->getChanges(),
                    ];
                    array_push($data->update, $arr);
                }
                if ($flight->wasRecentlyCreated) {
                    $create++;
                    array_push($data->create, $flight);
                }
            }
            return ResponseMau::Store([
                'string' => "Đã tạo mới " . $create . " bản ghi và Cập nhật " . $update . " bản ghi",
                'data'   => $data,
            ]);
        } catch (\Exception $e) {
            return $this->endCatch();
        }
    }
}
