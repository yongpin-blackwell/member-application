@extends('layouts.app')

@section('content')
    <h1>編輯會員</h1>
    <form action="{{ route('users.update', $user->id) }}" method="post">
        @csrf
        @method('PUT')
        <label for="first_name">名字:</label>
        <input type="text" name="first_name" value="{{ $user->first_name }}">
        <label for="last_name">姓氏:</label>
        <input type="text" name="last_name" value="{{ $user->last_name }}">
        <!-- 其他欄位 -->
        <button type="submit">保存</button>
    </form>
@endsection
