<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\Supplier\Supplier;

use function app;
use function is_null;
use function redirect;

class UserHasSupplier
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
        $supplier_id = $request->supplier;

        $supplier = Supplier::where('id', $supplier_id)->first();

        if (is_null($supplier)) {
            if ($request->ajax()) {
                throw new \Exception('supplier_'.$supplier_id.'_not_exists', 404);
            }

            return redirect()->back();
        }

        app()->supplier = $supplier;

        return $next($request);
    }
}
