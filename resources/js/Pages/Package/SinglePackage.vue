<script setup>

import {Head, Link, useForm} from "@inertiajs/vue3";
import Layouts from "@/Layouts/Layouts.vue";
import { toast } from 'vue3-toastify';
import InputError from "@/Components/InputError.vue";
import VueDatePicker from "vue3-datepicker";

const props = defineProps({
    package : Object,
    validity: String,
    packageImages: Object,
    packageItinerary: Object,
    packageInq: String,
    packageEnq: String,
});


const queryForm = useForm({
    name: '',
    email: '',
    phone: '',
    starting_date: '',
    return_date: '',
    airline_choice: '',
    visiting_country: '',
    visiting_cities: '',
    airline_ticket_category: '',
    number_of_adults: '',
    number_of_children: '',
    accommodation_typer: '',
    number_of_rooms: '',
    foods_included: '',
    guide_required: '',
    private_transport: '',
    special_requirement: '',
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

const submitTourQuery = () => queryForm.post(route('store.tour.query'),{
    preserveScroll: true,
    onSuccess: () => {
        toast("Successfully Sent", {
            autoClose: 1000,
        });
        queryForm.reset();
    }
})

</script>

<template>
    <Layouts>
        <Head title="Package" />
        <div class="d-flex flex-column align-items-center mt-4" >
            <h3 class="display-4 text-dark text-uppercase">{{ package.package_name }}</h3>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-4 py-2">
                    <h4 class="display-5 text-dark text-uppercase">Country: {{ package.country }}</h4>
                </div>
                <div class="col-4 py-2">
                    <h4 class="display-5 text-dark text-uppercase">City: {{ package.city }}</h4>
                </div>
                <div class="col-4 py-2">
                    <h4 class="display-5 text-dark text-uppercase">Duration: {{ package.package_duration }} Days</h4>
                </div>

                <div class="col-4 py-2">
                    <h4 class="display-5 text-dark text-uppercase">Price: {{ package.package_price }}</h4>
                </div>
                <div class="col-4 py-2">
                    <h4 class="display-5 text-dark text-uppercase">Rating: {{ package.package_rating }}</h4>
                </div>
                <div class="col-4 py-2">
                    <h4 class="display-5 text-dark text-uppercase">Persons: {{ package.package_person }} Person</h4>
                </div>

                <div class="col-4 py-2">
                    <h4 class="display-5 text-dark text-uppercase">Valid Till: {{ validity }}</h4>
                </div>
            </div>
        </div>


        <!-- Blog Start -->
        <div class="container-fluid py-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Blog Detail Start -->
                        <div class="pb-3">
                            <div class="container-fluid p-0" style="margin-top: 15px">
                                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div v-for="(package_image, index) in packageImages" :key="package_image.id" :class="{'carousel-item': true, 'active': index === 0}">
                                            <img class="w-100" :src="getImageUrl(package_image.image)" alt="Image" style="height: 400px;object-fit: cover">
                                            <div class="carousel-caption-package d-flex flex-column align-items-center justify-content-center">
                                                <div class="p-3" style="max-width: 900px;">

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

                            <div class="bg-white mb-3" style="padding: 30px;">
                                <div class="d-flex mb-3">
                                    <a class="text-primary text-uppercase text-decoration-none" href="">Package Itinerary</a>
                                </div>

                                <div v-for="pkgItinerary in packageItinerary">
                                    <h4 class="mb-3">Day {{ pkgItinerary.id }}</h4>
                                    <h5 class="mb-3">{{ pkgItinerary.tour_title }}</h5>
                                    <img class="" :src="getImageUrl(pkgItinerary.tour_image)" style="height: 300px;object-fit: cover">
                                    <p>{{ pkgItinerary.tour_description }}
                                    </p>
                                </div>

                            </div>
                        </div>
                        <!-- Blog Detail End -->

                        <!-- Comment List Start -->
                        <div class="bg-white" style="padding: 30px; margin-bottom: 30px;">
                            <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">Package Inclusion</h4>
                            <div class="media mb-4">
                                <div class="media-body">
                                    <div v-html="formatText(packageInq)"></div>
                                </div>
                            </div>

                            <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">Package Exclusion</h4>
                            <div class="media mb-4">
                                <div class="media-body">
                                    <div v-html="formatText(packageEnq)"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Comment List End -->

                        <!-- Comment Form Start -->
                        <div class="bg-white mb-3" style="padding: 30px;">
                            <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">Terms and Conditions</h4>
                            <h6 v-html="package.terms_condition"></h6>
                        </div>
                        <!-- Comment Form End -->
                    </div>

                    <div class="col-lg-4">
                        <img :src="getImageUrl(package.package_banner)" class="img-fluid" >
                        <!-- Author Bio -->
                        <div class="d-flex flex-column text-center bg-white mb-5 mt-4 py-5 px-4">

                            <h3 class="text-primary mb-3">{{ package.package_name }}</h3>
                            <p>Conset elitr erat vero dolor ipsum et diam, eos dolor lorem, ipsum sit no ut est  ipsum erat kasd amet elitr</p>

                            <Link :href="route('package.booking', { package_code: package.package_code })" v-if="$page.props.auth.user" class="btn btn-primary py-md-3 px-md-5 mt-2">Book This Tour</Link>
                            <template v-else><p class="text-danger">You Need To login first to book this package</p></template>
                            <a href="" class="btn btn-dark py-md-3 px-md-5 mt-2" data-toggle="modal" data-target="#exampleModalCenter">Customize Tour Query</a>
                        </div>


                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content border_rounded">
                                    <div class="modal-header header_area">
                                        <h5 class="modal-title text-center" id="exampleModalLongTitle">Customize Tour Query
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form @submit.prevent="submitTourQuery">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-4 mb-2">
                                                    <div class="form-group">
                                                        <label>Name:</label>
                                                        <input type="text" class="form-control" v-model="queryForm.name">
                                                        <InputError :message="queryForm.errors.name" class="mt-2 text-danger" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-4 mb-2">
                                                    <div class="form-group">
                                                        <label>Email:</label>
                                                        <input type="email" class="form-control" v-model="queryForm.email">
                                                        <InputError :message="queryForm.errors.email" class="mt-2 text-danger" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-4 mb-2">
                                                    <div class="form-group">
                                                        <label>Phone:</label>
                                                        <input type="text" class="form-control" v-model="queryForm.phone">
                                                        <InputError :message="queryForm.errors.phone" class="mt-2 text-danger" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-4 mb-2">
                                                    <div class="form-group">
                                                        <label>Starting Date:</label>
                                                        <VueDatePicker class="form-control" v-model="queryForm.starting_date"></VueDatePicker>
                                                        <InputError :message="queryForm.errors.starting_date" class="mt-2 text-danger" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-4 mb-2">
                                                    <div class="form-group">
                                                        <label>Return Date:</label>
                                                        <VueDatePicker class="form-control" v-model="queryForm.return_date"></VueDatePicker>
                                                        <InputError :message="queryForm.errors.return_date" class="mt-2 text-danger" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-4 mb-2">
                                                    <div class="form-group">
                                                        <label>Any Airline Choice:</label>
                                                        <input type="text" class="form-control" v-model="queryForm.airline_choice">
                                                        <InputError :message="queryForm.errors.airline_choice" class="mt-2 text-danger" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-4 mb-2">
                                                    <div class="form-group">
                                                        <label>Visiting Country:</label>
                                                        <input type="text" class="form-control" v-model="queryForm.visiting_country">
                                                        <InputError :message="queryForm.errors.visiting_country" class="mt-2 text-danger" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-4 mb-2">
                                                    <div class="form-group">
                                                        <label>Visiting Cities:</label>
                                                        <input type="text" class="form-control" v-model="queryForm.visiting_cities">
                                                        <InputError :message="queryForm.errors.visiting_cities" class="mt-2 text-danger" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-4 mb-2">
                                                    <div class="form-group">
                                                        <label>Airline Ticket Category:</label>
                                                        <select class="form-control" v-model="queryForm.airline_ticket_category">
                                                            <option selected disabled>Select One</option>
                                                            <option value="Economy">Economy</option>
                                                            <option value="Business">Business</option>
                                                            <option value="First Class">First Class</option>
                                                        </select>
                                                        <InputError :message="queryForm.errors.airline_ticket_category" class="mt-2 text-danger" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-4 mb-2">
                                                    <div class="form-group">
                                                        <label>How Many Adults:</label>
                                                        <input type="number" class="form-control" v-model="queryForm.number_of_adults">
                                                        <InputError :message="queryForm.errors.number_of_adults" class="mt-2 text-danger" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-4 mb-2">
                                                    <div class="form-group">
                                                        <label>How Many Children:</label>
                                                        <input type="number" class="form-control" v-model="queryForm.number_of_children">
                                                        <InputError :message="queryForm.errors.number_of_children" class="mt-2 text-danger" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-4 mb-2">
                                                    <div class="form-group">
                                                        <label>Accommodation Type:</label>
                                                        <select class="form-control" v-model="queryForm.accommodation_typer">
                                                            <option selected disabled>Select One</option>
                                                            <option value="2star">2star</option>
                                                            <option value="3star">3star</option>
                                                            <option value="4star">4star</option>
                                                            <option value="5star">5star</option>
                                                        </select>
                                                        <InputError :message="queryForm.errors.accommodation_typer" class="mt-2 text-danger" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 col-md-3 col-3 mb-2">
                                                    <div class="form-group">
                                                        <label>How Many Rooms:</label>
                                                        <input type="number" class="form-control" v-model="queryForm.number_of_rooms">
                                                        <InputError :message="queryForm.errors.number_of_rooms" class="mt-2 text-danger" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-3 mb-2">
                                                    <div class="form-group">
                                                        <label>Foods Included:</label>
                                                        <select class="form-control" v-model="queryForm.foods_included">
                                                            <option selected disabled>Select One</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                        <InputError :message="queryForm.errors.foods_included" class="mt-2 text-danger" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-3 mb-2">
                                                    <div class="form-group">
                                                        <label>Guide Required:</label>
                                                        <select class="form-control" v-model="queryForm.guide_required">
                                                            <option selected disabled>Select One</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                        <InputError :message="queryForm.errors.guide_required" class="mt-2 text-danger" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 col-md-3 col-3 mb-2">
                                                    <div class="form-group">
                                                        <label>Private Transport:</label>
                                                        <select class="form-control" v-model="queryForm.private_transport">
                                                            <option selected disabled>Select One</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                        <InputError :message="queryForm.errors.private_transport" class="mt-2 text-danger" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-12 mb-2">
                                                    <div class="form-group">
                                                        <label>Any Other Special requirements:</label>
                                                        <input type="text" class="form-control" v-model="queryForm.special_requirement">
                                                        <InputError :message="queryForm.errors.special_requirement" class="mt-2 text-danger" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-12 mb-2">
                                                    <div class="form-group">
                                                        <div class="button">
                                                            <button type="submit" class="btn btn-primary">Send Query</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

<!--                        &lt;!&ndash; Search Form &ndash;&gt;-->
<!--                        <div class="mb-5">-->
<!--                            <div class="bg-white" style="padding: 30px;">-->
<!--                                <div class="input-group">-->
<!--                                    <input type="text" class="form-control p-4" placeholder="Keyword">-->
<!--                                    <div class="input-group-append">-->
<!--                                    <span class="input-group-text bg-primary border-primary text-white"><i-->
<!--                                        class="fa fa-search"></i></span>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->

                        <!-- Category List -->
                        <div class="mb-5">
                            <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">Visa Requirements</h4>
                            <div class="bg-white" style="padding: 30px;">
                                <div v-html="formatText(package.visa_requirements ?? 'No Need')"></div>
                            </div>
                        </div>


                    </div>
                </div>

                <a href="" v-if="$page.props.auth.user" class="btn btn-primary py-md-3 px-md-5 mt-2" data-toggle="modal" data-target="#exampleModalCenter">Book This Tour</a>
                <template v-else><p class="text-danger">You Need To login first to book this package</p></template>
            </div>
        </div>
        <!-- Blog End -->
    </Layouts>
</template>
