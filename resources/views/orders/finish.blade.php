@extends('layouts.logged_in')

@section('content')
<h1>ご購入ありがとうございました。</h1>

<dl>
    <dt>商品名</dt>
    <dd>{{ $item->name }}</dd>
    <dt>画像</dt>
    <dd class="product_detail"><img src="{{ asset('storage/' . $item->image) }}"></dd>
    <dt>カテゴリ</dt>
    <dd>{{ $item->category->name }}</dd>
    <dt>価格</dt>
    <dd>{{ $item->price }}円</dd>
    <dt>説明</dt>
    <dd>{{ $item->description }}</dd>
</dl>

<a href="{{ route('top') }}" class="finish_link">トップに戻る</a>
@endsection