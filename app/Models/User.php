<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    static $rules = [
		'name' => 'required',
		'surname' => 'required',
        'identification' => 'required',
        'address' => 'required',
        'phone' => 'required',
        'email' => 'required',
		'role' => 'required'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'disable_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password): void 
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function image(): MorphOne
    {
        return $this->morphOne('Image(Image)', '(imageable=)');
    }

    public function orders(): BelongsTo
    {
        return $this->belongsTo('App\MercatodoModels\Order');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimesTamps();
    }
}