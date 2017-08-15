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
     * @return string
     */
    public function model()
    {
        return Casualties::class;
    }

    public function countAllCasualties()
    {
        return $this->model->count();
    }

    public function search($term)
    {
        return $this->model->where('member_name', 'LIKE', "%$term%")
            ->orWhere('service_no', 'LIKE', "%$term%")
            ->paginate(50);
    }
}