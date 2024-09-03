@extends('admin.layouts.main_master')
@section('admin_title')
    Booked Packages
@endsection
@section('admin_content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Booked Packages</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Package</a></li>
                                <li class="breadcrumb-item active">Booked Packages</li>
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
                                    <th>Booked By</th>
                                    <th>Number of Adults & Child's</th>
                                    <th>Total Price</th>
                                    <th>Advanced Amount</th>
                                    <th>Due Amount</th>
                                    <th>Journey Date</th>
                                    <th>Package Validity</th>
                                    <th>Booking Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                @php
                                    use Carbon\Carbon;
                                    $todayDate = Carbon::now()->format('Y-m-d');
                                @endphp
                                <tbody>
                                @foreach($bookedPackages as $key => $package)
                                    <tr>
                                        <td>{{ $package->package->package_code }}</td>
                                        <td>{{ $package->package->package_name }}</td>
                                        <td>{{ $package->user->name }}</td>
                                        <td>Adults = {{ $package->number_of_adult }} , Child = {{ $package->number_of_child }}</td>
                                        <td>{{ $package->total_amount }}</td>
                                        <td>{{ $package->advanced_amount }}</td>
                                        <td>{{ $package->total_amount - $package->advanced_amount }}</td>
                                        <td>{{ $package->journey_date }}</td>
                                        <td>
                                            @if($package->package->validity >= $todayDate)
                                                {{ \Carbon\Carbon::parse($package->package->validity)->format('d M, Y') }}
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Expired</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if($package->booking_status == 0)
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($package->booking_status == 1)
                                                <span class="badge bg-success">Approved</span>
                                            @else
                                                <span class="badge bg-danger">Canceled</span>
                                            @endif

                                        </td>

                                        <td>
                                            <a href="{{ route('booked.package.details',$package->id) }}" class="btn btn-sm btn-primary">View Details</a>
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
