<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "content",
        "user_id"
    ];

    public function writer()
    {
        /* User <-> Post의 관계 */
        // 1: N
        // User는 hasMany posts
        // Post는 belongs to a User
        return $this->belongsTo(User::class, "user_id");
        /*
         select 
         from users u , posts p 
         inner join on u.id = p.user_id
         이렇게 가져와줌.

         알아서 추측가능한 이유 
         : 외래키 이름 : 메소드이름_기본키이름으로 해 둬야.(관례)
        */
    }
}
