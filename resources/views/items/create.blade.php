@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
      @csrf
      <h2>商品追加フォーム</h2>
      <div>
          <label>
              商品名：<br>
              <input type="text" name="name"><br>
          </label>
      </div>
      <div>
          <label>
              商品説明：<br>
              <textarea name="description" cols="30" rows="10"></textarea><br>
          </label>
      </div>
      <div>
          <label>
              価格：<br>
              <input type="text" name="price"><br>
          </label>
      </div>
      <div>
          <label>
              カテゴリー：<br>
              <select name="category_id">
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
              </select>
          </label>
      </div>
      <br>
      <div>
        <label>
              画像を選択： 
          <input type="file" name="image">
        </label>
      </div>
      <br>
      <input type="submit" value="出品">
  </form>
@endsection