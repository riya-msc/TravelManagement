@extends('admin.layouts.main_master')
@section('admin_title')
    Booked Package Details
@endsection
@section('admin_content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Booked Package Details</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Package</a></li>
                                <li class="breadcrumb-item active">Booked Package Details</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Package Code: {{ $packageBooking->package->package_code }}</h4>
                            <h4>Package Name: {{ $packageBooking->package->package_name }}</h4>
                            <a class="float-end btn btn-primary" href="{{ route('modify.booked.package',$packageBooking->id) }}">Modify</a>
                        </div>
                        <div class="card-body">

                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <tr>
                                    <td><b>Booked By</b></td>
                                    <td>{{ $packageBooking->user->name }}</td>
                                </tr>

                                <tr>
                                    <td><b>Traveller Email</b></td>
                                    <td>{{ $packageBooking->traveller_email }}</td>
                                </tr>

                                <tr>
                                    <td><b>Traveller Phone</b></td>
                                    <td>{{ $packageBooking->traveller_phone }}</td>
                                </tr>

                                <tr>
                                    <td><b>Number Of Adult</b></td>
                                    <td>{{ $packageBooking->number_of_adult }}</td>
                                </tr>

                                <tr>
                                    <td><b>Number Of Child</b></td>
                                    <td>{{ $packageBooking->number_of_child }}</td>
                                </tr>

                                <tr>
                                    <td><b>Journey Date</b></td>
                                    <td>{{ $packageBooking->journey_date }}</td>
                                </tr>

                                <tr>
                                    <td><b>Other Requirements</b></td>
                                    <td>{{ $packageBooking->other_requirements }}</td>
                                </tr>

                                <tr>
                                    <td><b>Booking Status</b></td>
                                    <td>
                                        @if($packageBooking->booking_status == 0)
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($packageBooking->booking_status == 1)
                                            <span class="badge bg-success">Approved</span>
                                        @else
                                            <span class="badge bg-danger">Canceled</span>
                                        @endif

                                    </td>
                                </tr>

                                <tr>
                                    <td><b>Total Amount</b></td>
                                    <td>{{ $packageBooking->total_amount }}</td>
                                </tr>

                                <tr>
                                    <td><b>Paid Amount</b></td>
                                    <td>{{ $packageBooking->advanced_amount ?? 0 }}</td>
                                </tr>

                                <tr>
                                    <td><b>Due Amount</b></td>
                                    <td>{{ $packageBooking->due_amount }}</td>
                                </tr>

                                <tr>
                                    <td><b>Due Payment Date</b></td>
                                    <td>{{ $packageBooking->due_payment_date }}</td>
                                </tr>

                                <tr>
                                    <td><b>Payment Status</b></td>
                                    <td>
                                        @if($packageBooking->payment_status == 1)
                                            <span class="badge bg-success">Paid</span>
                                        @elseif($packageBooking->payment_status == 2)
                                            <span class="badge bg-warning">Due Amount Pending</span>
                                        @else
                                            <span class="badge bg-danger">Unpaid</span>
                                        @endif

                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Traveller Details:</h4>
                        </div>
                        <div class="card-body">
                            @foreach($packageBooking->adult_infos as $key => $adults)
                                <h5>Adult Information {{ $key+1 }}</h5>
                                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <tr>
                                        <td><b>Title</b></td>
                                        <td>{{ $adults->title }}</td>
                                    </tr>

                                    <tr>
                                        <td><b>Name</b></td>
                                        <td>{{ $adults->name }}</td>
                                    </tr>

                                    <tr>
                                        <td><b>Passport Number</b></td>
                                        <td>{{ $adults->passportNumber }}</td>
                                    </tr>

                                    <tr>
                                        <td><b>Passport Copy</b></td>
                                        <td><img src="{{ asset($adults->passportCopy) }}" width="100px" style="object-fit: cover"></td>
                                    </tr>
                                </table>
                            @endforeach


                            @if($packageBooking->child_infos)
                                @foreach($packageBooking->child_infos as $key => $childs)
                                    <h5>Child Information {{ $key+1 }}</h5>
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <tr>
                                            <td><b>Title</b></td>
                                            <td>{{ $childs->title }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Name</b></td>
                                            <td>{{ $childs->name }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Passport Number</b></td>
                                            <td>{{ $childs->passportNumber }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Passport Copy</b></td>
                                            <td><img src="{{ asset($childs->passportCopy) }}" width="100px" style="object-fit: cover"></td>
                                        </tr>
                                    </table>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div> <!-- container-fluid -->
    </div>
@endsection

@push('admin_scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endpush
