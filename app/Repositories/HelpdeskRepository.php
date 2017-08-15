<?php 

namespace ActivismeBE\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use ActivismeBE\Helpdesk;

/**
 * Class HelpdeskRepository
 *
 * @package ActivismeBE\Repositories
 */
class HelpdeskRepository extends Repository
{
    /**
     * Map the related model to the repository class.
     *
     * @return string
     */
    public function model()
    {
        return Helpdesk::class;
    }

    public function countQuestions($column = null, $value = null)
    {
    }
}