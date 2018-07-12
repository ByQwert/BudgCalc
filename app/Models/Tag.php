<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = false;

    protected $table = 'tags';

//    public function bill() {
//        return $this->belongsTo(Bill::class, 'id', 'tag_id');
//    }
}
