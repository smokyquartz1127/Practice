@extends('layouts.logged_in')

@section('content')
    <h1>プロフィール</h1>
    
    <div class="header_container">
        <div class="header_image">
            @if($user->image !== '')
                <img src="{{ asset('storage/' . $user->image) }}">
            @else
                <img src="{{ asset('images/no_image.png') }}">
            @endif    
        </div>
        <div class="edit_image_link">
            <a href="{{ route('profile.edit_image', $user) }}">画像を変更</a>
        </div>
    </div>
    
    <div class="profile_content">
        <p>{{ \Auth::user()->name }} さん</p>
        
        <div class="self_introduce">
            @if($user->profile !== '')
                <p>{{ $user->profile }}</p>
            @else
                <p>プロフィールがありません。</p>
            @endif
            
            <a href="{{ route('profile.edit', $user) }}">プロフィールを編集</a>
        </div>
        
        <p>出品数: {{ $count_items }}</p>
    </div>
    
    <h2>購入履歴</h2>
    <ul class="buy_list">
        @forelse($user->orders as $order)
            <li>{{ $order->item->name }}:{{ $order->item->price }}円 出品者 {{ $order->item->user->name }} さん</li>
        @empty
            <li>購入した商品はありません。</li>
        @endforelse    
    </ul>
   
    
    


@endsection