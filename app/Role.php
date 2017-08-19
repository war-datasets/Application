<?php

namespace ActivismeBE;

use Spatie\Permission\Models\Role as BaseModel;

/**
 * Class Role
 *
 * @package ActivismeBE
 */
class Role extends BaseModel
{
    /**
     * Mass-assign fields for the database table.
     *
     * @var array
     */
    protected $fillable = ['author_id', 'system_role', 'guard_name', 'name', 'description'];

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
