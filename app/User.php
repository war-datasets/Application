<?php

namespace ActivismeBE;

use Cog\Ban\Contracts\HasBans as HasBansContract;
use Chrisbjr\ApiGuard\Models\Mixins\Apikeyable;
use Cog\Ban\Traits\HasBans;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 *
 * @package ActivismeBE
 */
class User extends Authenticatable implements HasBansContract
{
    use Notifiable, Apikeyable, HasRoles, HasBans;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
}
