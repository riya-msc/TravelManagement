@extends('admin.layouts.main_master')
@section('admin_title')
    Create Blog
@endsection
@section('admin_content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Create Blog</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Site Settings</a></li>
                                <li class="breadcrumb-item active">Create Blog</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Add Blog</h3>
                            <form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label">Blog Title</label>
                                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                                        @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <br>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Blog Author</label>
                                        <input type="text" class="form-control" name="author" value="{{ old('author') }}">
                                        @error('author')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <br>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Author Details</label>
                                        <input type="text" class="form-control" name="author_details" value="{{ old('author_details') }}">
                                        @error('author_details')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <br>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Blog Details</label>
                                        <textarea id="elm1" name="description">{{ old('description') }}</textarea>
                                        @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <br>
                                    </div>


                                    <div class="col-6">
                                        <label class="form-label">Blog Image</label>
                                        <input type="file" class="form-control" name="image" id="image">
                                        @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <br>
                                    </div>

                                    <div class="col-6">
                                        <img src="{{ asset('upload/no_img.jpg') }}" style="height: 100px" id="showImage">
                                    </div>
                                </div>

                                <!-- Update Button -->
                                <input type="submit" class="btn btn-primary btn-sm" value="Create">
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
@endsection

@push('admin_scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function (){
            $('#image').change(function (e){
                var reader = new FileReader();
                reader.onload = function (e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endpush
