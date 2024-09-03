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
                        <h4 class="mb-sm-0">Package List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Package</a></li>
                                <li class="breadcrumb-item active">Package List</li>
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

                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Package Code</th>
                                    <th>Package Name</th>
                                    <th>City & Country</th>
                                    <th>Duration</th>
                                    <th>Package Price</th>
                                    <th>Package Person</th>
                                    <th>Package Rating</th>
                                    <th>Package Validity</th>
                                    <th>Package Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                @php
                                    use Carbon\Carbon;
                                    $todayDate = Carbon::now()->format('Y-m-d');
                                @endphp
                                <tbody>
                                @foreach($packages as $key => $package)
                                    <tr>
                                        <td>{{ $package->package_code }}</td>
                                        <td>{{ $package->package_name }}</td>
                                        <td>{{ $package->city }}, {{ $package->country }}</td>
                                        <td>{{ $package->package_duration }}</td>
                                        <td>{{ $package->package_price }}</td>
                                        <td>{{ $package->package_person }}</td>
                                        <td>{{ $package->package_rating }}</td>
                                        <td>
                                            @if($package->validity >= $todayDate)
                                                {{ \Carbon\Carbon::parse($package->validity)->format('d M, Y') }}
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Expired</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($package->status == 1)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">In-Active</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('itinerary.package',$package->id) }}" class="btn btn-sm btn-primary">View Itinerary</a>
                                            <a href="{{ route('edit.package',$package->id) }}" class="btn btn-sm btn-warning">Edit Package</a>
                                            <a href="{{ route('manage.visa.package',$package->id) }}" class="btn btn-sm btn-dark">Visa Requirements</a>
                                            @if($package->status == 1)
                                                <a href="{{ route('deactivate.package',$package->id) }}" class="btn btn-sm btn-danger">Deactivate Package</a>
                                            @else
                                                @if($package->validity >= $todayDate)
                                                    <a href="{{ route('activate.package',$package->id) }}" class="btn btn-sm btn-success">Activate Package</a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
@endsection

@push('admin_scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endpush
