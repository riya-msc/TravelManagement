@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp

<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{ asset('assets/backend/assets/images/users/avatar-1.jpg') }}" alt="" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ auth()->guard('admin')->user()->name }}</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> Online</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect {{ ($route == 'admin.dashboard') ? 'mm-active':'' }}">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.contacts') }}" class=" waves-effect {{ ($route == 'admin.contacts') ? 'mm-active':'' }}">
                        <i class="ri-account-circle-line"></i>
                        <span>Contacts</span>
                    </a>
                </li>

                <li class="{{ ($prefix == '/settings')? 'mm-active':'' }}">
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-settings-2-line align-middle me-1"></i>
                        <span>Site Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="{{ ($route == 'information')? 'mm-active':'' }}">
                            <a class="{{ ($route == 'information') ? 'mm-active':'' }}" href="{{ route('information') }}">Company Information</a>
                        </li>
                        <li class="{{ ($route == 'admin.services')? 'mm-active':'' }}">
                            <a class="{{ ($route == 'admin.services') ? 'mm-active':'' }}" href="{{ route('admin.services') }}">Services</a>
                        </li>
                        <li class="{{ ($route == 'admin.about')? 'mm-active':'' }}">
                            <a class="{{ ($route == 'admin.about') ? 'mm-active':'' }}" href="{{ route('admin.about') }}">About Section</a>
                        </li>
                        <li class="{{ ($route == 'admin.blogs')? 'mm-active':'' }}">
                            <a class="{{ ($route == 'admin.blogs') ? 'mm-active':'' }}" href="{{ route('admin.blogs') }}">Blogs</a>
                        </li>
                        <li class="{{ ($route == 'admin.destinations')? 'mm-active':'' }}">
                            <a class="{{ ($route == 'admin.destinations') ? 'mm-active':'' }}" href="{{ route('admin.destinations') }}">Destinations</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ ($prefix == 'admin/package')? 'mm-active':'' }}">
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-settings-2-line align-middle me-1"></i>
                        <span>Packages</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="{{ ($route == 'create.package')? 'mm-active':'' }}">
                            <a class="{{ ($route == 'create.package') ? 'mm-active':'' }}" href="{{ route('create.package') }}">Create Package</a>
                        </li>

                        <li class="{{ ($route == 'list.package')? 'mm-active':'' }}">
                            <a class="{{ ($route == 'list.package') ? 'mm-active':'' }}" href="{{ route('list.package') }}">Packages List</a>
                        </li>

                        <li class="{{ ($route == 'booked.package')? 'mm-active':'' }}">
                            <a class="{{ ($route == 'booked.package') ? 'mm-active':'' }}" href="{{ route('booked.package') }}">Booked Packages</a>
                        </li>

                        <li class="{{ ($route == 'tour.queries')? 'mm-active':'' }}">
                            <a class="{{ ($route == 'tour.queries') ? 'mm-active':'' }}" href="{{ route('tour.queries') }}">Tour Queries</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
