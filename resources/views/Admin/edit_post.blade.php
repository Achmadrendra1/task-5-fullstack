@extends('adminlte::page')
@section('title', 'Edit Post')

@section('content_header')
<h6>Edit Post</h6>
@stop

@section('content')
<div class="m-4">

    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        <?php echo e(session('success')); ?>

    </div>
    @endif

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors as $error)

            <li>{{ $error }}</li>
            @endforeach;

        </ul>
    </div>
    @endif
    <!-- Card -->
    <div class="card">
        <div class="card-body">

            <form action="/admin/posts/update/{{ $posts->id }} " method="post" enctype="multipart/form-data">
                @csrf

                <div class="row justify-content-start">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="edited_title" value="<?php echo e($posts->title); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" name="edited_slug" id="slug" disabled value="<?php echo e($posts->slug); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Content</label>
                            <input id="edited_content" class="form-control" type="hidden" name="edited_content" value="<?php echo e($posts->content); ?>">
                            <trix-editor input="edited_content"></trix-editor>
                        </div>

                        <div class="mb-3">
                            <label for="floatingSelect" class="form-label">Category</label>
                            <select class="form-control" id="category" name="category">
                                <option value="{{ $posts->category_id }}"> <?php echo e($posts->category->name); ?>

                                    @foreach( $category as $cat )

                                <option value={{ $cat->id }}>{{ $cat->name }} </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Upload Photo</label>
                            <input class="form-control" type="file" id="image" name="image" onchange="loadFile(event)">
                            </br>
                            <div class="text-center">
                                <img id="output" width="200px" />
                            </div>
                        </div>

                        <div class="text-center mb-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>


            </form>
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

        title.addEventListener('change', function() {
            fetch('/admin/posts/add-posts/checkSlug?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
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