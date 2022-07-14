<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'image', 'profile'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    //リレーション
    public function items()
    {
        return $this->hasMany('App\Item');
    }
    
    //【お気に入り】
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
    public function likeItems()
    {
        return $this->belongsToMany('App\Item', 'likes')->withPivot('created_at')->orderBy('pivot_created_at', 'desc');
    }
    
    //【購入】
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    public function orderItems()
    {
        return $this->belongsToMany('App\Item', 'orders');
    }
}
