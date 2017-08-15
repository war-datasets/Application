<?php

namespace ActivismeBE;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Casualties
 *
 * @package ActivismeBE
 */
class Casualties extends Model
{
    /**
     * Map the default primary key 'id' to the service number of the soldier.
     *
     * @var string
     */
    // protected $primaryKey = 'service_no';

    /**
     * Mass-assign fields for the database table.
     *
     * @var array
     */
    protected $fillable = [
        'service_no', 'c', 'ptp', 'person_type_name', 'member_name',
        's', 'service_name', 'rank_rate', 'pg', 'occ', 'occupation_name',
        'birth_date', 'g', 'hor_city', 'hor_county', 'hor_cntry', 'hor_st',
        'state_prv_nm', 'marital_status', 'religion_name', 'l', 'race_name',
        'ethnic_name', 'race_omb', 'ethnic_group_name', 'cas_circumstances',
        'cas_city', 'cas_st', 'cas_ctry', 'cas_region_code', 'country_or_water_name',
        'unit_name', 'd', 'process_dt', 'death_dt', 'year', 'wc', 'oitp', 'oi_name',
        'oi_location', 'close_dt', 'aircraft', 'h', 'casualty_type_name',
        'casualty_category', 'casualty_reason_name', 'csn', 'body', 'casualty_closure_name',
        'wall', 'incident_category', 'i_status_dt', 'i_csn', 'i_h', 'i_aircraft'
    ];

}
