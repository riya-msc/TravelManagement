<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    siteInfo: {
        type: Object,
        required: true
    }
});

const { siteInfo } = props;

</script>

<template>
    <div>
        <!-- Topbar Start -->
        <div class="container-fluid bg-light pt-3 d-none d-lg-block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                        <div class="d-inline-flex align-items-center">
                            <p><i class="fa fa-envelope mr-2"></i>info@example.com</p>
                            <p class="text-body px-3">|</p>
                            <p><i class="fa fa-phone-alt mr-2"></i>+012 345 6789</p>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center text-lg-right">
                        <div class="d-inline-flex align-items-center">
                            <a class="text-primary px-3" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-primary px-3" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-primary px-3" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-primary px-3" href="">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a class="text-primary pl-3" href="">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar End -->


        <!-- Navbar Start -->
        <div class="container-fluid position-relative nav-bar p-0">
            <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
                <nav class="navbar navbar-expand-lg bg-light navbar-light shadow-lg py-3 py-lg-0 pl-3 pl-lg-5">
                    <Link :href="route('index')" class="navbar-brand">
                        <img class="head-logo" :src="$page.props.siteInformation?.logo">
                    </Link>

                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                        <div class="navbar-nav ml-auto py-0">
                            <Link :href="route('about')" class="nav-item nav-link">About</Link>
                            <Link :href="route('blogs')" class="nav-item nav-link">Blogs</Link>
                            <Link :href="route('package')" class="nav-item nav-link">Tour Packages</Link>


<!--                            <div class="nav-item dropdown">-->
<!--                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>-->
<!--                                <div class="dropdown-menu border-0 rounded-0 m-0">-->
<!--                                    <Link :href="route('about')" class="dropdown-item">Blog Grid</Link>-->
<!--                                    <Link :href="route('about')" class="dropdown-item">Blog Detail</Link>-->
<!--                                    <Link :href="route('about')" class="dropdown-item">Destination</Link>-->
<!--                                    <Link :href="route('about')" class="dropdown-item">Travel Guides</Link>-->
<!--                                    <Link :href="route('about')" class="dropdown-item">Testimonial</Link>-->
<!--                                </div>-->
<!--                            </div>-->
                            <Link :href="route('contact')" class="nav-item nav-link">Contact</Link>

                            <Link v-if="$page.props.auth.user"
                                  :href="route('dashboard')" class="nav-item nav-link">Profile</Link>

                            <template v-else>
                                <Link
                                    :href="route('login')"
                                    class="nav-item nav-link"
                                >
                                    Log in
                                </Link>

                                <Link
                                    :href="route('register')"
                                    class="nav-item nav-link"
                                >
                                    Register
                                </Link>
                            </template>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->

        <main>
            <slot></slot>
        </main>

        <footer>
            <!-- Footer Start -->
            <div class="container-fluid bg-dark text-white-50 py-5 px-sm-3 px-lg-5" style="margin-top: 90px;">
                <div class="row pt-5">
                    <div class="col-lg-3 col-md-6 mb-5">
                        <a href="" class="navbar-brand footer-logo">
                            <img :src="$page.props.siteInformation?.logo">
                        </a>
                        <p>Sed ipsum clita tempor ipsum ipsum amet sit ipsum lorem amet labore rebum lorem ipsum dolor. No sed vero lorem dolor dolor</p>
                        <h6 class="text-white text-uppercase mt-4 mb-3" style="letter-spacing: 5px;">Follow Us</h6>
                        <div class="d-flex justify-content-start">
                            <a class="btn btn-outline-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-primary btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-outline-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-5">
                        <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Our Services</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>About</a>
                            <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Destination</a>
                            <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Services</a>
                            <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Packages</a>
                            <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Guides</a>
                            <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Testimonial</a>
                            <a class="text-white-50" href="#"><i class="fa fa-angle-right mr-2"></i>Blog</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-5">
                        <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Usefull Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>About</a>
                            <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Destination</a>
                            <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Services</a>
                            <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Packages</a>
                            <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Guides</a>
                            <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Testimonial</a>
                            <a class="text-white-50" href="#"><i class="fa fa-angle-right mr-2"></i>Blog</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-5">
                        <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Contact Us</h5>
                        <p><i class="fa fa-map-marker-alt mr-2"></i>{{ $page.props.siteInformation?.address }}</p>
                        <p><i class="fa fa-phone-alt mr-2"></i>{{ $page.props.siteInformation?.contact }}</p>
                        <p><i class="fa fa-envelope mr-2"></i>{{ $page.props.siteInformation?.email }}</p>
                        <h6 class="text-white text-uppercase mt-4 mb-3" style="letter-spacing: 5px;">Newsletter</h6>
                        <div class="w-100">
                            <div class="input-group">
                                <input type="text" class="form-control border-light" style="padding: 25px;" placeholder="Your Email">
                                <div class="input-group-append">
                                    <button class="btn btn-primary px-3">Sign Up</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
                <div class="row">
                    <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
                        <p class="m-0 text-white-50">Copyright &copy; <a href="#">Domain</a>. All Rights Reserved.
                        </p>
                    </div>
                    <div class="col-lg-6 text-center text-md-right">
                        <p class="m-0 text-white-50">Designed by <a href="https://htmlcodex.com">HTML Codex</a>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </footer>
    </div>
</template>
