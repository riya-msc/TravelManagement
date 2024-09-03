@extends('admin.layouts.main_master')
@section('admin_title')
    Admin Password Change
@endsection
@section('admin_content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Admin Password Change</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Travel Management</a></li>
                                <li class="breadcrumb-item active">Admin Password Change</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><h3 class="panel-title">Admin Change Password Form</h3></div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" action="{{ route('admin.password.update') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="col-md-12 control-label">New Password</label>
                                    <div class="col-md-4">
                                        <input type="password" class="form-control" name="password" >
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="mt-4">
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                    </div>
                                </div>

                            </form>
                        </div> <!-- panel-body -->
                    </div> <!-- panel -->
                </div> <!-- col -->
            </div>

        </div>

    </div>
@endsection
