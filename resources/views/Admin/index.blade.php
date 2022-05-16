@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
<div class="p" style="font-size: 36pt;">
    Weclome, {{ Auth::user()->name }}

</div>
@stop

@section('content')

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">


@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop