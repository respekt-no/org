<?php

namespace App\Console\Commands;

use App\Models\PostalCode;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportPostalCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-postal-codes {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import postal codes with corresponding municipality numbers from Norwegian Post (Posten)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = $this->argument('url');

        $postal_codes = [];

        if ( ( $handle = fopen($url, 'r') )  !== false )
        {
            $current_datetime = Carbon::now();

            while ( $row = fgetcsv($handle, null, "\t") )
            {
                foreach ( $row as & $field )
                {
                    $field = iconv('windows-1252', 'utf-8', $field);
                }

                $postal_code = [
                    'postal_code' => $row[0],
                    'postal_area' => $row[1],
                    'municipality_code' => $row[2],
                    'municipality_name' => $row[3],
                    'created_at' => $current_datetime,
                    'updated_at' => $current_datetime,
                ];

                $postal_codes[] = $postal_code;
            }

            PostalCode::truncate();
            PostalCode::insert($postal_codes);
        }
        else
        {
            $this->error('Download failed');
        }

        fclose($handle);
    }
}
