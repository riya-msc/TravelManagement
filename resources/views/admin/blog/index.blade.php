@extends('admin.layouts.main_master')
@section('admin_title')
    Company Blogs
@endsection
@section('admin_content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Company Blogs Table</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Site Settings</a></li>
                                <li class="breadcrumb-item active">Company Blogs</li>
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

                            <h3 class="card-title">Company Blogs</h3>
                            <a href="{{ route('admin.blog.add') }}" class="btn btn-primary">Add Blogs</a>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Blog Title</th>
                                        <th>Blog Created</th>
                                        <th>Blog Author</th>
                                        <th>Blog Status</th>
                                        <th>Action</th>
                                    </tr>

                                    @foreach($blogs as $blog)
                                        <tr>
                                            <td>{{ $blog->title }}</td>
                                            <td>{{ \Illuminate\Support\Carbon::parse($blog->created_at)->format('Y-m-d')  }}</td>
                                            <td>{{ $blog->author }}</td>
                                            <td>
                                                @if($blog->status == 1)
                                                    <span class="text-success">Active</span>
                                                @else
                                                    <span class="text-danger">In-Active</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.blog.edit',$blog->id) }}" class="btn btn-warning">Edit</a>
                                                @if($blog->status == 1)
                                                    <a href="{{ route('admin.blog.deactivate',$blog->id) }}" class="btn btn-danger">Deactivate</a>
                                                @else
                                                    <a href="{{ route('admin.blog.activate',$blog->id) }}" class="btn btn-success">Activate</a>
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
