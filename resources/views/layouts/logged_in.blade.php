@extends('layouts.default')
 
@section('header')
<header>
    <ul class="header_nav">
        <li>
          <a href="{{ route('items.index') }}">
            Market
          </a>
        </li>
        <li>
         <p>こんにちは、{{ Auth::user()->name }}さん！</p>
        </li>
        <li>
          <a href="{{ route('users.show', Auth::id()) }}">
          プロフィール
          </a>
        </li>
        <li>
          <a href="{{ route('likes.index') }}">
          お気に入り一覧
          </a>
        </li>
        <li>
          <a href="{{ route('users.exhibitions', Auth::id()) }}">
          出品商品一覧
          </a>
        </li>
        <li>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <input type="submit" value="ログアウト">
          </form>
        </li>
    </ul>
@if( Auth::check() )
    {{ Auth::user()->name }}
@endif
</header>
@endsection