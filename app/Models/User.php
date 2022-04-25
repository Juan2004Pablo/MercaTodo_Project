<?php

namespace App\Models;

use App\Traits\UserTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use UserTrait;
    use SoftDeletes;
    use HasFactory;
    use HasRoles;

    protected $fillable =
    [
        'name', 'surname', 'identification', 'address', 'phone', 'email', 'password',
    ];

    protected $hidden =
    [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    protected $casts =
    [
        'email_verified_at' => 'datetime',
    ];

    public function image(): MorphOne
    {
        return $this->morphOne('App\Models\Image', 'imageable');
    }

    public function orders(): BelongsTo
    {
        return $this->belongsTo('App\Models\Order');
    }

    //$role = Role::create(['name' => 'seller']);
    //$permission = Permission::create(['name' => 'see products']);

    //$role->syncPermissions($permissions);
}
