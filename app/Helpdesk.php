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

    /**
     * Get the user information through the relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get the category information through the relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categories()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
