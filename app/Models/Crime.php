<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crime extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array.
     */
    protected $fillable = [
        'dr_no', 'date_rptd', 'date_occ', 'time_occ', 'area', 'area_name', 'rpt_dist_no', 'part_1_2', 'crime_cd', 'crime_cd_desc', 'mocodes', 'vict_age', 'vict_sex', 'vict_descent', 'premis_cd', 'premis_desc', 'weapon_used_cd', 'weapon_desc', 'status', 'status_desc', 'crime_cd_1', 'crime_cd_2', 'crime_cd_3', 'crime_cd_4', 'location', 'cross_street',  'lat', 'long', 'city', 'state', 'zipcode'
    ];
}
