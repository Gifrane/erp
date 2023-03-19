<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\Crm\CrmContact;

use function app;
use function is_null;
use function redirect;

class UserHasCrmContact
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
        $contactId = $request->contact;

        $contact = CrmContact::where('id', $contactId)->first();

        if (is_null($contact)) {
            if ($request->ajax()) {
                throw new \Exception('crm_contact_'.$contactId.'_not_exists', 404);
            }

            return redirect()->back();
        }

        app()->contact = $contact;

        return $next($request);
    }
}
