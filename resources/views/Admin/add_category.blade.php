@extends('adminlte::page')
@section('title', 'Add New Category')

@section('content_header')
<h6>Add New Category</h6>
@stop

@section('content')
<div class="m-4">

    @if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}

    </div>
    @endif

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors as $error)

            <li>{{ $error }}</li>
            @endforeach

        </ul>
    </div>
    @endif
    <!-- Card -->
    <div class="card">
        <div class="card-body">
            <form action="addcategory" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-start">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        </div>

                        <div class="text-center mb-4">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                        </div>
                    </div>
                </div>


            </form>
        </div>
    </div>

    @stop


    @push('js')
    <script>
        title.addEventListener('change', function() {
            fetch('/admin/add-posts/checkSlug?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });

        $(document).ready(function() {
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 4000);
        });

        var loadFile = function(event) {
            var output = document.getElementById('output');
            var old = document.getElementById('old_images');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
                old.parentNode.removeChild(old);
            }
        };
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