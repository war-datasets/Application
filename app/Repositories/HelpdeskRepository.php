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

    public function updateTicket(array $data)
    {
    }

    public function findTicket($ticketId)
    {
    }

    /**
     * Check if the authencated user has the right permissions to access the backend system.
     *
     * @return bool
     */
    public function userHasNeededRights()
    {
        $user = auth()->user();
        return $user->hasRole('admin') || $user->hasRole('helpdesk');
    }
}