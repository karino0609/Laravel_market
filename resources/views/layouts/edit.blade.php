@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <form method="get" action="{{ route('profile.edit') }}">
      @csrf
      @method('get')
      <label>名前: <br>
        <input type="text" name="name" value="{{ $user->name }}">
      </label><br>
      <label>プロフィール: <br>
        <textarea name="profile" cols="30" rows="10">{{ $user->profile }}</textarea>
      </label><br>
      <input type="submit" value="更新">
  </form>
@endsection