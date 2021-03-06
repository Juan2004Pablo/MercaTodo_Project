<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'url', 'imageable_type', 'imageable_id',
    ];
    /*public function url(): string
    {
        return Storage::disk(config('filesystems.images_disk'))->url("{$this->product_id}/{$this->file_name}");
    }*/

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
