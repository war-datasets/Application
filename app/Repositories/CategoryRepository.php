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
     * @return string
     */
    public function model()
    {
        return Categories::class;
    }

    public function getRandomCategories($limit)
    {
        return $this->model->orderByRaw("RAND()")->take($limit)->get();
    }
}