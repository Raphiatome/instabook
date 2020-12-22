<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;


    /**
     * S'execute à la création du model
     */
    protected static function booted()
    {
        /**
         * Met en pause la création du model, vérifie que l'utilisateur est dans le groupe pour creer la photo dans ce meme groupe
         * 
         * @param Illuminate\Database\Eloquent\Model;
         * @return boolean;
         */
        static::creating(function($photo){
            if(!GroupUser::where('user_id', $photo->owner->id)
                         ->where('group_id', $photo->group->id)
                         ->exists()) return false;
            return true;
        });
    }


    /**
     * Retourne les commentaires de la photo
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments() 
    {
        return $this->hasMany(Comment::class);
    }


    /**
     * Retourne les tags de la photo
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class)
                    ->using(PhotoTag::class)
                    ->withPivot('id')
                    ->withTimestamps();
    }

    /**
     * Retourne l'utilisateur qui a publié la photo
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    /**
     * Retourne les utilisateurs identifiés sur cette photo
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->using(PhotoUser::class)
                    ->withPivot('id')
                    ->withTimestamps();
    }


    /**
     * Retourne le groupe auquel appartient la photo
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    
    /**
     * Variable assignables
     */
    protected $fillable =  [
        'title',
        'description',
        'date',
        'resolution',
        'width',
        'height',
        'created_at',
        'updated_at',
        'user_id'
    ];


}
 