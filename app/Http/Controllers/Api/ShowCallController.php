<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ResponseMau;

class ShowCallController extends Controller {
    use Traits\ReturnError;
    use Traits\CallApi;
    public function khoa(Request $rq) {
        try {
            if ($rq->has('ma_khoa')) {
                $this->setBody(['ma_khoa' => $rq->ma_khoa]);
            }
            $list = (object) $this->postApi('danhsachkhoa');
            if (empty($list->success) || $list->success == false) {
                return $this->endCatch();
            }
            return ResponseMau::Store([
                'string' => ResponseMau::SUCCESS_GET,
                'data'   => $list->data,
            ]);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_GET);
        }
    }
    public function ctdt(Request $rq) {
        try {
            if ($rq->has('ma_ctdt')) {
                $this->setBody(['ma_ctdt' => $rq->ma_ctdt]);
            }
            $list = (object) $this->postApi('danhsachctdt');
            if (empty($list->success) || $list->success == false) {
                return $this->endCatch();
            }
            return ResponseMau::Store([
                'string' => ResponseMau::SUCCESS_GET,
                'data'   => $list->data,
            ]);
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_GET);
        }
    }
    public function lopCheck($ma_lop) {
        try {
            $this->setBody(['ma_lop' => $ma_lop]);
            $list = (object) $this->postApi('kiemtra');
            if (empty($list->success) || $list->success == false) {
                $list = (object) ['success' => false];
                return $list;
            }
            return $list;
        } catch (\Exception $e) {
            $list = (object) ['success' => false];
            return $list;
        }
    }
    public function soSinhVien($ma_lop) {
        try {
            $this->setBody(['ma_lop' => $ma_lop]);
            $list = (object) $this->postApi('sosinhvien');
            if (empty($list->success) || $list->success == false) {
                return $this->endCatch();
            }
            return $list->data[0]['tong_sinh_vien'];
        } catch (\Exception $e) {
            return $this->endCatch();
        }
    }
    public function checkOnCu($cac_lop, $ma_mon_hoc) {
        $this->setBody([
            'cac_lop'    => $cac_lop,
            'ma_mon_hoc' => $ma_mon_hoc,
        ]);
        $list = (object) $this->postApi('lichsudaday');
        if (empty($list->success) || $list->success == false) {
            return false;
        }
        return $list->data;
    }
    public function checkOnCuArray($phan_cong) {
        $this->setBody([
            'phan_cong' => $phan_cong,
        ]);
        $list = (object) $this->postApi('lichsudaday');
        // dd($list);
        if (empty($list->success) || $list->success == false) {
            return false;
        }
        return $list->data;
    }
    public function gioDaDay($cac_lop, $ma_mon_hoc) {
        try {
            $this->setBody([
                'cac_lop'    => $cac_lop,
                'ma_mon_hoc' => $ma_mon_hoc,
            ]);
            $list = (object) $this->postApi('giodaday');
            if (empty($list->success) || $list->success == false) {
                return false;
            }
            return $list->data[0]['gio_da_day'];
        } catch (\Exception $e) {
            return false;
        }
    }
}
