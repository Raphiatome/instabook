<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PhotoUser extends Pivot
{
    use HasFactory;


    /**
     * S'execute à la création du model
     */
    protected static function booted()
    {
        /**
         * Met en pause la création du model, vérifie que l'utilisateur est dans le meme groupe que la photo pour commenter
         * 
         * @param Illuminate\Database\Eloquent\Model;
         * @return boolean;
         */
        static::creating(function($photoUser){
            $photo = Photo::where('id', $photoUser->photo_id)->first();
            $group_user = GroupUser::where('user_id', $photoUser->user_id)
                                   ->where('group_id', $photo->group->id);
            if(!$group_user->exists()) return false;
            return true;
        });
    }

    protected $fillable = [
        'user_id',
        'photo_id',
        'created_at',
        'updated_at'
    ];
}
