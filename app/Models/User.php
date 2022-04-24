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
use Illuminate\Contracts\Auth\Access\Authorizable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use UserTrait;
    use SoftDeletes;
    use HasFactory;

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
}
