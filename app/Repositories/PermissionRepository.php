<?php 

namespace ActivismeBE\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use ActivismeBE\Permission;

/**
 * Class PermissionRepository
 *
 * @package ActivismeBE\Repositories
 */
class PermissionRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    /**
     * Create a new permission in the system.
     *
     * @param  int $input The given user input.
     * @return mixed
     */
    public function createPermission($input)
    {
        return $this->create($input->except(['_token']));
    }

    public function getIndexPermissions($int)
    {
    }

    /**
     * Search for a specific permission in the system.
     *
     * @param  string  $term    The word or name where u want to search on.
     * @param  integer $perPage The amount of rows per page.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchPermission($term, $perPage)
    {
        return $this->model->where('name', 'LIKE', "$term")
            ->paginate($perPage);
    }
}