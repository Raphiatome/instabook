<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;


    /**
     * Retourne les photos du groupe
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    /**
     * Retourne les utilisateurs liés au groupe
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->using(GroupUser::class)
                    ->withPivot('id')
                    ->withTimestamps();
    }

    protected $fillable = [
        'name',
        'description'
    ];
}
