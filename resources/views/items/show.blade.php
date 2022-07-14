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

<div class="soldout">
    @if(isset($item->order->item_id) === true)
        <p>売り切れ</p>
    @else
        <a href="{{ route('items.confirm', $item) }}" class="link_button btn btn-primary">購入する</a>    
    @endif
</div>

@endsection