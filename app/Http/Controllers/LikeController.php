<?php

namespace App\Http\Controllers;

use App\Item;
use App\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //ログイン時のみ開ける
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $items = \Auth::user()->likeItems()->get();
        
        return view('likes.index', [
            'title' => 'お気に入り一覧',
            'items' => $items,
        ]);
    }
    
    public function toggleLike(Item $item)
    {
        $user = \Auth::user();
        
        if($item->isLikedby($user)){
            $item->likes->where('user_id', $user->id)->first()->delete();
            \Session::flash('success', 'お気に入り登録を取り消しました。');
        } else {
            Like::create([
                'user_id' => $user->id,
                'item_id' => $item->id,
            ]);
            \Session::flash('success', 'お気に入りに登録しました。');
        }
        return redirect('/');
    }
}
