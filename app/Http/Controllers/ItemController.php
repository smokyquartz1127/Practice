<?php

namespace App\Http\Controllers;

use App\Item;
use App\Category;
use App\Like;
use App\Order;
use App\Services\FileUploadService;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\TextRequest;
use App\Http\Requests\UserImageRequest;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //ログイン時のみ開ける
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //------------------------------トップページ---------------------------
    //自分以外のユーザーの商品を表示
    public function index()
    {
        $chatchphrase = '息をするように、買おう。';
        
        $user_id = \Auth::user()->id;
        $items = Item::where('user_id', '!=',  $user_id)->latest()->get();

        return view('welcome.top', [
            'title' => 'トップページ',
            'chatchphrase' => $chatchphrase,
            'items' => $items,
            'category' => Category::all(),
        ]);
    }
  
    //-------------------------------出品-------------------------------------
    //新規出品ページ
    public function create()
    {
        $title = '商品を出品';
        return view('items.create', [
            'title' => $title,
            'categories' => Category::all(),
        ]);
    }
    
    //新規出品処理
    public function store(ItemRequest $request, FileUploadService $service)
    {
        $path = $service->saveImage($request->file('image'));
        $categories = Category::all();
        Item::create([
            'user_id' => \Auth::user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'image' => $path,
        ]);
        session()->flash('success', '出品しました。');
        return redirect()->route('users.exhibitions', \Auth::user());
    }

    //商品詳細ページ
    public function show(Item $item)
    {
        return view('items.show', [
            'title' => '商品詳細',
            'item' => $item,
        ]);
    }

    //商品情報の編集ページ
    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('items.edit', [
            'title' => '商品情報の編集',
            'categories' => $categories,
            'item' => $item,
        ]);
    }

    //商品情報更新処理
    public function update(TextRequest $request, Item $item)
    {
        $item->update($request->only(['name', 'description', 'price', 'category_id']));
        session()->flash('success', '商品情報を編集しました。');
        return redirect()->route('users.exhibitions', \Auth::user());
    }
    
    //商品画像の編集ページ
    public function editImage(Item $item)
    {
        return view('items.edit_image', [
            'title' => '商品画像の変更',
            'item' => $item,
        ]);
    }
    
    //商品画像更新処理
    public function updateImage(UserImageRequest $request, Item $item, FileUploadService $service)
    {
        $path = $service->saveImage($request->file('image'));
        if($item->image !== ''){
            \Storage::disk('public')->delete(\Storage::url($item->image));
        }
        $item->update([
            'image' => $path,
        ]);
        session()->flash('success', '商品画像を更新しました。');
        return redirect()->route('users.exhibitions', \Auth::user());
    }

    //商品ページの削除処理
    public function destroy(Item $item)
    {
        $user = \Auth::user();
        if($item->image !== ''){
            \Storage::disk('public')->delete(\Storage::url($item->image));
        }
        $item->delete();
        session()->flash('success', '商品を削除しました。');
        return redirect()->route('users.exhibitions', $user);
    }
    
    //--------------------------------購入----------------------------------------
    public function confirm(Item $item)
    {
        return view('orders.confirm', [
            'title' => '購入確認',
            'item' => $item,
        ]);
    }
    //購入処理
    public function storeOrder(Request $request)
    {
        $item = $request->item_id;
        Order::create([
            'user_id' => \Auth::user()->id,
            'item_id' => $item,
        ]);
        session()->flash('success', '購入完了');
        return redirect()->route('items.finish', $item);
    }
    
    public function finish(Item $item)
    {
        return view('orders.finish', [
            'title' => '購入完了画面',
            'item' => $item,
        ]);
    }
}
