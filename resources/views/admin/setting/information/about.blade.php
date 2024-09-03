@extends('admin.layouts.main_master')
@section('admin_title')
    Company About
@endsection
@section('admin_content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Company About Table</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Site Settings</a></li>
                                <li class="breadcrumb-item active">Company About</li>
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

                            <h3 class="card-title">Company About</h3>

                            <div class="float-end text-center">
                                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">Edit About</button>
                            </div>

                            <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit About Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('admin.about.update') }}" enctype="multipart/form-data">
                                                @csrf
                                                <label class="form-label">Title</label>
                                                <input type="text" class="form-control" name="title" value="{{ $about->title }}">

                                                @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <br>

                                                <label class="form-label">Body Content</label>
                                                <input type="text" class="form-control" name="body" value="{{ $about->body }}">

                                                @error('body')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <br>


                                                <label class="form-label">Main Image</label>
                                                <input type="file" class="form-control" name="main_image" id="image">

                                                @error('main_image')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <br>

                                                <img src="{{ (!empty($about->main_image)) ? url($about->main_image):
                                                    url('upload/no_img.jpg') }}" style="height: 100px" id="showImage"><br> <br>


                                                <label class="form-label">Image 2</label>
                                                <input type="file" class="form-control" name="image1" id="image1">

                                                @error('image1')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <br>

                                                <img src="{{ (!empty($about->image1)) ? url($about->image1):
                                                    url('upload/no_img.jpg') }}" style="height: 100px" id="showImage1"><br> <br>

                                                <label class="form-label">Image 3</label>
                                                <input type="file" class="form-control" name="image2" id="image2">

                                                @error('image2')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <br>

                                                <img src="{{ (!empty($about->image2)) ? url($about->image2):
                                                    url('upload/no_img.jpg') }}" style="height: 100px" id="showImage2"><br> <br>

                                                <input type="submit" class="btn btn-primary btn-sm" value="Update">
                                            </form>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->


                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <b>Title</b>
                                        </td>
                                        <td>
                                            {{ $about->title }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b>Body Content</b>
                                        </td>
                                        <td>
                                            {{ $about->body }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b>Main Image</b>
                                        </td>
                                        <td>
                                            <img src="{{ (!empty($about->main_image)) ? url($about->main_image):
                                                    url('upload/no_img.jpg') }}" style="height: 100px"><br> <br>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b>Image 1</b>
                                        </td>
                                        <td>
                                            <img src="{{ (!empty($about->image1)) ? url($about->image1):
                                                    url('upload/no_img.jpg') }}" style="height: 100px"><br> <br>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b>Image 2</b>
                                        </td>
                                        <td>
                                            <img src="{{ (!empty($about->image2)) ? url($about->image2):
                                                    url('upload/no_img.jpg') }}" style="height: 100px"><br> <br>
                                        </td>
                                    </tr>
                                </table>
                            </div>
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

            $('#image1').change(function (e){
                var reader = new FileReader();
                reader.onload = function (e){
                    $('#showImage1').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });

            $('#image2').change(function (e){
                var reader = new FileReader();
                reader.onload = function (e){
                    $('#showImage2').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endpush
