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
                出品者：{{ $item->user->name }}
                ({{ $item->created_at }})
            </div>
            <div class="post_body_main">
                <div class="post_body_main_img">
                    <a href="{{ route('items.show', $item) }}">
                        @if($item->image !== '')
                        <img src="{{ \Storage::url($item->image) }}">
                        @else
                        <img src="{{ asset('images/no_image.png') }}">
                        @endif
                    </a>
                     {{ $item->description }}
                    <div>
                        商品名：{{ $item->name }}　{{ $item->price }}円
                        <div class="item_body_footer">
                            <a class="like_button">{{ $item->isLikedBy(Auth::user()) ? '★' : '☆' }}</a>
                            <form method="post" class="like" action="{{ route('likes.toggle_like', $item) }}">
                                @csrf
                                @method('patch')
                            </form>
                        </div>
                        <div>
                            カテゴリ：{{ $item->category->name }}
                        </div>
                        <div>{{ $item->isSoldout() ? '売り切れ' : '出品中' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </li>
    @empty
    <li>商品はありません</li>
    @endforelse
</ul>



{{ $items->withQueryString()->links('pagination::bootstrap-5') }}

<script>
    /* global $ */
    $('.like_button').each(function () {
        $(this).on('click', function () {
            $(this).next().submit();
        });
    });
</script>
@endsection