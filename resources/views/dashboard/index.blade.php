@extends('layout.navbar')

@section('container')
    @auth
        <h1>Welcome back, {{ auth()->user()->name }}</h1>
    @endauth

    @foreach ($company as $item)
        {{ $item["name"] }}
        
    @endforeach
@endsection