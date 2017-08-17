<?php

namespace ActivismeBE\Traits\Conditions;

/**
 * Trait Users
 *
 * @package ActivismeBE\Traits
 */
trait Users
{
    /**
     * Condition of the current authencated user is the given user.
     *
     * @param  mixed $user Thoe user collection from the database.
     * @return bool
     */
    public function userIsCurrentAuthencated($user)
    {
        dd($user);
        return auth()->user()->id === $user->id;
    }

    /**
     * See if the user is the currently authencated user.
     *
     * @param  integer $userId The id from the user u want to block.
     * @return bool
     */
    public function currentUser($userId)
    {
        return auth()->user()->id == $userId;
    }
}