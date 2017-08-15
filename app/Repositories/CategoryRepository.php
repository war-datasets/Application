<?php 

namespace ActivismeBE\Repositories;

use ActivismeBE\Categories;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class CategoryRepository
 *
 * @package ActivismeBE\Repositories
 */
class CategoryRepository extends Repository
{
    /**
     * The related database model.
     *
     * @return string
     */
    public function model()
    {
        return Categories::class;
    }

    /**
     * Get random categories from the database.
     *
     * @param  integer $limit Limit amount for the database.
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */
    public function getRandomCategories($limit)
    {
        return $this->model->orderByRaw("RAND()")->take($limit)->get();
    }
}