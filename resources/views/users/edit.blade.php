@extends('layouts.logged_in')

@section('content')
<h1>プロフィール編集</h1>

<form method="post" action="{{ route('profile.update', $user) }}" class="edit_content">
    @csrf
    @method('patch')
    <div class="edit_item">
        <label>
            名前:
            <input type="text" name="name" value="{{ $user->name }}">
        </label>
    </div>
    <div class="edit_item">
        <label>
            プロフィール:
            @if($user->profile !== '')
                <textarea name="profile" rows="9" cols="30">{{ $user->profile }}</textarea>
            @else
                <textarea name="profile" rows="9" cols="30" placeholder="プロフィールが設定されていません。"></textarea>
            @endif
        </label>
    </div>
    <input type="submit" value="更新" class="btn btn-primary">
</form>

@endsection