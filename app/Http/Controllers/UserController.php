<?php

namespace App\Http\Controllers;

use App\User;
use App\Item;
use App\Order;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserImageRequest;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //ログイン時のみ開ける
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //--------------------ユーザーの出品一覧-----------------
    //ログインしているユーザーが出品している商品一覧
    public function index()
    {
        $title = \Auth::user()->name . 'の出品一覧';
        $items = \Auth::user()->items()->latest()->get();
        return view('users.exhibitions', [
            'title' => $title,
            'items' => $items,
        ]);
    }
    
    //--------------------プロフィール-----------------------
    //プロフィール一覧ページ
    public function show(User $user)
    {
        $user = \Auth::user();
        $count_items = count($user->items);
        
        return view('users.show', [
            'user' => $user,
            'count_items' => $count_items,
        ]);
    }
    
    //プロフィール編集ページ
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
        ]);
    }
    
    //更新処理
    public function update(User $user, UserRequest $request)
    {
        $user->update($request->only(['name', 'profile']));
        session()->flash('success', 'プロフィールを更新しました。');
        return redirect()->route('users.show', $user); 
    }
    
    //プロフィール画像編集ページ
    public function editImage(User $user)
    {
        return view('users.edit_image', [
            'user' => $user,
        ]);
    }
    
    //更新処理
    public function updateImage(User $user, UserImageRequest $request, FileUploadService $service)
    {
        $user = \Auth::user();
        $path = $service->saveImage($request->file('image'));
        if($user->image !== ''){
            \Storage::disk('public')->delete(\Storage::url($user->image));
        }
        $user->update([
            'image' => $path,
        ]);
        
        session()->flash('success', 'プロフィール画像を更新しました。');
        return redirect()->route('users.show', $user);
    }
    
}
