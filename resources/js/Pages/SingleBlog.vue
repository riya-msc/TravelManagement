<script setup>

import {Head, Link, useForm} from "@inertiajs/vue3";
import Layouts from "@/Layouts/Layouts.vue";
import { toast } from 'vue3-toastify';
import InputError from "@/Components/InputError.vue";
import VueDatePicker from "vue3-datepicker";

const props = defineProps({
    blog : Object,
});

const getImageUrl = (imagePath) => {
    return `http://127.0.0.1:8000/${imagePath}`;
}

const formatText = (text) => {
    return text.split('.').map(sentence => sentence.trim()).filter(sentence => sentence.length > 0).map(sentence => `<p>${sentence}.</p>`).join('');
}

const stripHtmlTags = (html) => {
    const doc = new DOMParser().parseFromString(html, 'text/html');
    return doc.body.textContent || "";
}

</script>

<template>
    <Layouts>
        <Head title="Package" />
        <div class="container-fluid page-header">
            <div class="container">
                <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                    <h3 class="display-4 text-white text-uppercase">Blog Detail</h3>
                    <div class="d-inline-flex text-white">
                        <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                        <i class="fa fa-angle-double-right pt-1 px-3"></i>
                        <p class="m-0 text-uppercase">Blog Detail</p>
                    </div>
                </div>
            </div>
        </div>


        <!-- Blog Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Blog Detail Start -->
                        <div class="pb-3">
                            <div class="blog-item">
                                <div class="position-relative">
                                    <img class="img-fluid w-100" :src="getImageUrl(blog.data.image)" alt="">
                                    <div class="blog-date">
                                        <h6 class="font-weight-bold mb-n1">{{ blog.data.created_date }}</h6>
                                        <small class="text-white text-uppercase">{{ blog.data.created_month }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white mb-3" style="padding: 30px;">
                                <div class="d-flex mb-3">
                                    <a class="text-primary text-uppercase text-decoration-none" href="">Admin</a>
                                    <span class="text-primary px-2">|</span>
                                    <a class="text-primary text-uppercase text-decoration-none" href="">Tours & Travel</a>
                                </div>
                                <h2 class="mb-3">Dolor justo sea kasd lorem clita justo diam amet</h2>
                                <p>
                                    <div v-html="formatText(blog.data.description ?? 'No Need')"></div>
                                </p>
                            </div>
                        </div>
                        <!-- Blog Detail End -->


                        <!-- Comment Form End -->
                    </div>

                    <div class="col-lg-4 mt-5 mt-lg-0">
                        <!-- Author Bio -->
                        <div class="d-flex flex-column text-center bg-white mb-5 py-5 px-4">
                            <h3 class="text-primary mb-3">{{ blog.data.author }}</h3>
                            <p>{{ blog.data.author_details }}</p>
                            <div class="d-flex justify-content-center">
                                <a class="text-primary px-2" href="">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a class="text-primary px-2" href="">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a class="text-primary px-2" href="">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a class="text-primary px-2" href="">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a class="text-primary px-2" href="">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </div>
                        </div>


                        <!-- Tag Cloud -->
                        <div class="mb-5">
                            <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">Tag Cloud</h4>
                            <div class="d-flex flex-wrap m-n1">
                                <a href="" class="btn btn-light m-1">Design</a>
                                <a href="" class="btn btn-light m-1">Development</a>
                                <a href="" class="btn btn-light m-1">Marketing</a>
                                <a href="" class="btn btn-light m-1">SEO</a>
                                <a href="" class="btn btn-light m-1">Writing</a>
                                <a href="" class="btn btn-light m-1">Consulting</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Blog End -->
    </Layouts>
</template>
