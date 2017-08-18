<?php

namespace ActivismeBE;

use Spatie\Permission\Models\Permission as BaseModel;

/**
 * Class Permission
 *
 * @package ActivismeBE
 */
class Permission extends BaseModel
{
    /**
     * Mass-assign fields for the database table.
     *
     * @var array
     */
    protected $fillable = ['author_id', 'system_permission', 'name', 'description'];

    /**
     * Author data relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
