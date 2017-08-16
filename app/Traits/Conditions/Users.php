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
}