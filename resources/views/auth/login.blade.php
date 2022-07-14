@extends('layouts.not_logged_in')

@section('content')
<h1>ログイン</h1>

<form method="post" action="{{ route('login') }}">
    @csrf
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
    <input type="submit" value="ログイン" class="btn btn-primary">
</form>
@endsection