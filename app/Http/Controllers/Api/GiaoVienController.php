<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class GiaoVienController extends Controller {
    use Traits\CallApi;
    public function getGiaoVien() {
        $list = (object) $this->postApi('danhsachcanbo');
        if ($list->success) {
            return $list->data;
        }
        return false;
    }
    public function getAllInfo() {
        $list = (object) $this->postApi('danhsachcanboclone');
        if ($list->success) {
            return $list->data;
        }
        return false;
    }
}
