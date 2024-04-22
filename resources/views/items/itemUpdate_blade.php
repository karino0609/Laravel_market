@extends('layouts.update')

@section('title', $title)

@section('content')
 <h1>{{ $title }}</h1>
 
 <form method="POST" action="items/{item}/edit">
     @csrf
     <div>
         <label>
             商品名:　<br>
             <input type="text" name="item_name">
         </label>
     </div>
     <br>
     <div>
         <label>
             商品説明:　<br>
             <textarea="explanation" name="explanation"></textarea>
         </label>
     </div>
     <br>
     <div>
         <label>
             価格:　<br>
             <input type="price" name="price">
         </label>
     </div>
     <br>
     <div>
         <label>
             カテゴリー:　<br>
             <input type="category" name="category">
         </label>
     </div>
     <br>
     <div>
         <input type="submit" value="出品">
     </div>
 </form>
@endsection
@endsection