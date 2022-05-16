@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <div class="h1 text-center mb-4">
        Welcome To Simple Blog
    </div>
    <div class="row justify-content-end">
        <div class="col-md-4">
            <form action="/">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search" name="search" value="{{ request('search') }}">
                    <button class="btn btn-info" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>

    @if ($posts->isNotEmpty())
    <div class="m-4">
        <div class="card mb-3 text-center">
            <img src="https://source.unsplash.com/800x400/?{{ $posts[0]->category->name }}" class="card-img-top" alt="..." height="400">
            <div class="card-body">
                <h3 class="card-title">{{ $posts[0]->title }}</h3>
                <small class="text-muted">
                    By {{ $posts[0]->user->name }} {{\Carbon\Carbon::parse($posts[0]->created_at)->diffForHumans()}}

                </small>
                <p class="card-text">{{ $posts[0]->excerpt }}</p>
                <a href="article/{{ $posts[0]->slug }}" class="btn btn-primary text-decoration-none">Read More</a>

            </div>
        </div>
    </div>


    <div class="m-4">
        <div class="row justify-content-center">
            @foreach ($posts->skip(1) as $u)
            <div class="col-md-4">
                <div class="card-sl mb-3">
                    <img src="https://source.unsplash.com/500x400/?{{ $u->category->name }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $u->title }}</h5>
                        <small class="text-muted">
                            By {{ $u->user->name}}{{\Carbon\Carbon::parse($u->created_at)->diffForHumans()}}

                        </small>
                        <p class="card-text text-break">{{ $u->excerpt}}</p>
                        <a href="article/{{ $u->slug}}" class="btn btn-primary text-decoration-none">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    <div class="d-flex justify-content-center">
        {{ $posts->links()}}

    </div>

    @else
    <div class="text-center">
        <h2>Sorry, No posts found</h2>
    </div>
    @endif
</div>
@endsection