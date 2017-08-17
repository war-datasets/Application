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

    /**
     * Find a user in the database.
     *
     * @param  integer $userId The user id in the database.
     * @return mixed
     */
    public function findUser($userId)
    {
        return $this->findOrFail($userId);
    }

    /**
     * Search for a specific user in the database.
     *
     * @param  string  $searchTerm  The data input where u want to search for.
     * @param  integer $perPage     Results per page.
     * @return mixed
     */
    public function searchUser($searchTerm, $perPage)
    {
        return $this->model->where('name', 'LIKE', "$searchTerm")
            ->orWhere('email', 'LIKE', "$searchTerm")
            ->paginate($perPage);
    }
}