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

    /**
     * Update the account security from the current authencated user.
     *
     * @param  array $input The user given form input.
     * @return mixed
     */
    public function securityUpdate(array $input)
    {
        return $this->update(['password' => bcrypt($input['password'])], auth()->user()->id);
    }

    public function infoUpdate(array $input)
    {
    }
}