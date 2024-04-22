@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  
  <a href="{{ route('items.create') }}">新規出品</a>
  <ul class="item">
      @forelse($items as $item)
          <li class="item">
            <div class="item_content">
              <div class="item_body">
                  <div class="post_body_main_img">
                    <a href="{{ route('items.show', $item) }}">
                    @if($item->image !== '')
                        <img src="{{ \Storage::url($item->image) }}">
                    @else
                        <img src="{{ asset('images/no_image.png') }}">
                    @endif
                    </a>
                    {{ $item->description }}
　　　　　　　　<div class="post_body_heading">
                商品名：{{ $item->name }} {{ $item->price }}円<br>
                カテゴリ：{{ $item->category->name }}
                ({{ $item->created_at }})
                </div>
                </div>
                <div>{{ $item->isSoldout() ? '売り切れ' : '出品中' }}</div>
                  [<a href="{{ route('items.edit', $item) }}">編集</a>]
                  [<a href="{{ route('items.edit_image', $item) }}">画像を変更</a>]<br>
                  <form class="delete" method="post" action="{{ route('items.destroy', $item) }}">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="削除">
                  </form>
                </div>
              </div>
          </li>
      @empty
      <li>商品はありません</li>
      @endforelse
  </ul>
  @endsection
  