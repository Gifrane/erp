<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

use function config;
use function is_null;
use function json_decode;

class Languages
{
    /**
     * @param int $id
     * @return string
     */
    public static function getCodeFromId(int $id): string
    {
        $fallBack = config('app.fallback_locale');

        if (Cache::has('languages')) {
            $languages = json_decode(Cache::get('languages'), true);

            foreach ($languages as $l) {
                if ($l['id'] == $id) {
                    return $l['code'];
                }
            }

            return $fallBack;
        }

        $language = DB::table('i18n_lang')->select('code')->first();

        return (is_null($language)) ? $fallBack : $language->code;
    }
}