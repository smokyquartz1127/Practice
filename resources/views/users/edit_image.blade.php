@extends('layouts.logged_in')

@section('content')
<h1>プロフィール画像編集</h1>

<h2>現在の画像</h2>
    <div class="header_image">
        @if($user->image !== '')
            <img src="{{ asset('storage/' . $user->image) }}">
        @else
            <img src="{{ asset('images/no_image.png') }}">
        @endif    
    </div>
    <form method="post" action="{{ route('profile.update_image') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <label>
            画像を選択:
            <input type="file" name="image">
        </label>
        <div>
            <input type="submit" value="更新" class="btn btn-primary">    
        </div>
    </form>
@endsection