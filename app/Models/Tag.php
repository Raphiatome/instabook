<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;


    /**
     * Retourne les photos liées au tag
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function photos()
    {
        return $this->belongsToMany(Photo::class)
                    ->using(PhotoTag::class)
                    ->withPivot('id')
                    ->withTimestamps();
    }

    protected $fillable = [
        'name',
        'created_at',
        'updated_at'
    ];
}
