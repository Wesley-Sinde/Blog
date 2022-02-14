<?php

namespace App\Http\Middleware;

use App\Traits\PurchaseVerification;
use Closure;

class VerifyPurchase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    use PurchaseVerification;

    public function handle($request, Closure $next)
    {
        $this->getPurchaseDetail();
        return $next($request);
    }
}
