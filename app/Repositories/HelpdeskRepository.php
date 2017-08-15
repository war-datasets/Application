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
        if (is_null($column) && is_null($value)) { // The application need all the questions.
            return $this->model->count();
        }

        return $this->model->where($column, $value)->count(); // Retrun count based on colum/value.
    }

    public function updateTicket(array $data)
    {
    }

    public function findTicket($ticketId)
    {
    }
}