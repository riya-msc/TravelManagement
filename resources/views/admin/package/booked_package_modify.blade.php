@extends('admin.layouts.main_master')
@section('admin_title')
    Booked Package Modify
@endsection
@section('admin_content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Booked Package Modify</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Package</a></li>
                                <li class="breadcrumb-item active">Booked Package Modify</li>
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
                                    <td><b>Total Amount</b></td>
                                    <td>{{ $packageBooking->total_amount }}</td>
                                </tr>

                                <tr>
                                    <td><b>Amount Paid</b></td>
                                    <td>{{ $packageBooking->paid_amount }}</td>
                                </tr>

                                <tr>
                                    <td><b>Due Amount</b></td>
                                    <td>{{ $packageBooking->due_amount }}</td>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="form" method="POST" action="{{ route('booked.package.update',$packageBooking->id) }}">
                                @csrf
                                <div class="row">
                                    @if($packageBooking->total_amount > $packageBooking->paid_amount)
                                        <div class="col-6">
                                            @if($packageBooking->advanced_amount)
                                                <label>Pay Due Amount</label>
                                            @else
                                                <label>Pay Advance Amount</label>
                                            @endif
                                            <input type="text" class="form-control" name="paid_amount" value="{{ old('paid_amount') }}">
                                            @error('paid_amount')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div><br>
                                    @endif

                                    <div class="col-6">
                                        <label>Due Payment Date</label>
                                        <div class="input-group" id="datepicker1">
                                            <input readonly type="text" class="form-control" placeholder="yyyy-mm-dd" name="due_payment_date"
                                                   data-date-format="yyyy-mm-dd" data-date-container='#datepicker1' data-provide="datepicker" value="{{ $packageBooking->due_payment_date }}">

                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                        @error('due_payment_date')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
{{--                                        <input type="text" class="form-control" name="due_payment_date" >--}}
                                    </div><br>

                                    <div class="col-6 mt-4">
                                        <label>Payment Status</label>
                                        <select class="form-control" name="payment_status">
                                            <option disabled>Select One</option>
                                            <option value="0" {{ $packageBooking->payment_status == 0 ? 'selected' : ' '}}>Unpaid</option>
                                            <option value="1" {{ $packageBooking->payment_status == 1 ? 'selected' : ' '}}>Paid</option>
                                            <option value="2" {{ $packageBooking->payment_status == 2 ? 'selected' : ' '}}>Due Amount Pending</option>
                                        </select>
                                    </div><br>
                                    <div class="col-6 mt-4">
                                        <label>Booking Status</label>
                                        <select class="form-control" name="booking_status">
                                            <option disabled>Select One</option>
                                            <option value="0" {{ $packageBooking->booking_status == 0 ? 'selected' : ' '}}>Pending</option>
                                            <option value="1" {{ $packageBooking->booking_status == 1 ? 'selected' : ' '}}>Approved</option>
                                            <option value="2" {{ $packageBooking->booking_status == 2 ? 'selected' : ' '}}>Canceled</option>
                                        </select>
                                    </div><br>

                                    <div class="col-12 mt-4">
                                        <input type="submit" class="btn btn-primary" value="Modify">
                                    </div><br>

                                </div>
                            </form>
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
