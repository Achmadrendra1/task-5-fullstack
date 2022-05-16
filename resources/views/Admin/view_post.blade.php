@extends('adminlte::page')
@section('title', 'My Post')

@section('content_header')
<h6>My Post</h6>
@stop

@Section('content')
<div class="m-4">

    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <!-- Card -->
    <div class="card">
        <div class="card-body">

            <!-- Table -->
            <table class="table" class="display nowrap" style="width:100%" id="table">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Title</th>
                        <th class="text-center">Excerpt</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($posts as $post)
                    <tr>
                        <td class="text-center">{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->excerpt}}</td>
                        <td>{{$post->category->name}}</td>
                        <!-- <td>{{$post->is_admin}}</td> -->
                        @if ($post->image == null)
                        <td class="text-center">null</td>
                        @else
                        <td class="text-center">{{$post->image}}</td>
                        @endif
                        <td>
                            <center>
                                <a href="{{url('admin/posts/edit/' . $post->id)}}" id="btn-edit">
                                    <button type="button" id="btn-edit" class="btn btn-primary btn-sm mb-2 py-1 px-2">
                                        Edit
                                    </button>
                                </a>
                                <a href="{{url('admin/posts/destroy/' . $post->id)}}" onclick="return confirm('Are you sure to delete?')">
                                    <button type="button" class="btn btn-danger btn-sm mb-2 py-1 px-2">Delete</button>
                                </a>
                            </center>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop


@push('js')
<script>
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 4000);
    });
</script>
@endpush


@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">

@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop