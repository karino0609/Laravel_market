@extends('layouts.not_logged_in')

@section('content')
 <h1>ログイン</h1>
 
 <form method="POST" action="{{ route('login') }}">
     @csrf
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
     <input type="submit" value="ログイン">
 </form>
@endsection