<?php

namespace ActivismeBE\Traits\Conditions;

use Chrisbjr\ApiGuard\Models\ApiKey as Database;

/**
 * Trait ApiKey
 *
 * @package ActivismeBE\Traits\Conditions
 */
trait ApiKey
{
    /**
     * Condition for checking is the user can delete the api key.
     *
     * @param  mixed   $user   The instance from the currently authenticated user.
     * @param  integer $apiKey The primary key for the api key in the database.
     * @return bool
     */
    public function canDeleteApiKey($user, $apiKey)
    {
        $db = new Database;
        $keyCheck = $db->find($apiKey);

        if (count($keyCheck) > 0) {
            // RETURN: Condition to check against.
            return $user->hasRole('admin') || $keyCheck->apikeyable_id === $user->id;
        }

        return false; // There is no key with the id found.
    }
}