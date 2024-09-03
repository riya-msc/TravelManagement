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
                        <h4 class="mb-sm-0">Package Itinerary</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Package</a></li>
                                <li class="breadcrumb-item active">Package Itinerary</li>
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
                            @if($package->package_itinerary == null)
                                <h4>Itinerary Not Set Yet</h4>
                            @else
                                <h4>Itinerary Details</h4>
                                @foreach($packageItinerary as $itinerary)
                                    <div class="card">
                                        <div class="card-body">
                                            <h5>Day {{ $itinerary->id }}</h5><br>
                                            <h5>Tour Title : {{ $itinerary->tour_title }}</h5><br>
                                            <h5>Tour Description:</h5>
                                            <p>{{ $itinerary->tour_description }}</p><br><br>
                                            <h5>Tour Image:</h5>
                                            <img src="{{ asset($itinerary->tour_image) }}" width="100px" style="object-fit: cover">
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                                <div class="float-end">
                                    <a href="{{ route('manage.itinerary',$package->id) }}" class="btn btn-primary">Manage Itinerary</a>
                                </div>
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
