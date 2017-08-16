<?php

namespace ActivismeBE\Traits\Conditions;

/**
 * Trait Helpdesk
 *
 * @package ActivismeBE\Traits\Conditions
 */
trait Helpdesk
{
    /**
     * Check if the authencated user has the right permissions to access the backend system.
     *
     * @return bool
     */
    public function userHasAdminRights()
    {
        $user = auth()->user();
        return $user->hasRole('admin') || $user->hasRole('helpdesk');
    }

    /**
     * Determine if the authencated user can view the ticket or not.
     *
     * @param  mixed $ticket The ticket information from the database.
     * @return bool
     */
    public function userCanViewTicket($ticket)
    {
        $user = auth()->user();

        $checkAdmin  = $user->hasRole('admin') || $user->hasRole('helpdesk');
        $checkAuthor = $ticket->author_id === $user->id;

        return $checkAdmin || $checkAuthor;
    }

    /**
     * Check if we need to count the results or not.
     *
     * @param  string $type The type for the query.
     * @return bool
     */
    public function isCount($type)
    {
        return $type == 'count';
    }

    /**
     * Check if the query needs to build up as pagination.
     *
     * @param  string $type The type for the query.
     * @return bool
     */
    public function isPagination($type)
    {
        return $type == 'paginate';
    }
}