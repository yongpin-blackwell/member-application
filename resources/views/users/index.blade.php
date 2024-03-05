@extends('layouts.app')

@section('content')
    <h1>會員列表</h1>
    <ul>
        @foreach($users as $user)
            <li>{{ $user->first_name }} {{ $user->last_name }}</li>
        @endforeach
        <a href="{{ route('users.export') }}">導出會員列表</a>
    </ul>
@endsection