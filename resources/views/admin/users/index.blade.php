@extends('admin.layouts.app')

@section('title', 'Usuários')

@section('content')

@foreach ($users as $user)
    {{ $user->name }} <!-- se fosse retornada um array: $user['name']  -->
@endforeach

@endsection