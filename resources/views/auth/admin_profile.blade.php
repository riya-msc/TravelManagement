@extends('admin.layouts.main_master')
@section('admin_title')
    Admin Profile
@endsection
@section('admin_content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Admin Profile</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Travel Management</a></li>
                                <li class="breadcrumb-item active">Admin Profile</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="box user-pro-list ">
                        <div class="box-body">
                            <div class="user-pic text-center">
                                <div class="avatar ">
                                    <img src="{{ (!empty($admin->profile_photo_path)) ? url($admin->profile_photo_path):
                                                    url('upload/no_img.jpg') }}" style="height: 100px" >

                                    <div class="pulse-css"></div>
                                </div>
                                <div class="pro-user mt-40">
                                    <h5 class="pro-user-username text-dark mb-1 fs-15" style="color: blue !important">{{ $admin->name }}</h5>
                                    <h6 class="pro-user-desc text-muted fs-14">{{ $admin->email }}</h6>

                                </div>
                            </div>
                        </div>


                        <div class="box-footer pt-38">
                            <div class="btn-list text-center">
                                <a href="{{ route('admin.change_password') }}" class="btn btn-primary ml-4">Change Password </a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
