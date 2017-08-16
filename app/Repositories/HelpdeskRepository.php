<?php 

namespace ActivismeBE\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use ActivismeBE\Helpdesk;
use ActivismeBE\Traits\Conditions\Helpdesk as HelpdeskConditions;

/**
 * Class HelpdeskRepository
 *
 * @package ActivismeBE\Repositories
 */
class HelpdeskRepository extends Repository
{
    use HelpdeskConditions; // Used for the IF/ELSE conditions.

    /**
     * Map the related model to the repository class.
     *
     * @return string
     */
    public function model()
    {
        return Helpdesk::class;
    }

    /**
     * Count method for counting helpdesk tickets in the system.
     *
     * @param  null|string $column
     * @param  null|string $value
     * @return integer
     */
    public function countQuestions($column = null, $value = null)
    {
        if (is_null($column) && is_null($value)) { // The application need all the questions.
            return $this->model->count();
        }

        return $this->model->where($column, $value)->count(); // Retrun count based on colum/value.
    }

    /**
     * Update a ticket in the database.
     *
     * @param  integer $ticketId The id from the ticket in the database.
     * @param  array   $data     The array with column/value pair that u want to update.
     * @return bool
     */
    public function updateTicket($ticketId, array $data)
    {
        if ($this->findTicket($ticketId)->update($data)) {
            return true; // UPDATE = OK
        }

        return false; // UPDATE = NOK
    }

    /**
     * Find a specific ticket in the database.
     *
     * @param  integer $ticketId The integer from the ticket in the database
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function findTicket($ticketId)
    {
        return $this->model->findOrFail($ticketId);
    }

    /**
     * Get all the tickets for the currently authencated user.
     *
     * @param  integer $type The type of the query.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|int
     */
    public function getAuthencatedUserTickets($type)
    {
        $query = $this->model->where('author_id', auth()->user()->id)
            ->with(['author', 'categories']);

        if ($this->isCount($type)) {
            return $query->count();
        } elseif ($this->isPagination($type)) {
            return $query->paginate(25);
        }
    }
}