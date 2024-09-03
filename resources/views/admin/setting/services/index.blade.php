@extends('admin.layouts.main_master')
@section('admin_title')
    Company Services
@endsection
@section('admin_content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Company Services Table</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Site Settings</a></li>
                                <li class="breadcrumb-item active">Company Services</li>
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

                            <h3 class="card-title">Company Services</h3>

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Service Title</th>
                                        <th>Service Icon</th>
                                        <th>Service Text</th>
                                        <th>Action</th>
                                    </tr>

                                    @foreach($services as $service)
                                        <tr>
                                            <td>{{ $service->service_title }}</td>
                                            <td>{{ $service->service_icon }}</td>
                                            <td>{{ $service->service_text }}</td>
                                            <td>
                                                <!-- Trigger button for the modal -->
                                                <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $service->id }}">Edit</a>

                                                <!-- Modal -->
                                                <div class="modal fade" id="editModal{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $service->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editModalLabel{{ $service->id }}">Edit Service Details</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="{{ route('services.update', $service->id) }}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')

                                                                    <label class="form-label">Service Title</label>
                                                                    <input type="text" class="form-control" name="service_title" value="{{ $service->service_title }}">
                                                                    @error('service_title')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                    <br>

                                                                    <!-- Service Icon -->
                                                                    <label class="form-label">Service Icon</label>
                                                                    <input type="text" class="form-control" name="service_icon" value="{{ $service->service_icon }}">
                                                                    @error('service_icon')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                    <br>

                                                                    <!-- Service Text -->
                                                                    <label class="form-label">Service Text</label>
                                                                    <input type="text" class="form-control" name="service_text" value="{{ $service->service_text }}">
                                                                    @error('service_text')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                    <br>

                                                                    <!-- Update Button -->
                                                                    <input type="submit" class="btn btn-primary btn-sm" value="Update">
                                                                </form>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
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
