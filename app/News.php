<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\NewsCategory', 'category_id', 'id');
    }
}
