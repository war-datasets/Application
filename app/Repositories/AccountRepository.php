<?php 

namespace ActivismeBE\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use ActivismeBE\User;

/**
 * Class AccountRepository
 *
 * @package ActivismeBE\Repositories
 */
class AccountRepository extends Repository
{
    /**
     * Map the related database model to the repository class.
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }
}