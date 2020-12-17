<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PhotoTag extends Pivot
{
    use HasFactory;

    /**
     * Retourne la photo assignée au tag
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    /**
     * Retourne le tag assigné à la photo
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    protected $fillable = [
        'photo_id',
        'tag_id',
        'created_at',
        'updated_at'
    ];
}
