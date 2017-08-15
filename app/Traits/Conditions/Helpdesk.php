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
     * @param $ticket
     * @return bool
     */
    public function userCanViewTicket($ticket)
    {
        $user = auth()->user();

        $checkAdmin  = $user->hasRole('admin') || $user->hasRole('helpdesk');
        $checkAuthor = $ticket->author_id === $user->id;

        return $checkAdmin || $checkAuthor;
    }
}