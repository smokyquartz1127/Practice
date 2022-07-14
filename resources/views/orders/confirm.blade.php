@extends('layouts.logged_in')

@section('content')
<h1>{{ $title }}</h1>

<dl>
    <dt>商品名</dt>
    <dd>{{ $item->name }}</dd>
    <dt>画像</dt>
    <dd class="product_detail"><img src="{{ asset('storage/' . $item->image) }}"</dd>
    <dt>カテゴリ</dt>
    <dd>{{ $item->category->name }}</dd>
    <dt>価格</dt>
    <dd>{{ $item->price }}円</dd>
    <dt>説明</dt>
    <dd>{{ $item->description }}</dd>
</dl>

<form method="post" action="{{ route('items.store_order') }}" >
    @csrf
    <input type="hidden" name="item_id" value="{{ $item->id }}">
    <input type="submit" value="内容を確認し、購入する" class="btn btn-primary">
</form>
@endsection