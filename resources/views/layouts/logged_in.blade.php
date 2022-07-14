@extends('layouts.default')

@section('header')
<header>
    <ul class="link_nav">
        <li>
            <a href="{{ route('top') }}">Market</a>
        </li>
        <li>
            こんにちは、{{ \Auth::user()->name }}さん！
        </li>
        <li>
            <a href="{{ route('users.show', \Auth::user()) }}">プロフィール</a>
        </li>
        <li>
            <a href="{{ route('likes.index') }}">お気に入り一覧</a>
        </li>
        <li>
            <a href="{{ route('users.exhibitions',\Auth::user()) }}">出品商品一覧</a>
        </li>
        
        <form method="post" action="{{ route('logout') }}">
            @csrf
            <input type="submit" value="ログアウト" class="btn btn-secondary">
        </form>
    </ul>    
</header>
@endsection
