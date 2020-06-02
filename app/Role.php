<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $fillable = [
        'name', 'label',
    ];

    /**
     * Each role can have many Permissions.
     *
     * @return BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    /**
     * Method that can allow role to have certain Permissions.
     * If param is string, then we first need to find that Permission and then attach it to the Role.
     *
     * @param $permission
     */
    public function allowTo($permission)
    {
        if (is_string($permission)) {
            $permission = Permission::whereName($permission)->firstOrFail();
        }

        $this->permissions()->sync($permission, false);
    }
}
