@extends('layouts.app')

@section('content')
    <h1>會員註冊</h1>
    <form action="{{ route('users.store') }}" method="post">
        @csrf
        <label for="first_name">名字:</label>
        <input type="text" name="first_name">
        <label for="last_name">姓氏:</label>
        <input type="text" name="last_name">
        <!-- 其他個人詳細信息欄位 -->
        <h2>地址</h2>
        <label for="address">地址:</label>
        <input type="text" name="address">
        <!-- 其他地址相關欄位 -->
        <h2>文件上傳</h2>
        <input type="file" name="document">
        <button type="submit">註冊</button>
    </form>
@endsection
