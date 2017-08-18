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
}