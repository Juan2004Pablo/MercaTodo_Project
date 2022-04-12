<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Role;

trait UserTrait
{
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimesTamps();
    }
}
