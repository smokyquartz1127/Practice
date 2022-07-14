@extends('layouts.not_logged_in')

@section('content')
<h1>ユーザー登録</h1>

<form method="post" action="{{ route('register') }}">
    @csrf
    <div class="edit_item">
        <label>
            ユーザー名:
            <input type="text" name="name">
        </label>    
    </div>
    <div class="edit_item">
        <label>
            メールアドレス:
            <input type="email" name="email">
        </label>    
    </div>
    <div class="edit_item">
        <label>
            パスワード:
            <input type="password" name="password">
        </label>    
    </div>
    <div class="edit_item">
        <label>
            パスワード（確認用）:
            <input type="password" name="password_confirmation">
        </label>
    </div>
    <div>
        <input type="submit" value="登録" class="btn btn-primary">
    </div>
</form>
@endsection
