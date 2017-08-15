<?php 

namespace ActivismeBE\Repositories;

use ActivismeBE\Casualties;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class CasualtyRepository
 *
 * @package ActivismeBE\Repositories
 */
class CasualtyRepository extends Repository
{
    /**
     * Map the database model to the repository class.
     *
     * @return string
     */
    public function model()
    {
        return Casualties::class;
    }

    /**
     * Return the count of all documented casualties.
     *
     * @return integer
     */
    public function countAllCasualties()
    {
        return $this->model->count();
    }

    /**
     * Search for a specific casualty in the database.
     *
     * @param  string $term The name or service number from the casualty.
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function search($term)
    {
        return $this->model->where('member_name', 'LIKE', "%$term%")
            ->orWhere('service_no', 'LIKE', "%$term%");
    }
}