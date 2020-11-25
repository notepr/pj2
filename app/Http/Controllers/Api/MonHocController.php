<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MonHocRequest;
use App\Http\Resources\MonHocResource;
use App\Models\MonHoc;
use Exception;
use ResponseMau;

class MonHocController extends Controller {
    use Traits\ReturnError;
    use Traits\CallApi;
    public function hienThiTatCaMon(MonHocRequest $rq) {
        try {
            $mon_hoc = MonHoc::where(function ($query) use ($rq) {
                if ($rq->has('ma_mon_hoc')) {
                    $query->find($rq->get('ma_mon_hoc'));
                }
            })->get();
            $data = ($mon_hoc->count() == 1) ?
            (new MonHocResource($mon_hoc->first()))->toOne() : MonHocResource::collection($mon_hoc);
            return ResponseMau::Store([
                'data'   => $data,
                'string' => ResponseMau::SUCCESS_DONE_DATA,
            ]);
        } catch (\Exception $e) {
            return $this->endCatch();
        }
    }
    public function kiemTra(MonHocRequest $rq) {
        return ResponseMau::Store([]);
    }
    public function cloneBKACADToLocal() {
        try {
            $list = (object) $this->postApi('cacmon');
            if ($list->success == false) {
                return $this->endCatch();
            }
            $create = 0;
            $update = 0;
            $data   = (object) ['create' => [], 'update' => []];
            foreach ($list->data as $key) {
                $value  = (object) $key;
                $flight = MonHoc::updateOrCreate(
                    ['ma_mon_hoc' => $value->ma_mon_hoc],
                    [
                        'ten_mon_tieng_viet' => $value->ten_mon_tv,
                        'ten_mon_tieng_anh'  => $value->ten_mon_ta,
                        'so_gio'             => $value->so_gio,
                        'ma_kieu_thi'        => $value->ma_kieu_thi,
                    ]
                );
                if (count($flight->getChanges()) > 0) {
                    $update++;
                    $arr = (object) ['ma_mon_hoc' => $value->ma_mon_hoc, 'changer' => $flight->getChanges()];
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
