<script setup>

import Layouts from "@/Layouts/Layouts.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import BookingFrom from "@/Components/Frontend/BookingFrom.vue";
import { toast } from 'vue3-toastify';
import InputError from "@/Components/InputError.vue";

const contactForm = useForm({
    name: '',
    email: '',
    subject: '',
    message: '',
});

const contactStore = async () => {
    contactForm.post(route('contact.store'),{
        preserveScroll: true,
        onSuccess: () => {
            toast("Successfully Sent", {
                autoClose: 1000,
            });
            contactForm.reset();
        }
    });
};
</script>

<template>
    <Layouts>
        <Head title="Contact" />
        <!-- Header Start -->
        <div class="container-fluid page-header">
            <div class="container">
                <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                    <h3 class="display-4 text-white text-uppercase">CONTACT</h3>
                    <div class="d-inline-flex text-white">
                        <p class="m-0 text-uppercase"><Link class="text-white" :href="route('index')">Home</Link></p>
                        <i class="fa fa-angle-double-right pt-1 px-3"></i>
                        <p class="m-0 text-uppercase">CONTACT</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->


        <!-- Booking Start -->
        <BookingFrom/>
        <!-- Booking End -->


        <!-- Contact Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="text-center mb-3 pb-3">
                    <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Contact</h6>
                    <h1>Contact For Any Query</h1>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="contact-form bg-white" style="padding: 30px;">
                            <div id="success"></div>
                            <form name="sentMessage" id="contactForm" novalidate="novalidate" @submit.prevent="contactStore">
                                <div class="form-row">
                                    <div class="control-group col-sm-6 mb-2">
                                        <input type="text" class="form-control p-4" id="name" placeholder="Your Name"
                                               required="required" data-validation-required-message="Please enter your name" v-model="contactForm.name" />
                                        <InputError class="help-block text-danger" :message="contactForm.errors.name" />
                                    </div>
                                    <div class="control-group col-sm-6">
                                        <input type="email" class="form-control p-4" id="email" placeholder="Your Email"
                                               required="required" data-validation-required-message="Please enter your email" v-model="contactForm.email" />
                                        <InputError class="help-block text-danger" :message="contactForm.errors.email" />
                                    </div>
                                </div>
                                <div class="control-group mb-2">
                                    <input type="text" class="form-control p-4" id="subject" placeholder="Subject"
                                           required="required" data-validation-required-message="Please enter a subject" v-model="contactForm.subject" />
                                    <InputError class="help-block text-danger" :message="contactForm.errors.subject" />
                                </div>
                                <div class="control-group">
                                <textarea class="form-control py-3 px-4 mb-2" rows="5" id="message" placeholder="Message"
                                          required="required"
                                          data-validation-required-message="Please enter your message"  v-model="contactForm.message"></textarea>
                                    <InputError class="help-block text-danger" :message="contactForm.errors.message" />
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary py-3 px-4" type="submit" id="sendMessageButton">Send Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->
    </Layouts>
</template>
