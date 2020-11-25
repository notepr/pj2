<?php

namespace App\Http\Middleware;

use Closure;
use ResponseMau;

class CheckGiaoVuOrKiThuat {
    public function handle($request, Closure $next) {
        if ($request->input('cap_do') == 1 || $request->input('cap_do') == 2) {
            return $next($request);
        } else {
            return ResponseMau::Store(['bool' => false, 'string' => ResponseMau::ERROR_KEY]);
        }
    }
}
