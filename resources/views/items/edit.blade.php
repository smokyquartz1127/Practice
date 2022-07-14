@extends('layouts.logged_in')

@section('content')
<h1>{{ $title }}</h1>

<h2>商品追加フォーム</h2>

<form method="post" action="{{ route('items.update', $item) }}" class="form_style">
    @csrf
    @method('patch')
    <div class="edit_item">
        <label>
            商品名:
            <input type="text" name="name" value="{{ $item->name }}">
        </label>
    </div>
    <div class="edit_item">
        <label>
            商品説明:
            <textarea name="description" rows="10" cols="50">{{ $item->description }}</textarea>
        </label>
    </div>
    <div class="edit_item">
        <label>
            価格:
            <input type="text" name="price" value="{{ $item->price }}">
        </label>
    </div>
    <div class="edit_item">
        <label>
            カテゴリー:
            <select name="category_id">
                <option value="">---カテゴリーを選択してください---</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id === $item->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </label>
    </div>
    <input type="submit" value="出品" class="btn btn-primary">
</form>
@endsection