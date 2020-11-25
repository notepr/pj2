<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Artisan;
use Illuminate\Http\Request;
use ResponseMau;

class ArtisanController extends Controller {
    use Traits\ReturnError;
    ///run
    public function runArtisan(Request $rq) {
        try {
            if ($rq->key != 'duong') {
                return $this->endCatchValue(ResponseMau::ERROR_KEY);
            }
            if ($rq->has('code')) {
                $a = Artisan::call($rq->code);
                return ResponseMau::Store([
                    'string' => ResponseMau::SUCCESS_RUN,
                ]);
            } else {
                Artisan::call('cache:clear');
                Artisan::call('route:clear');
                Artisan::call('config:clear');
                Artisan::call('view:clear');
                return ResponseMau::Store([
                    'string' => 'Xóa Cache Thành Công !',
                ]);
            }
        } catch (\Exception $e) {
            return $this->endCatchValue(ResponseMau::ERROR_RUN);
        }
    }
}
