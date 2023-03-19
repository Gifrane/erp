<?php

namespace App\Actions\User\Settings;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use function auth;
use function json_decode;
use function now;

class UpdateI18nAction
{
    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        try {
            $lang = $params['lang'];

            DB::table('user')->where('id', auth()->id())->update([
                'i18n_country_id' => $params['country'], 'lang' => $lang,
                'timezone' => $params['timezone'], 'updated_at' => now()
            ]);

            auth()->user()->update([ 'lang' => $lang ]);

            $data = [];
            $data['translations'] = json_decode(Storage::disk('translations')->get($lang.'.json'), true);

            return [ 'success' => true, 'data' => $data ];
        } catch (\Exception $e) {
            throw new \Exception('user.settings.update_i18n.error_during_updating', 500, $e);
        }
    }
}
