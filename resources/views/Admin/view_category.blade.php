@extends('adminlte::page')
@section('title', 'List Category')

@section('content_header')
<h6>Category List</h6>
@stop

@section('content')
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
                        <th class="text-center">Name</th>
                        <th class="text-center">Author</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($category as $cat)
                    <tr>
                        <td class="text-center">{{$cat->id}}</td>
                        <td>{{$cat->name}}</td>
                        <td>{{$cat->user->name}}</td>
                        <td>
                            <center>
                                <a href="{{url('admin/category/edit/' . $cat->id)}}" id="btn-edit">
                                    <button type="button" id="btn-edit" class="btn btn-primary btn-sm mb-2 py-1 px-2">
                                        Edit
                                    </button>
                                </a>
                                <a href="{{url('admin/category/destroy/' . $cat->id)}}" onclick="return confirm('Are you sure to delete?')">
                                    <button type="button" class="btn btn-danger btn-sm mb-2 py-1 px-2">Delete</button>
                                </a>
                            </center>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
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