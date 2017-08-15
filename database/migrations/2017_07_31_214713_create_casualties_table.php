<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasualtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casualties', function (Blueprint $table) {
            // $table->increments('id');
            $table->string('service_no')->comment('Service Number');
            $table->string('c')->comment('Member Component code');
            $table->string('ptp')->comment('Person Type Name Code');
            $table->string('person_type_name')->comment('Person Type Name');
            $table->string('member_name')->comment('Member name');

            // Codes: A = Army, F = Air Force, M = marie Corps, N = Navy
            $table->string('s')->comment('Member Service Code');

            $table->string('service_name')->comment('Member Service name');
            $table->string('rank_rate')->comment('Membver rank or rate');
            $table->string('pg')->comment('Member paygrade');
            $table->string('occ')->comment('Member occupation code');
            $table->string('occupation_name')->comment('Member occupation code');

            // FORMAT: YYYY/MM/DD
            $table->string('birth_date')->default('Date unknown')->comment('Member Bitthdate');

            // Codes: M = Male, F = Female
            $table->string('g')->comment('Members Gender');
            $table->string('hor_city')->default('Place unknown')->comment('Home of record city.');
            $table->string('hor_county')->comment('Home of record country');
            $table->string('hor_cntry')->comment('Home of record Country Code');
            $table->string('hor_st')->comment('Home or record state code');
            $table->string('state_prv_nm')->comment('State or Province name');
            $table->string('marital_status')->comment('Marital Status');
            $table->string('religion_name')->comment('Religion short code');
            $table->string('l')->comment('Religion code');
            $table->string('race_name')->comment('Race name');
            $table->string('ethnic_name')->comment('Ethnic short name');
            $table->string('race_omb')->comment('Race OMB name');
            $table->string('ethnic_group_name')->comment('Ethnic group name');
            $table->string('cas_circumstances')->comment('Casualty Circumstances');
            $table->string('cas_city')->comment('Casualty City');
            $table->string('cas_st')->comment('Casualty State or Province code');
            $table->string('cas_ctry')->comment('Casualty Country/Over water code');
            $table->string('cas_region_code')->comment('Casualty region code');
            $table->string('country_or_water_name')->comment('Country/over water name');
            $table->string('unit_name')->comment('unit_name');
            $table->string('d')->comment('Duty code');

            // FORMAT: YYYY/MM/DD
            $table->string('process_dt')->comment('Process date');

            // FORMAT: YYYY/MM/DD
            $table->string('death_dt')->comment('Incident or Death Date');

            // FORMAT: YYYY
            $table->string('year')->comment('Year of death');

            // Codes: V = Vietname Conflict, K = Korean War
            $table->string('wc')->comment('War of Conflict code');
            $table->string('oitp')->comment('Operation Incident Type Code');
            $table->string('oi_name')->comment('Operation/Incident name');
            $table->string('oi_location')->comment('Location name');

            // FORMAT: YYYY/MM/DD
            $table->string('close_dt')->commit('Closure date');
            $table->string('aircraft')->commit('Aircraft type');

            // Codes: H = Hostile, NH = Non-Hostile Death
            $table->string('h')->comment('Hostile or Non-Hostile Death Indicator');
            $table->string('casualty_type_name')->comment('Casualty Type Name');
            $table->string('casualty_category')->comment('Casualty Category Name');
            $table->string('casualty_reason_name')->comment('Incident Casualty Reason Name');
            $table->string('csn')->comment('Casualty Cat. Shot name');

            // Codes: Y = Body remainsrecovered, N = Body remains not recovered.
            $table->string('body')->comment('Remains Recovered');
            $table->string('casualty_closure_name')->comment('Casualty Closure name');
            $table->string('wall')->comment('Vietname row and panel Indicator');
            $table->string('incident_category')->comment('Casualty category name');

            // FORMAT: YYYY/MM/DD
            $table->string('i_status_dt')->comment('Incident Casualty Category Date');
            $table->string('i_csn')->comment('Incident casualty cat. short name');
            $table->string('i_h')->comment('Incident Hostile or non-hostile death');
            $table->string('i_aircraft')->comment('Incident Aircraft Type');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('casualties');
    }
}
