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
                        <h4 class="mb-sm-0">Package Itinerary Manage</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Package</a></li>
                                <li class="breadcrumb-item active">Package Itinerary Manage</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('store.package.itinerary', $package->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if($packageItinerary == null)
                            @for($i = 1; $i <= $package->package_duration; $i++)
                                <div class="card">
                                    <div class="card-body">
                                        <h3>Day {{ $i }}</h3>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="tour-title-{{ $i }}">Tour Title</label>
                                                    <input type="text" class="form-control" id="tour-title-{{ $i }}" name="tour_title[]" value="{{ old('tour_title.'.$i-1) }}">
                                                    @error('tour_title.'.$i-1)
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="tour-description-{{ $i }}">Tour Description</label>
                                                    <textarea class="form-control" rows="5" id="tour-description-{{ $i }}" name="tour_description[]">{{ old('tour_description.'.$i-1) }}</textarea>
                                                    @error('tour_description.'.$i-1)
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="tour-image-{{ $i }}">Tour Image</label>
                                                    <input type="file" class="form-control" id="tour-image-{{ $i }}" name="tour_image[]">
                                                    @error('tour_image.'.$i-1)
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        @else
                            @foreach($packageItinerary as $itinerary)
                                <div class="card">
                                    <div class="card-body">
                                        <h3>Day {{ $itinerary->id }}</h3>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="tour-title-{{ $itinerary->id }}">Tour Title</label>
                                                    <input type="text" class="form-control" id="tour-title-{{ $itinerary->id }}" name="tour_title[]" value="{{ $itinerary->tour_title }}">
                                                    @error('tour_title.'.$itinerary->id-1)
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="tour-description-{{ $itinerary->id }}">Tour Description</label>
                                                    <textarea class="form-control" rows="5" id="tour-description-{{ $itinerary->id }}" name="tour_description[]">{{ $itinerary->tour_description }}</textarea>
                                                    @error('tour_description.'.$itinerary->id-1)
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="tour-image-{{ $itinerary->id }}">Tour Image</label>
                                                    <input type="file" class="form-control" id="tour-image-{{ $itinerary->id }}" name="tour_image[]"><br>
                                                    <img src="{{ asset($itinerary->tour_image) }}" width="80px">
                                                    @error('tour_image.'.$itinerary->id-1)
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="row">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>

                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
@endsection

@push('admin_scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function (){
            $('#image').change(function (e){
                var reader = new FileReader();
                reader.onload = function (e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endpush
