<?php 

namespace ActivismeBE\Repositories;

use ActivismeBE\Casualties;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use Carbon\Carbon;

/**
 * Class DataProcessingRepository
 *
 * @package ActivismeBE\Repositories
 */
class DataProcessingRepository extends Repository
{
    /**
     * Map thue model instance to the repository.
     *
     * @return string
     */
    public function model()
    {
        return Casualties::class;
    }

    /**
     * Convert the given dataset data to a timestamp.
     *
     * @param  string $type
     * @param  string $column
     * @param  string $value
     * @return bool
     */
    public function convertToTimestamp($type, $column, $value)
    {
        $row = $this->findBy($column, $value);

        if ((int) count($row) > 0 && !empty($value)) { // The record is find in the database.
            if ((string) $type === 'full') { // The given value is some full date.
                $data   = ['year' => substr($value, 0, 4), 'month' => substr($value, 4, 2), 'day' => substr($value, 6, 2)];
                $date   = "{$data['year']}/{$data['month']}/{$data['day']}";
            } elseif ((string) $type === 'year') { // The given date is just a year.
                $data   = ['year' => substr($value, 0, 4)];
                $date   = "{$data['year']}/00/00";
            }

            return $this->model->where('service_no', $row->service_no)
                ->update([$column => $date]);
        }
    }
}