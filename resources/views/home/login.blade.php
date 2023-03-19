@extends('home.layout')

@section('head_meta')
    <title>Connexion</title>
@endsection

@section('content')
    <home csrf_token="{{ csrf_token() }}" :errors='@json(session('errors', []))'></home>
@endsection
