<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //リレーション
    //【Itemモデル】
    public function items()
    {
        return $this->hasMany('App\Item');
    }
}
