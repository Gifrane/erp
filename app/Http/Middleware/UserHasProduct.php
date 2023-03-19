<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\Product\Product;

use function app;
use function is_null;
use function redirect;

class UserHasProduct
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $product = Product::where('id', $request->product)->first();

        if (is_null($product)) {
            if ($request->ajax()) {
                throw new \Exception('product_'.$request->product.'_not_exists', 404);
            }

            return redirect()->back();
        }

        app()->product = $product;

        return $next($request);
    }
}
