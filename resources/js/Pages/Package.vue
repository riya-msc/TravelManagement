<script setup>

import Layouts from "@/Layouts/Layouts.vue";
import {Head,Link} from "@inertiajs/vue3";
import BookingFrom from "@/Components/Frontend/BookingFrom.vue";

const props = defineProps({
    packages : Object
});

</script>

<template>
    <Layouts>
        <Head title="Packages" />
        <!-- Header Start -->
        <div class="container-fluid page-header">
            <div class="container">
                <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                    <h3 class="display-4 text-white text-uppercase">PACKAGES</h3>
                    <div class="d-inline-flex text-white">
                        <p class="m-0 text-uppercase"><Link class="text-white" :href="route('index')">Home</Link></p>
                        <i class="fa fa-angle-double-right pt-1 px-3"></i>
                        <p class="m-0 text-uppercase">PACKAGES</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->


        <!-- Booking Start -->
        <BookingFrom/>
        <!-- Booking End -->


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


        <!-- Destination Start -->
        <div class="container-fluid py-5">
            <div class="container pt-5 pb-3">
                <div class="text-center mb-3 pb-3">
                    <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Destination</h6>
                    <h1>Explore Top Destination</h1>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="destination-item position-relative overflow-hidden mb-2">
                            <img class="img-fluid" src="img/destination-1.jpg" alt="">
                            <a class="destination-overlay text-white text-decoration-none" href="">
                                <h5 class="text-white">United States</h5>
                                <span>100 Cities</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="destination-item position-relative overflow-hidden mb-2">
                            <img class="img-fluid" src="img/destination-2.jpg" alt="">
                            <a class="destination-overlay text-white text-decoration-none" href="">
                                <h5 class="text-white">United Kingdom</h5>
                                <span>100 Cities</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="destination-item position-relative overflow-hidden mb-2">
                            <img class="img-fluid" src="img/destination-3.jpg" alt="">
                            <a class="destination-overlay text-white text-decoration-none" href="">
                                <h5 class="text-white">Australia</h5>
                                <span>100 Cities</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="destination-item position-relative overflow-hidden mb-2">
                            <img class="img-fluid" src="img/destination-4.jpg" alt="">
                            <a class="destination-overlay text-white text-decoration-none" href="">
                                <h5 class="text-white">India</h5>
                                <span>100 Cities</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="destination-item position-relative overflow-hidden mb-2">
                            <img class="img-fluid" src="img/destination-5.jpg" alt="">
                            <a class="destination-overlay text-white text-decoration-none" href="">
                                <h5 class="text-white">South Africa</h5>
                                <span>100 Cities</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="destination-item position-relative overflow-hidden mb-2">
                            <img class="img-fluid" src="img/destination-6.jpg" alt="">
                            <a class="destination-overlay text-white text-decoration-none" href="">
                                <h5 class="text-white">Indonesia</h5>
                                <span>100 Cities</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Destination Start -->
    </Layouts>
</template>
