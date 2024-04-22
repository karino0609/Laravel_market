@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  
  <ul class="items">
      @forelse($like_items as $item)
          <li class="item like">
            <div class="item_content">
              <div class="item_body">
                <div class="item_body_main">
                  <div class="item_body_main_img">
                    <a href="{{ route('items.show', $item) }}">
                    @if($item->image !== '')
                        <img src="{{ \Storage::url($item->image) }}">
                    @else
                        <img src="{{ asset('images/no_image.png') }}">
                    @endif
                    </a>
                     {{ $item->description }}
                   <div class="item_body_heading">
                  商品名: {{ $item->name }} {{ $item->price }}円<br>
                  カテゴリ: {{ $item->category->name }}
                  ({{ $item->created_at }})
                  </div> 
                  </div>
                  <div>{{ $item->isSoldout() ? '売り切れ' : '出品中' }}</div>
                  <div class="item_body_main">
                    {{ $item->user->name }}
                  </div>
                </div>
                <div class="item_body_footer">
                </div>
              </div>
            </div>
          </li>
      @empty
          <li>商品はありません。</li>
      @endforelse
  </ul>
@endsection