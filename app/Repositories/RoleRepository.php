<?php 

namespace ActivismeBE\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use ActivismeBE\Role;

/**
 * Class RoleRepository
 *
 * @package ActivismeBE\Repositories
 */
class RoleRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    /**
     * Get all the roles in the system.
     *
     * @param  integer $perPage The amount of records u want on a page.
     * @param  array   $columns The columns u needed in the output.
     * @return mixed
     */
    public function paginateAllRoles($perPage, array $columns = ['*'])
    {
        return $this->paginate($perPage, $columns);
    }

    /**
     * Create a new role in the system.
     *
     * @param  mixed $input The given user input.
     * @return mixed
     */
    public function createRole($input)
    {
        return $this->create($input->except(['_token']));
    }

    /**
     * Search for a specific role in the system.
     *
     * @param  string  $term    The term where u want to search on the page.
     * @param  integer $perPage The value of how many records u want per page.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchRole($term, $perPage)
    {
        return $this->model->where('name', 'LIKE', "%$term%")
            ->paginate($perPage);
    }

    /**
     * Delete a role out off the database.
     *
     * @param  integer $roleId The id form the role in the database.
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function findRole($roleId)
    {
        return $this->model->findOrFail($roleId);
    }
}