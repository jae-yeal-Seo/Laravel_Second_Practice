<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // User - Comment( 1: N )

    protected $fillable = [
        'comment',
        'user_id',
        'post_id',
    ];


    public function user()
    {
        // Comment입장에서 연결된 User를 찾을 때
        // belongsTo라는 관계메서드를 통해서 연결시켜주면 된다.
        return $this->belongsTo(User::class, 'user_id', 'id', 'users');
        // select * from users where id = $this.user_id
    }
}
