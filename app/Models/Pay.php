<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class Pay extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference','total','status','user_id','order_id',
    ];

    public function orders(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function scopeinProcess($query): Builder
    {
        return $query->where('user_id', Auth::user()->id)->where('status', 'PENDING');
    }

    public function scopePending($query): Builder
    {
        return $query->where('status', '=', 'PENDING');
    }
}
