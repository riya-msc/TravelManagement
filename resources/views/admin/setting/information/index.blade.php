@extends('admin.layouts.main_master')
@section('admin_title')
    Company Information
@endsection
@section('admin_content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Company Information Table</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Site Settings</a></li>
                                <li class="breadcrumb-item active">Company Information</li>
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

                            <h3 class="card-title">Company Details</h3>

                            <div class="float-end text-center">
                                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">Edit Information</button>
                            </div>

                            <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Company Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('information.store') }}" enctype="multipart/form-data">
                                                @csrf
                                                <label class="form-label">Company Name</label>
                                                <input type="text" class="form-control" name="name" value="{{ $information->name }}">

                                                @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <br>

                                                <label class="form-label">Company Contact No</label>
                                                <input type="text" class="form-control" name="contact" value="{{ $information->contact }}">

                                                @error('contact')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <br>

                                                <label class="form-label">Company Email</label>
                                                <input type="text" class="form-control" name="email" value="{{ $information->email }}">

                                                @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <br>

                                                <label class="form-label">Company Address</label>
                                                <input type="text" class="form-control" name="address" value="{{ $information->address }}">

                                                @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <br>

                                                <label class="form-label">Company Logo</label>
                                                <input type="file" class="form-control" name="logo" id="image">

                                                @error('logo')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <br>

                                                <img src="{{ (!empty($information->logo)) ? url($information->logo):
                                                    url('upload/no_img.jpg') }}" style="height: 100px" id="showImage"><br> <br>

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
                                            <b>Company Name</b>
                                        </td>
                                        <td>
                                            {{ $information->name }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b>Company Contact No</b>
                                        </td>
                                        <td>
                                            {{ $information->contact }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b>Company Email</b>
                                        </td>
                                        <td>
                                            {{ $information->email }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b>Company Address</b>
                                        </td>
                                        <td>
                                            {{ $information->address }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b>Company Logo</b>
                                        </td>
                                        <td>
                                            <img src="{{ (!empty($information->logo)) ? url($information->logo):
                                                    url('upload/no_img.jpg') }}" style="height: 100px" >
                                        </td>
                                    </tr>

{{--                                    <tr>--}}
{{--                                        <td>--}}
{{--                                            <b>Company Name</b>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            {{ $information->name }}--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
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
        });
    </script>
@endpush
