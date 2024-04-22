@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <form method="post" action="{{ route('items.update', $item) }}" enctype="multipart/form-data">
      @csrf
      @method('patch')
      <h2>商品追加フォーム</h2>
      <div>
          <label>
              商品名:<br>
              <input type="text" name="name" value="{{ $item->name }}"><br>
          </label>
      </div>
      <div>
          <label>
              商品説明:<br>
              <textarea name="description" cols="30" rows="10">{{ $item->description }}</textarea><br>
          </label>
      </div>
      <div>
          <label>
              価格:<br>
              <input type="text" name="price" value="{{ $item->price }}"><br>
          </label>
      </div>
      <div>
          <label>
              カテゴリー:<br>
              <select name="category_id">
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id === $item->category_id ? "selected" : "" }}>{{ $category->name }}</option>
                  @endforeach
              </select>
          </label>
      </div>
      <br>
      <input type="submit" value="出品">
  </form>
@endsection