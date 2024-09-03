@extends('admin.layouts.main_master')
@section('admin_title')
    Company Destination
@endsection
@section('admin_content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Company Destination Table</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Site Settings</a></li>
                                <li class="breadcrumb-item active">Company Destination</li>
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

                            <h3 class="card-title">Company Destination</h3>
                            <a href="{{ route('admin.destination.add') }}" class="btn btn-primary">Add Destination</a>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Destination Name</th>
                                        <th>Number of Cities</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>

                                    @foreach($destinations as $destination)
                                        <tr>
                                            <td>{{ $destination->name }}</td>
                                            <td>{{ $destination->number_of_cities }}</td>
                                            <td>
                                                <img src="{{ asset($destination->thumb) }}" width="80px">
                                            </td>
                                            <td>
                                                @if($destination->status == 1)
                                                    <span class="text-success">Active</span>
                                                @else
                                                    <span class="text-danger">In-Active</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.destination.edit',$destination->id) }}" class="btn btn-warning">Edit</a>
                                                @if($destination->status == 1)
                                                    <a href="{{ route('admin.destination.deactivate',$destination->id) }}" class="btn btn-danger">Deactivate</a>
                                                @else
                                                    <a href="{{ route('admin.destination.activate',$destination->id) }}" class="btn btn-success">Activate</a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
@endsection
