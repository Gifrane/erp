<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\Crm\CrmGroup;

use function app;
use function is_null;
use function redirect;

class UserHasCrmGroup
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
        $groupId = $request->group;

        $group = CrmGroup::where('id', $groupId)->first();

        if (is_null($group)) {
            if ($request->ajax()) {
                throw new \Exception('crm_group_'.$groupId.'_not_exists', 404);
            }

            return redirect()->back();
        }

        app()->group = $group;

        return $next($request);
    }
}
