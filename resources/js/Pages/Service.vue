<script setup>

import Layouts from "@/Layouts/Layouts.vue";
import {Head,Link} from "@inertiajs/vue3";
import BookingFrom from "@/Components/Frontend/BookingFrom.vue";

const props = defineProps({
    blogs : Object,
});

</script>

<template>
    <Layouts>
        <Head title="Services" />
        <!-- Header Start -->
        <div class="container-fluid page-header">
            <div class="container">
                <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                    <h3 class="display-4 text-white text-uppercase">SERVICES</h3>
                    <div class="d-inline-flex text-white">
                        <p class="m-0 text-uppercase"><Link class="text-white" :href="route('index')">Home</Link></p>
                        <i class="fa fa-angle-double-right pt-1 px-3"></i>
                        <p class="m-0 text-uppercase">SERVICES</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->


        <!-- Booking Start -->
        <BookingFrom/>
        <!-- Booking End -->


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
        <!-- Service End -->


        <!-- Testimonial Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="text-center mb-3 pb-3">
                    <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Testimonial</h6>
                    <h1>What Say Our Clients</h1>
                </div>
                <div class="owl-carousel testimonial-carousel">
                    <div class="text-center pb-4">
                        <img class="img-fluid mx-auto" src="/assets/frontend/img/testimonial-1.jpg" style="width: 100px; height: 100px;" >
                        <div class="testimonial-text bg-white p-4 mt-n5">
                            <p class="mt-5">Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam
                            </p>
                            <h5 class="text-truncate">Client Name</h5>
                            <span>Profession</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <img class="img-fluid mx-auto" src="/assets/frontend/img/testimonial-2.jpg" style="width: 100px; height: 100px;" >
                        <div class="testimonial-text bg-white p-4 mt-n5">
                            <p class="mt-5">Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam
                            </p>
                            <h5 class="text-truncate">Client Name</h5>
                            <span>Profession</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <img class="img-fluid mx-auto" src="/assets/frontend/img/testimonial-3.jpg" style="width: 100px; height: 100px;" >
                        <div class="testimonial-text bg-white p-4 mt-n5">
                            <p class="mt-5">Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam
                            </p>
                            <h5 class="text-truncate">Client Name</h5>
                            <span>Profession</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <img class="img-fluid mx-auto" src="/assets/frontend/img/testimonial-4.jpg" style="width: 100px; height: 100px;" >
                        <div class="testimonial-text bg-white p-4 mt-n5">
                            <p class="mt-5">Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam
                            </p>
                            <h5 class="text-truncate">Client Name</h5>
                            <span>Profession</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->
    </Layouts>
</template>
