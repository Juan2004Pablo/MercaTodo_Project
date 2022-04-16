<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Models\Detail;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'code','subtotal','total','status','user_id',
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(Detail::class);
    }

    public function scopeOpen($query): Builder
    {
        return $query->where('orders.user_id', '=', Auth::user()->id)
            ->where('orders.status', '=', 'PENDING');
    }

    public function scopeRejected($query): Builder
    {
        return $query->Orwhere('orders.status', '=', 'REJECTED');
    }

    public function scopeStatusOrder($query, $status)
    {
        if ($status) {
            return $query->where('status', 'like', "%$status%");
        }
    }

    public function scopeDateOrder($query, $date)
    {
        if ($date) {
            return $query->where('updated_at', 'like', "%$date%");
        }
    }
}
