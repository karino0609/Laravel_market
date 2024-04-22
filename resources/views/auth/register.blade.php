@extends('layouts.not_logged_in')

@section('content')
 <h1>ユーザー登録</h1>
 
 <form method="POST" action="{{ route('register') }}">
     @csrf
     <div>
         <label>
             ユーザー名:　<br>
             <input type="text" name="name">
         </label>
     </div>
     <br>
     <div>
         <label>
             メールアドレス:　<br>
             <input type="email" name="email">
         </label>
     </div>
     <br>
     <div>
         <label>
             パスワード:　<br>
             <input type="password" name="password">
         </label>
     </div>
     <br>
     <div>
         <label>
             パスワード（確認用）:　<br>
             <input type="password" name="password_confirmation">
         </label>
     </div>
     <br>
     <div>
         <input type="submit" value="登録">
     </div>
 </form>
@endsection