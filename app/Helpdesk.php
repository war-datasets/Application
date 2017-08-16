<?php

namespace ActivismeBE;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Helpdesk
 *
 * @package ActivismeBE
 */
class Helpdesk extends Model
{
    /**
     * Mass-assign fields for the database table.
     *
     * @return array
     */
    protected $fillable = ['author_id', 'title', 'category_id', 'description', 'category_id', 'open', 'publish'];
}
