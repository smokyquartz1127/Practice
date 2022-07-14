@extends('layouts.logged_in')

@section('content')
<h1>{{ $title }}</h1>

<a href="{{ route('items.create') }}" class="btn btn-primary">新規出品</a>

@forelse($items as $item)
<div class="product_container">
    <div class="product_detail">
        <div>
            @if($item->image !== '')
                <a href="{{ route('items.show', $item) }}"><img src="{{ asset('storage/' . $item->image) }}"></a>
            @else
                <img src="{{ asset('images/no_image.png') }}">
            @endif
        </div> 
        <div>
            <p>{{ $item->description }}</p>
        </div>
    </div>
    
    
    {{--商品名--}}
    <div>
        <p>商品名:{{ $item->name }} {{ $item->price }}円</p>   
    </div>
    {{--売り切れ--}}
    <div class="soldout">
        @if(isset($item->order->item_id) === true)
           <p>売り切れ</p>
        @endif
    </div>
    <p class="category">カテゴリ:{{ $item->category->name }} ({{ $item->created_at }})</p>
    <div class="edit_link">
        [<a href="{{ route('items.edit', $item) }}">編集</a>]
        [<a href="{{ route('items.edit_image', $item) }}">画像を変更</a>]
    </div>
    
    <form method="post" action="{{ route('items.destroy', $item) }}">
        @csrf
        @method('delete')
        <input type="submit" value="削除" class="btn btn-danger">
    </form>
</div>
@empty
    <p>出品している商品はありません。</p>
@endforelse


@endsection