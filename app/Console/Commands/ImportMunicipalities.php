<?php

namespace App\Console\Commands;

use App\Models\Municipality;
use App\Models\PostalCode;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ImportMunicipalities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-municipalities {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import municipality and county municipality names from SSB';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = $this->argument('url');

        $municipalities = [];

        if ( ( $handle = fopen($url, 'r') )  !== false )
        {
            $current_datetime = Carbon::now();

            while ( $row = fgetcsv($handle, null, ";") )
            {
                foreach ( $row as & $field )
                {
                    $field = iconv('iso-8859-1', 'utf-8', $field);
                }

                // Skip header row
                if ( ! is_numeric($row[0]) )
                {
                    continue;
                }

                $municipality = [
                    'county_municipality_code' => $row[0],
                    'county_municipality_name' => $row[1],
                    'municipality_code' => $row[2],
                    'municipality_name' => $row[3],
                    'created_at' => $current_datetime,
                    'updated_at' => $current_datetime,
                ];

                $municipalities[] = $municipality;
            }

            Municipality::truncate();
            Municipality::insert($municipalities);
        }
        else
        {
            $this->error('Download failed');
        }

        fclose($handle);
    }
}
