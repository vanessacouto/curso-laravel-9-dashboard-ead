@extends('admin.layouts.app')

@section('title', 'Usuários')

@section('content')

@foreach ($users as $user)
    {{ $user['name'] }} <!-- se fosse retornada uma collection: $user->name-->
@endforeach

@endsection