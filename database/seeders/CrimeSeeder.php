<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Crime;

class CrimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Crime::truncate();

        $csv = fopen(base_path('database/data/crimes.csv'), 'r');

        $firstLine = true;
        while (($data = fgetcsv($csv, 2000, ",")) !== false) {
            if (!$firstLine) {
                Crime::create([
                    'dr_no' => $data['0'],
                    'date_rptd' => $data['1'],
                    'date_occ' => $data['2'],
                    'time_occ' => $data['3'],
                    'area' => $data['4'],
                    'area_name' => $data['5'],
                    'rpt_dist_no' => $data['6'],
                    'part_1_2' => $data['7'],
                    'crime_cd' => $data['8'],
                    'crime_cd_desc' => $data['9'],
                    'mocodes' => $data['10'],
                    'vict_age' => $data['11'],
                    'vict_sex' => $data['12'],
                    'vict_descent' => $data['13'],
                    'premis_cd' => $data['14'],
                    'premis_desc' => $data['15'],
                    'weapon_used_cd' => $data['16'],
                    'weapon_desc' => $data['17'],
                    'status' => $data['18'],
                    'status_desc' => $data['19'],
                    'crime_cd_1' => $data['20'],
                    'crime_cd_2' => $data['21'],
                    'crime_cd_3' => $data['22'],
                    'crime_cd_4' => $data['23'],
                    'location' => $data['24'],
                    'cross_street' => $data['25'],
                    'lat' => $data['26'],
                    'long' => $data['27'],
                ]);
            }
            $firstLine = false;
        }

        fclose($csv);
    }
}
