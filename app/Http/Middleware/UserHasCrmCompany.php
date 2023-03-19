<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\Crm\CrmCompany;

use function app;
use function is_null;
use function redirect;

class UserHasCrmCompany
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
        $companyId = $request->company;

        $company = CrmCompany::where('id', $companyId)->first();

        if (is_null($company)) {
            if ($request->ajax()) {
                throw new \Exception('crm_company_'.$companyId.'_not_exists', 404);
            }

            return redirect()->back();
        }

        app()->company = $company;

        return $next($request);
    }
}
