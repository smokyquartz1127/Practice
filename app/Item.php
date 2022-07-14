<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'user_id', 'name', 'description', 'category_id', 'price', 'image',   
    ];

    //リレーション
    //【Userモデル】（出品者）
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    //【Categoryモデル】
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
    //【Likeモデル】
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
    public function likedUsers()
    {
        return $this->belongsToMany('App\User', 'likes');
    }
    
    //いいねされているかどうかをチェックする。
    public function isLikedby($user)
    {
        $liked_users_ids = $this->likedUsers->pluck('id');
        $result = $liked_users_ids->contains($user->id);
        return $result;
        
    }
    
    //【Orderモデル】（購入者）
    public function order()
    {
        return $this->hasOne('App\Order');
    }
    public function orderedUsers()
    {
        return $this->belongsTo('App\User', 'orders');
    }
    
}
