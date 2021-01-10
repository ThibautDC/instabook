<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected static function booted() {
        //Commentaire non crée si l'utilisateur n'est pas dans le meme groupe
        static::creating(function ($comment) {
            return !is_null($comment->photo->group->users->find($comment->user_id));
        });
    }

    /**
     * Renvoi l'utilisateur qui a mis la pièce jointe
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
     public function photo()
     {
         return $this->belongsTo(Photo::class);
     }

    /**
     * Renvoi l'utilisateur qui a repondu
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
     public function user()
     {
         return $this->belongsTo(User::class);
     }

     // Renvoi les reponses des utilisateurs
    public function replyTo()
     {
        return $this->belongsTo(Comment::class,'comment_id','id');
     }

     //Renvoie les reponses des commentaires
    public function replies()
     {
         return $this->hasMany(Comment::class);
     }
}
