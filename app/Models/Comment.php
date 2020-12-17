<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
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
        static::creating(function($comment){
            if(!GroupUser::where('user_id', $comment->user->id)
                         ->where('group_id', $comment->photo->group->id)
                         ->exists()) return false;
            return true;
        });
    }

    /**
     * Retourne la photo du commentaire
     */
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    /**
     * Retourne les réponses de ce commentaire
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'comment_id');
    }
    
    /**
     * Retourne le commentaire parent de la réponse
     */
    public function replyTo()
    {
        return $this->belongsTo(Comment::class, 'comment_id', 'id');
    }

    /**
     * Retourne l'auteur du commentaire
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }



    protected $fillable = [
        'text',
        'user_id',
        'photo_id',
        'comment_id'
    ];
}
