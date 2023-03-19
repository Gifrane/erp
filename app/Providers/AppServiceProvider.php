<?php

namespace App\Providers;

use App\Models\Module;
use App\Models\Company\Company;
use App\Models\Crm\CrmContact;
use App\Models\I18n\I18nTimezone;
use App\Models\User\User;
use App\Models\User\UserModule;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

use function app;
use function auth;
use function collect;
use function config;
use function json_decode;
use function json_encode;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.env') === 'prod') {
            URL::forceScheme('https');
        }

        Relation::morphMap([
            'company' => Company::class,
            'crm_contact' => CrmContact::class,
            'user' => User::class,
        ]);

        View::composer('layout', function ($view) {
            $countries = $this->retrieveCountries();

            $view->with('countries', $countries);
            $view->with('langs', $this->retrieveLanguages());
            $view->with('timezones', $this->retrieveTimezones());
            $view->with('translations', $this->retrieveTranslations());

            if (auth()->check()) {
                $view->with('user_modules', $this->retrieveUserModules());
            }
        });
    }

    /**
     * @return array
     */
    private function retrieveTranslations(): array
    {
        if (auth()->check()) {
            $lang = auth()->user()->lang;
        } else {
            $lang = app()->getLocale();
        }

        return json_decode(Storage::disk('translations')->get($lang.'.json'), true);
    }

    /**
     * @return array
     */
    private function retrieveCountries(): array
    {
        if (Cache::has('countries')) {
            return json_decode(Cache::get('countries'), true);
        }

        $countries = DB::table('i18n_country')->select(DB::raw('CAST(id AS string) AS id'), 'code', 'name')->orderBy('name', 'ASC')->get()->toArray();

        Cache::put('countries', json_encode($countries));

        return $countries;
    }

    /**
     * @return array
     */
    private function retrieveLanguages(): array
    {
        if (Cache::has('languages')) {
            return json_decode(Cache::get('languages'), true);
        }

        $languages = DB::table('i18n_lang')->select(DB::raw('CAST(id AS string) AS id'), 'code', 'name')->orderBy('name', 'ASC')->get()->toArray();

        Cache::put('languages', json_encode($languages));

        return $languages;
    }

    /**
     * @return array
     */
    private function retrieveTimezones(): array
    {
        if (Cache::has('timezones')) {
            return json_decode(Cache::get('timezones'), true);
        }

        $timezones = I18nTimezone::select('label')->orderBy('label', 'ASC')->toBase()->get()->toArray();

        Cache::put('timezones', json_encode($timezones));

        return $timezones;
    }

    /**
     * @return array
     */
    private function retrieveUserModules(): array
    {
        $navbar_modules = config('navbar_modules');

        $user_modules = UserModule::where('user_id', auth()->id())->select('module_id')->get()->pluck('module_id')->toArray();

        $list_modules = Module::whereIn('id', $user_modules)->orWhere(function ($query) {
            $query->where('linkable', true);
        })
            ->select('code')
            ->get()
            ->filter(function ($module) {
                return !empty(config('navbar_modules.'.$module['code']));
            })
            ->pluck('code')
            ->values()
            ->toArray();

        $modules = collect($navbar_modules)->filter(function ($m, $k) use ($list_modules) {
            return in_array($k, $list_modules);
        })->map(function ($m, $k) {
            return [
                'code' => $k,
                'url' => $m['url'],
            ];
        })->values()->toArray();

        return $modules;
    }
}
