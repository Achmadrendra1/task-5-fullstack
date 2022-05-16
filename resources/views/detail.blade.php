@extends('layouts.main')

@section('content')

@foreach ($posts as $u)
<div class="container mb-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="m-2 text-center"> {{$u->title}}</h1>
            <p class="text-center">
                By. {{$u->user->name}} On {{$u->category->name}}


            </p>
            @if ($u->photo == null)
            <img src="https://source.unsplash.com/500x400/?{{$u->category->name}}" class="card-img-top m-2" alt="...">
            @else
            <img src="{{asset('storage/posts/' . $u->photo)}}" class="card-img-top m-2" alt="...">
            @endif

            <p class="mt-2 text-center">
                {!! $u->content !!}

            </p>
        </div>
    </div>
</div>
@endforeach

@endsection