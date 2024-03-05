@extends('layouts.app')

@section('content')
    <h1>{{ $user->first_name }} {{ $user->last_name }}</h1>
    <p>Email: {{ $user->email }}</p>
    <p>出生日期: {{ $user->birthdate }}</p>
    <h2>地址</h2>
    @if($user->address)
        <p>{{ $user->address->address }}, {{ $user->address->city }}, {{ $user->address->state }}, {{ $user->address->country }}</p>
    @else
        <p>該會員尚未添加地址。</p>
    @endif
    <h2>文件</h2>
    @foreach($user->documents as $document)
        <p>{{ $document->file_path }}</p>
    @endforeach
@endsection
