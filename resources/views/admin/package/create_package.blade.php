@extends('admin.layouts.main_master')
@section('admin_title')
    Package Create
@endsection
@section('admin_content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Package Create</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Package</a></li>
                                <li class="breadcrumb-item active">Package Create</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('store.package') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="basicpill-namecard-input">Package Name</label>
                                            <input type="text" class="form-control" id="basicpill-namecard-input" name="package_name" value="{{ old('package_name') }}">
                                            @error('package_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="basicpill-namecard-input">Package Country</label>
                                            <select class="form-control" name="country">
                                                <option selected disabled>Select Country</option>
                                                @foreach($destinations as $destination)
                                                    <option {{ old('country') == $destination->name ? 'selected' : '' }} value="{{ $destination->name }}">{{ $destination->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('country')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="basicpill-namecard-input">Package City</label>
                                            <input type="text" class="form-control" id="basicpill-namecard-input" name="city" value="{{ old('city') }}">
                                            @error('city')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="basicpill-namecard-input">Package Duration</label>
                                            <input type="number" class="form-control" id="basicpill-namecard-input" name="package_duration" value="{{ old('package_duration') }}">
                                            @error('package_duration')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="basicpill-namecard-input">Package Price</label>
                                            <input type="text" class="form-control" id="basicpill-namecard-input" name="package_price" value="{{ old('package_price') }}">
                                            @error('package_price')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="basicpill-namecard-input">Package Rating</label>
                                            <select class="form-control" name="package_rating">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4" selected>4</option>
                                                <option value="5">5</option>
                                            </select>
{{--                                            <input type="number" class="form-control" id="basicpill-namecard-input" name="" value="{{ old('package_rating') }}">--}}
                                            @error('package_rating')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="basicpill-namecard-input">Person Quantity</label>
                                            <input type="number" class="form-control" id="basicpill-namecard-input" name="package_person" value="{{ old('package_person') }}">
                                            @error('package_person')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Package Validity</label>
                                            <div class="input-group" id="datepicker2">
                                                <input type="text" class="form-control" placeholder="dd M, yyyy"
                                                       data-date-format="dd M, yyyy" data-date-container='#datepicker2' data-provide="datepicker"
                                                       data-date-autoclose="true" name="validity" value="{{ old('validity') }}">

                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                            @error('validity')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="basicpill-namecard-input">Package Inclusion</label>
                                            <textarea class="form-control" rows="5" name="inclusion">{{ old('inclusion') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="basicpill-namecard-input">Package Exclusion</label>
                                            <textarea class="form-control" rows="5" name="exclusion">{{ old('exclusion') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Package Banner</label>
                                            <input type="file" class="form-control" name="package_banner" id="image">

                                            @error('package_banner')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <br>

                                            <img src="{{ (!empty($information->logo)) ? url($information->logo):
                                                    url('upload/no_img.jpg') }}" style="height: 100px" id="showImage"><br> <br>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Package Images</label>
                                            <input type="file"  name="package_images[]" class="form-control" multiple id="multiImg">

                                            @error('package_images')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <br>

                                            <div class="row" id="preview_img"></div>
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="basicpill-namecard-input">Package Terms & Conditions</label>
                                            <textarea id="elm1" name="terms_condition">{{ old('terms_condition') }}</textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
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

    <script type="text/javascript">

        $(document).ready(function(){
            $('#multiImg').on('change', function(){ //on file input change
                if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file){ //loop though each file
                        if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file){ //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                                        .height(80); //create image element
                                    $('#preview_img').append(img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                }else{
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });

    </script>
@endpush
