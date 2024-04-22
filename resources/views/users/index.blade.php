@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  
  <dl>
      @if($user->image == '')
      <dd><img src="{{ asset('images/no_image.png') }}"></dd>
      @else
      <dd><img src="{{ asset('storage/' . $user->image) }}">
      @endif
      <a href="{{ route('profile.edit_image') }}">画像を変更</a></dd><br>
      <dd>{{ $user->profile }}
      <a href="{{ route('profile.edit') }}">プロフィール編集</a></dd><br>
      出品数：{{ $user->items->count() }}<br>
      <br>
  <h1>購入履歴</h1>
      <ul>
      @forelse($user->orderItems as $item)
        <li><a href="{{ route('items.show',$item) }}">{{ $item->name }}</a>：{{ $item->price }}円　出品者 {{ $item->user->name }} さん</li>
      @empty
        <li>購入した商品はありません。</li>
      @endforelse
      </ul>
  </dl>
@endsection