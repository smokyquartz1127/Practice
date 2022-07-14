@extends('layouts.logged_in')

@section('content')
<p class="chatchphrase">{{ $chatchphrase }}</p>

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
    <div class="item_name_like">
        <div>
            <p>商品名: {{ $item->name }} {{ $item->price }}円</p>   
        </div>
        {{--いいねボタン--}}
        <div>
            <a class="like_button">{{ $item->isLikedBy(Auth::user()) ? '★' : '☆' }}</a>
            <form method="post" action="{{ route('items.toggle_like', $item) }}">
            @csrf
            @method('patch')
            </form>       
        </div>
        <div class="soldout">
            @if(isset($item->order->item_id) === true)
               <p>売り切れ</p>
            @endif
        </div>
    </div>
    
    <p class="category">カテゴリ: {{ $item->category->name }} ({{ $item->created_at }})</p>    
  </div>
@empty
    <p>商品はありません。</p>
@endforelse
@endsection

@section('script')

<script>
    $('.like_button').each(function() {
        $(this).on('click', function() {
            $(this).next().submit();
        });
    });    
</script>

@endsection

