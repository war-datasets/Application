<?php 

namespace ActivismeBE\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use ActivismeBE\User;

/**
 * Class UserRepository
 *
 * @package ActivismeBE\Repositories
 */
class UserRepository extends Repository
{
    /**
     * The related database model.
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Return all the users in the database in paginated form.
     *
     * @param  integer $perPage The amount of articles you want per page.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginateAllUsers($perPage)
    {
        return $this->model->paginate($perPage);
    }
}