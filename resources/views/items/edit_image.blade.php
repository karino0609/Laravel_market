@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
      @if($item->image !== '')
        <img src="{{ \Storage::url($item->image) }}">
    @else
        画像はありません。
    @endif
  <form method="post" action="{{ route('items.update_image', $item) }}" enctype="multipart/form-data">
    　@csrf
    　@method('patch')
      <h2>現在の画像</h2>
      <div>
        <label>
              画像を選択: 
          <input type="file" name="image">
        </label>
      </div>
      <br>
      <input type="submit" value="更新">
  </form>
@endsection