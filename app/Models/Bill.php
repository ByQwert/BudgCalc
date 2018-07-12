<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public $timestamps = false;

    protected $table = 'bills';

    protected $fillable = [
        'date', 'sum', 'tag_id', 'user_id',
    ];

    public function tag() {
//        return $this->hasOne(Tag::class, 'id', 'tag_id');
        return $this->hasOne(Tag::class, 'id', 'tag_id');
    }

    public function user() {
        return $this->hasOne(\App\Models\User::Class, 'id', 'user_id');
    }
}
