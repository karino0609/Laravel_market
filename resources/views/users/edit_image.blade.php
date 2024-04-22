@extends('layouts.logged_in')

@section('title', $title)
 
@section('content')
    <h1>{{ $title }}</h1>
    <h2>現在の画像</h2>
    @if($user->image !== '')
        <img src="{{ \Storage::url($user->image) }}">
    @else
        画像はありません。
    @endif
    <form
        method="POST"
        action="{{ route('profile.update_image') }}"
        enctype="multipart/form-data"
    >
        @csrf
        @method('patch')
        <div>
            <label>
                画像を選択:
                <input type="file" name="image">
            </label>
        </div><br>
        <input type="submit" value="更新">
    </form>
@endsection