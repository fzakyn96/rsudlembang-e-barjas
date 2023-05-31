@extends('layouts.app-barjas')
@section('title', 'Dashboard')
@section('content-barjas')
<h1>Selamat Datang {{ Auth::user()->name }}</h1>
@endsection