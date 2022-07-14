@extends('layouts.logged_in')

@section('content')
<h1>{{ $title }}</h1></h1>

<h2>商品追加フォーム</h2>

<form method="post" action="{{ route('items.store') }}" enctype="multipart/form-data" class="form_style">
    @csrf
    <div class="edit_item">
        <label>
            商品名:
            <input type="text" name="name">
        </label>
    </div>
    <div class="edit_item">
        <label>
            商品説明:
            <textarea name="description" rows="10" cols="50"></textarea>
        </label>
    </div>
    <div class="edit_item">
        <label>
            価格:
            <input type="text" name="price">
        </label>
    </div>
    <div class="edit_item">
        <label>
            カテゴリー:
            <select name="category_id">
                    <option value="" selected>---カテゴリーを選択してください---</option>
                @forelse($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @empty
                    <p>カテゴリーが存在しません。</p>
                @endforelse
            </select>
        </label>
    </div>
    <div>
        <label>
            画像を選択:
            <input type="file" name="image">
        </label>
    </div>
    <input type="submit" value="出品" class="btn btn-primary">
</form>
@endsection