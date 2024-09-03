<script setup>
import Layouts from "@/Layouts/Layouts.vue";
import {Head, Link} from "@inertiajs/vue3";
import BookingFrom from "@/Components/Frontend/BookingFrom.vue";

const props = defineProps({
    packages : Object,
    blogs : Object,
    destinations : Object,
});

</script>
<!-- Home.vue -->
<template>
    <Layouts >

        <Head title="Welcome" />
        <!-- Carousel Start -->
        <div class="container-fluid p-0">
            <div id="header-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="w-100" src="/assets/frontend/img/carousel-1.jpg" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 900px;">
                                <h4 class="text-white text-uppercase mb-md-3">Tours & Travel</h4>
                                <h1 class="display-3 text-white mb-md-4">Let's Discover The World Together</h1>
                                <a href="" class="btn btn-primary py-md-3 px-md-5 mt-2">Book Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="w-100" src="/assets/frontend/img/carousel-2.jpg" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 900px;">
                                <h4 class="text-white text-uppercase mb-md-3">Tours & Travel</h4>
                                <h1 class="display-3 text-white mb-md-4">Discover Amazing Places With Us</h1>
                                <a href="" class="btn btn-primary py-md-3 px-md-5 mt-2">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-prev-icon mb-n2"></span>
                    </div>
                </a>
                <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-next-icon mb-n2"></span>
                    </div>
                </a>
            </div>
        </div>
        <!-- Carousel End -->


        <!-- Booking Start -->
        <BookingFrom/>
        <!-- Booking End -->


        <!-- About Start -->
        <div class="container-fluid py-5">
            <div class="container pt-5">
                <div class="row">
                    <div class="col-lg-6" style="min-height: 500px;">
                        <div class="position-relative h-100">
                            <img class="position-absolute w-100 h-100" :src="$page.props.about?.main_image" style="object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-lg-6 pt-5 pb-lg-5">
                        <div class="about-text bg-white p-4 p-lg-5 my-lg-5">
                            <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">About Us</h6>
                            <h1 class="mb-3">{{ $page.props.about?.title }}</h1>
                            <p>{{ $page.props.about?.body }}</p>
                            <div class="row mb-4">
                                <div class="col-6">
                                    <img class="img-fluid" :src="$page.props.about?.image1" alt="">
                                </div>
                                <div class="col-6">
                                    <img class="img-fluid" :src="$page.props.about?.image2" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Feature Start -->
        <div class="container-fluid pb-5">
            <div class="container pb-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="d-flex mb-4 mb-lg-0">
                            <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                                <i class="fa fa-2x fa-money-check-alt text-white"></i>
                            </div>
                            <div class="d-flex flex-column">
                                <h5 class="">Competitive Pricing</h5>
                                <p class="m-0">Magna sit magna dolor duo dolor labore rebum amet elitr est diam sea</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex mb-4 mb-lg-0">
                            <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                                <i class="fa fa-2x fa-award text-white"></i>
                            </div>
                            <div class="d-flex flex-column">
                                <h5 class="">Best Services</h5>
                                <p class="m-0">Magna sit magna dolor duo dolor labore rebum amet elitr est diam sea</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex mb-4 mb-lg-0">
                            <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                                <i class="fa fa-2x fa-globe text-white"></i>
                            </div>
                            <div class="d-flex flex-column">
                                <h5 class="">Worldwide Coverage</h5>
                                <p class="m-0">Magna sit magna dolor duo dolor labore rebum amet elitr est diam sea</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Feature End -->


        <!-- Destination Start -->
        <div class="container-fluid py-5">
            <div class="container pt-5 pb-3">
                <div class="text-center mb-3 pb-3">
                    <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Destination</h6>
                    <h1>Explore Top Destination</h1>
                </div>
                <div class="row">
                    <template v-for="destination in destinations">
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="destination-item position-relative overflow-hidden mb-2">
                                <img class="img-fluid" :src="destination.thumb" alt="">
                                <a class="destination-overlay text-white text-decoration-none">
                                    <h5 class="text-white">{{ destination.name }}</h5>
                                    <span>{{ destination.number_of_cities }}</span>
                                </a>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
        <!-- Destination Start -->


        <!-- Service Start -->
        <div class="container-fluid py-5">
            <div class="container pt-5 pb-3">
                <div class="text-center mb-3 pb-3">
                    <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Services</h6>
                    <h1>Tours & Travel Services</h1>
                </div>
                <div class="row">
                    <template v-for="(service, index) in $page.props.siteServices.slice(0, 3)" :key="index">
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="service-item bg-white text-center mb-2 py-5 px-4">
                                <!-- Combine dynamic class and static class within :class directive -->
                                <i :class="[service.service_icon, 'mx-auto mb-4']"></i>
                                <h5 class="mb-2">{{ service.service_title }}</h5>
                                <p class="m-0">{{ service.service_text }}</p>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
        <!-- Service End -->


        <!-- Packages Start -->
        <div class="container-fluid py-5">
            <div class="container pt-5 pb-3">
                <div class="text-center mb-3 pb-3">
                    <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Packages</h6>
                    <h1>Pefect Tour Packages</h1>
                </div>
                <div class="row">
                    <div v-for="pkg in packages.data" :key="pkg.id" class="col-lg-4 col-md-6 mb-4">
                        <div class="package-item bg-white mb-2">
                            <img class="img-fluid" :src="pkg.package_banner" alt="">
                            <div class="p-4">
                                <div class="d-flex justify-content-between mb-3">
                                    <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i>{{ pkg.country }}</small>
                                    <small class="m-0"><i class="fa fa-calendar-alt text-primary mr-2"></i>{{ pkg.package_duration }} days</small>
                                    <small class="m-0"><i class="fa fa-user text-primary mr-2"></i>{{ pkg.package_person }} Person</small>
                                </div>
                                <Link :href="route('package.show', { package_code: pkg.package_code })" class="h5 text-decoration-none">
                                    {{ pkg.package_name }}
                                </Link>
                                <div class="border-top mt-4 pt-4">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="m-0"><i class="fa fa-star text-primary mr-2"></i>{{ pkg.package_rating }} </h6>
                                        <h5 class="m-0">${{ pkg.package_price }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Packages End -->


        <!-- Registration Start -->

        <!-- Registration End -->


        <!-- Team Start -->
        <div class="container-fluid py-5">
            <div class="container pt-5 pb-3">
                <div class="text-center mb-3 pb-3">
                    <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Guides</h6>
                    <h1>Our Travel Guides</h1>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 pb-2">
                        <div class="team-item bg-white mb-4">
                            <div class="team-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="/assets/frontend/img/team-1.jpg" alt="">
                                <div class="team-social">
                                    <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-instagram"></i></a>
                                    <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <h5 class="text-truncate">Guide Name</h5>
                                <p class="m-0">Designation</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 pb-2">
                        <div class="team-item bg-white mb-4">
                            <div class="team-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="/assets/frontend/img/team-2.jpg" alt="">
                                <div class="team-social">
                                    <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-instagram"></i></a>
                                    <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <h5 class="text-truncate">Guide Name</h5>
                                <p class="m-0">Designation</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 pb-2">
                        <div class="team-item bg-white mb-4">
                            <div class="team-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="/assets/frontend/img/team-3.jpg" alt="">
                                <div class="team-social">
                                    <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-instagram"></i></a>
                                    <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <h5 class="text-truncate">Guide Name</h5>
                                <p class="m-0">Designation</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 pb-2">
                        <div class="team-item bg-white mb-4">
                            <div class="team-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="/assets/frontend/img/team-4.jpg" alt="">
                                <div class="team-social">
                                    <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-instagram"></i></a>
                                    <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <h5 class="text-truncate">Guide Name</h5>
                                <p class="m-0">Designation</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team End -->


        <!-- Testimonial Start -->

        <!-- Testimonial End -->


        <!-- Blog Start -->
        <div class="container-fluid py-5">
            <div class="container pt-5 pb-3">
                <div class="text-center mb-3 pb-3">
                    <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Our Blog</h6>
                    <h1>Latest From Our Blog</h1>
                </div>
                <div class="row pb-3">
                    <template v-for="blog in blogs.data">
                        <div class="col-lg-4 col-md-6 mb-4 pb-2">
                            <div class="blog-item">
                                <div class="position-relative">
                                    <img class="img-fluid w-100" :src="blog.image" alt="">
                                    <div class="blog-date">
                                        <h6 class="font-weight-bold mb-n1">{{ blog.created_date }}</h6>
                                        <small class="text-white text-uppercase">{{ blog.created_month }}</small>
                                    </div>
                                </div>
                                <div class="bg-white p-4">
                                    <div class="d-flex mb-2">
                                        <a class="text-primary text-uppercase text-decoration-none" href="">Admin</a>
                                        <span class="text-primary px-2">|</span>
                                        <a class="text-primary text-uppercase text-decoration-none" href="">Tours & Travel</a>
                                    </div>
                                    <Link :href="route('blog.single',{ blog : blog.id })" class="h5 m-0 text-decoration-none" href="">{{ blog.title }}</Link>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
        <!-- Blog End -->
    </Layouts>
</template>
