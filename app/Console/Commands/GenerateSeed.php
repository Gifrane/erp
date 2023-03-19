<?php

namespace App\Console\Commands;

use App\Services\SqlStructureSeed;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class GenerateSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:seed';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $seeder = File::get(public_path().'/../database/seeders/DefaultDataSeeder.php');

        $seeder = $this->generateRegisteredList($seeder);
        $seeder = $this->generateListCalls($seeder);

        foreach (SqlStructureSeed::$links as $table => $value) {
            $seeder = $this->generate($table, $value, $seeder);
        }
    }

    private function generateRegisteredList($seeder)
    {
        $order_calls = SqlStructureSeed::$order_calls;

        $content = '';

        foreach ($order_calls as $oc) {
            $content .= '    private array $registered_'.$oc.' = [];'."\n";
        }

        $string = '// Start list registered entities'."\n";
        $string .= $content;
        $string .= '    // End list registered entities';

        $seeder = preg_replace('/\/\/ Start list registered entities(.*)\/\/ End list registered entities/s', $string, $seeder);

        File::put(public_path().'/../database/seeders/DefaultDataSeeder.php', $seeder);

        return $seeder;
    }

    private function generateListCalls($seeder)
    {
        $order_calls = SqlStructureSeed::$order_calls;

        $content = '';

        foreach ($order_calls as $oc) {
            $content .= '        $this->'.$oc.'();'."\n";
        }

        $string = '// Start list order calls'."\n";
        $string .= $content;
        $string .= '        // End list order calls';

        $seeder = preg_replace('/\/\/ Start list order calls(.*)\/\/ End list order calls/s', $string, $seeder);

        File::put(public_path().'/../database/seeders/DefaultDataSeeder.php', $seeder);

        return $seeder;
    }

    private function generate(string $table, array $table_options, $seeder)
    {
        if (empty($table_options['cols'])) {
            return $seeder;
        }

        $entities = DB::table($table)->get();

        $content_generate = '';

        foreach ($entities as $e) {
            $params = [];

            if (!isset($table_options['col']['id'])) {
                $params['id'] = $e->id;
            }

            $need = '';

            if (!empty($table_options['need'])) {
                foreach ($table_options['need'] as $column_need => $table_need) {
                    if (!is_null($e->$column_need)) {
                        if (!empty($table_options['can_be_need']) && $table_options['can_be_need']) {
                            $need .= '            $this->'.$table_need.'('.$e->$column_need.');'."\n";
                        } else {
                            $need .= '        $this->'.$table_need.'('.$e->$column_need.');'."\n";
                        }
                    }
                }
            }

            foreach ($table_options['cols'] as $col => $options) {
                if (in_array('integer', $options)) {
                    if (in_array('nullable', $options)) {
                        $params[ $col ] = (is_null($e->{ $col })) ? 'null' : $e->{ $col };
                    } else {
                        $params[ $col ] = $e->{ $col };
                    }
                } elseif (in_array('boolean', $options)) {
                    $params[ $col ] = ($e->{ $col }) ? 'true' : 'false';
                } elseif (in_array('string', $options)) {
                    if (in_array('nullable', $options)) {
                        if (in_array('with_quotes', $options)) {
                            $params[ $col ] = (empty($e->{ $col })) ? 'null' : '\''.str_replace('\'', '\\\'', $e->{ $col }).'\'';
                        } else {
                            $params[ $col ] = (empty($e->{ $col })) ? 'null' : '\''.$e->{ $col }.'\'';
                        }
                    } else {
                        if (in_array('with_quotes', $options)) {
                            $params[ $col ] = '\''.str_replace('\'', '\\\'', $e->{ $col }).'\'';
                        } else {
                            $params[ $col ] = '\''.$e->{ $col }.'\'';
                        }
                    }
                }
            }

            if (isset($table_options['with_timestamps']) && $table_options['with_timestamps']) {
                $params['created_at'] = (empty($e->created_at)) ? 'null' : '\''.$e->created_at.'\'';
                $params['updated_at'] = (empty($e->updated_at)) ? 'null' : '\''.$e->updated_at.'\'';
            }

            $string = '';

            foreach ($params as $k => $v) {
                $string .= '\''.$k.'\' => '.$v.', ';
            }

            if (!empty($table_options['can_be_need']) && $table_options['can_be_need']) {
                $content_generate .= '        if (!in_array('.$e->id.', $this->registered_'.$table.') && (is_null($entity_id) || $entity_id === '.$e->id.')) {'."\n";

                if (!empty($need)) {
                    $content_generate .= $need."\n";
                }

                $content_generate .= '            DB::table(\''.$table.'\')->insert([ '.$string.' ]);'."\n";
                $content_generate .= '            $this->registered_'.$table.'[] = '.$e->id.';'."\n";
                $content_generate .= '        }'."\n";
            } else {
                if (!empty($need)) {
                    $content_generate .= $need."\n";
                }

                $content_generate .= '        DB::table(\''.$table.'\')->insert([ '.$string.' ]);'."\n";
            }
        }

        $content = '    private function '.$table.'(?int $entity_id = null)'."\n";
        $content .= '    {'."\n";
        $content .= $content_generate;
        $content .= '    }'."\n";

        $string = '// Start '.$table.' datas'."\n";
        $string .= $content;
        $string .= '    // End '.$table.' datas';

        $seeder = preg_replace('/\/\/ Start '.$table.' datas(.*)\/\/ End '.$table.' datas/s', $string, $seeder);

        File::put(public_path().'/../database/seeders/DefaultDataSeeder.php', $seeder);

        return $seeder;
    }
}
