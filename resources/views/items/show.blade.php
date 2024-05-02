@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
    <h1>{{ $title }}</h1>
    <dl>
        <dt>商品名</dt>
        <dd>{{ $item->name }}</dd>
        <dt>画像</dt>
        @if($item->image === '')
            <dd><image src="{{ asset('images/no_image.png') }}"></dd>
        @else
            <dd><image src="{{ asset('storage/' . $item->image) }}"></dd>
        @endif
        <dt>カテゴリー</dt>
        <dd>{{ $item->category->name }}</dd>
        <dt>価格</dt>
        <dd>{{ $item->price }}</dd>
        <dt>説明</dt>
        <dd>{{ $item->description }}</dd>
    </dl>
    @if(Auth::id() != $item->user_id)
    <form method="get" action="{{ route('items.confirm', $item) }}">
        <input type="submit" value="購入する">
    </form>
    @endif
@endsection