<?php 

namespace ActivismeBE\Repositories;

use ActivismeBE\Casualties;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use Illuminate\Support\Facades\DB;

/**
 * Class DatasetRepository
 *
 * @package ActivismeBE\Repositories
 */
class DatasetRepository extends Repository
{
    /**
     * The related database model.
     *
     * @return string
     */
    public function model()
    {
        return Casualties::class;
    }

    /**
     * Migrate the dataset into the database.
     *
     * @return boolean
     */
    public function migrateKorea()
    {
        $path = database_path('datasets/DCAS.KS.EXT08.DAT');
        return DB::unprepared("LOAD DATA LOCAL INFILE '{$path}' INTO TABLE casualties FIELDS TERMINATED BY '|'");
    }

    /**
     * Migrate the dataset into the database.
     *
     * @return boolean
     */
    public function migrateVietnam()
    {
        ini_set('memory_limit','1600000M');
        $path = database_path('datasets/DCAS.VN.EXT08.DAT');

        return DB::unprepared("LOAD DATA LOCAL INFILE '{$path}' INTO TABLE casualties FIELDS TERMINATED BY '|'");
    }

    /**
     * Count all the records from the database table.
     *
     * @return integer
     */
    public function countAllRecords()
    {
        return $this->model->count();
    }

    /**
     * Truncate the given database table.
     *
     * @param  string $dbTable The database table name.
     * @return boolean
     */
    public function removeAllData($dbTable)
    {
        if (DB::table($dbTable)->delete()) {
            return true;
        };

        return false;
    }


    /**
     * Get all the data out of the table.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getData()
    {
        return $this->model->get(); // Return all the records.
    }
}