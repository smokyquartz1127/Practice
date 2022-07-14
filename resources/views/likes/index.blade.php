@extends('layouts.logged_in')

@section('content')
<h1>{{ $title }}</h1>

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

    <div class="category">
        <p>カテゴリ:{{ $item->category->name }} ({{ $item->created_at }})</p>    
    </div>
    
</div>
@empty
    <p>出品している商品はありません。</p>
@endforelse


@endsection