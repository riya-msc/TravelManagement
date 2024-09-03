@extends('admin.layouts.main_master')
@section('admin_title')
    Tour Queries
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
                                <li class="breadcrumb-item active">Tour Queries</li>
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
                                    <th>Sent</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Starting Date</th>
                                    <th>Return Date</th>
                                    <th>Airline Choice</th>
                                    <th>Visiting Country</th>
                                    <th>Visiting Cities</th>
                                    <th>Airline Ticket Category</th>
                                    <th>Number Of People</th>
                                    <th>Accommodation Type</th>
                                    <th>Number Of Rooms</th>
                                    <th>Foods Included</th>
                                    <th>Guide Required</th>
                                    <th>Private Transport</th>
                                    <th>Special Requirement</th>
{{--                                    <th>Action</th>--}}
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($tourQueries as $tourQuery)
                                    <tr>
                                        <td>{{ $tourQuery->created_at }}</td>
                                        <td>{{ $tourQuery->name }}</td>
                                        <td>{{ $tourQuery->email }}</td>
                                        <td>{{ $tourQuery->phone }}</td>
                                        <td>{{ $tourQuery->starting_date }}</td>
                                        <td>{{ $tourQuery->return_date }}</td>
                                        <td>{{ $tourQuery->airline_choice }}</td>
                                        <td>{{ $tourQuery->visiting_country }}</td>
                                        <td>{{ $tourQuery->visiting_cities }}</td>
                                        <td>{{ $tourQuery->airline_ticket_category }}</td>
                                        <td>Adults = {{ $tourQuery->number_of_adults }} , Child = {{ $tourQuery->number_of_children }}</td>
                                        <td>{{ $tourQuery->accommodation_typer }}</td>
                                        <td>{{ $tourQuery->number_of_rooms }}</td>
                                        <td>{{ $tourQuery->foods_included }}</td>
                                        <td>{{ $tourQuery->guide_required }}</td>
                                        <td>{{ $tourQuery->private_transport }}</td>
                                        <td>{{ $tourQuery->special_requirement }}</td>
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

