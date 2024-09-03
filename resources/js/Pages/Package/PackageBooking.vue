<script setup>
import {Head, Link, useForm} from "@inertiajs/vue3";
import Layouts from "@/Layouts/Layouts.vue";
import VueDatePicker from 'vue3-datepicker';
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import {ref, watch,computed } from "vue";
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const props = defineProps({
    package: Object,
});


const numAdults = ref(1);
const numChildren = ref(0);

const adultInfos = ref([...Array(numAdults.value)].map(() => ({ title: "", name: "", passportNumber: "", passportCopy: null })));
const childInfos = ref([...Array(numChildren.value)].map(() => ({ title: "", name: "", passportNumber: "", passportCopy: null })));

watch(numAdults, (newVal) => {
    adultInfos.value = [...Array(newVal)].map(() => ({ title: "", name: "", passportNumber: "", passportCopy: null }));
    updateTotalAmount();
});

watch(numChildren, (newVal) => {
    childInfos.value = [...Array(newVal)].map(() => ({ title: "", name: "", passportNumber: "", passportCopy: null }));
    updateTotalAmount();
});

const packagePrice = computed(() => {
    return props.package.package_price;
});

const total_amount = ref(0);

const updateTotalAmount = () => {
    total_amount.value = packagePrice.value * numAdults.value + packagePrice.value * 0.75 * numChildren.value;
};

updateTotalAmount(); // Initial calculation

const form = useForm({
    package_id: props.package.id,
    traveller_email: "",
    traveller_phone: "",
    number_of_adult: numAdults.value,
    number_of_child: numChildren.value,
    adult_infos: adultInfos.value,
    child_infos: childInfos.value,
    journey_date: "",
    total_amount: total_amount.value,
    other_requirements: "",
});

const handleFileUpload = (event, type, index) => {
    const file = event.target.files[0];
    if (type === "adult_infos") {
        adultInfos.value[index].passportCopy = file;
    } else if (type === "child_infos") {
        childInfos.value[index].passportCopy = file;
    }
};

const submitForm = () => {
    form.number_of_adult = numAdults.value;
    form.number_of_child = numChildren.value;
    form.adult_infos = adultInfos.value;
    form.child_infos = childInfos.value;
    form.total_amount = total_amount.value;

    form.post(route('package.booking.store'),{
        preserveScroll: true,
        onSuccess: () => {
            toast("Successfully Booked", {
                autoClose: 1000,
            });
            form.reset();
        }
    });
};
</script>

<template>
    <Layouts>
        <Head title="Package Booking" />

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

            </div>
        </div>

        <div class="container-fluid py-3">
            <form @submit.prevent="submitForm">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="pb-3">
                                <div class="bg-white mb-3" style="padding: 30px;">
                                    <div class="d-flex mb-3">
                                        <a class="text-primary text-uppercase text-decoration-none" href="">Traveller Details</a>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-12 mb-2">
                                            <div class="form-group">
                                                <label for="email">Email Address</label>
                                                <TextInput
                                                    id="email"
                                                    type="email"
                                                    class="form-control"
                                                    required
                                                    placeholder="Email Address"
                                                    v-model="form.traveller_email"
                                                />
                                                <InputError :message="form.errors.traveller_email" class="mt-2 text-danger" />
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-4 col-12 mb-2">
                                            <div class="form-group">
                                                <label for="phone">Phone Number</label>
                                                <TextInput
                                                    id="phone"
                                                    type="text"
                                                    class="form-control"
                                                    required
                                                    placeholder="Phone Number"
                                                    v-model="form.traveller_phone"
                                                />
                                                <InputError :message="form.errors.traveller_phone" class="mt-2 text-danger" />
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-4 col-12 mb-2">
                                            <div class="form-group">
                                                <label for="numAdults">Number of Adults</label>
                                                <select v-model="numAdults" class="form-control" id="numAdults">
                                                    <option v-for="n in 9" :key="n" :value="n">{{ n }}</option>
                                                </select>
                                                <InputError :message="form.errors.number_of_adult" class="mt-2 text-danger" />
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-4 col-12 mb-2">
                                            <div class="form-group">
                                                <label for="numChildren">Number of Children</label>
                                                <select v-model="numChildren" class="form-control" id="numChildren">
                                                    <option v-for="n in 9" :key="n" :value="n">{{ n }}</option>
                                                </select>
                                                <InputError :message="form.errors.number_of_child" class="mt-2 text-danger" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" v-for="(adult, index) in adultInfos" :key="index">
                                        <div class="col-lg-3 col-md-4 col-12 mb-2">
                                            <div class="form-group">
                                                <label :for="'title-' + index">Adult {{ index + 1 }} Title</label>
                                                <select v-model="adult.title" class="form-control" :id="'title-' + index">
                                                    <option value="Mr.">Mr.</option>
                                                    <option value="Mrs.">Mrs.</option>
                                                    <option value="Miss">Miss</option>
                                                    <option value="M/S">M/S</option>
                                                </select>
                                                <InputError :message="form.errors[`adult_infos.${index}.title`]" class="mt-2 text-danger" />
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-4 col-12 mb-2">
                                            <div class="form-group">
                                                <label :for="'guestName-' + index">Guest {{ index + 1 }} Name</label>
                                                <TextInput
                                                    :id="'guestName-' + index"
                                                    type="text"
                                                    class="form-control"
                                                    required
                                                    placeholder="Guest Name"
                                                    v-model="adult.name"
                                                />
                                                <InputError :message="form.errors[`adult_infos.${index}.name`]" class="mt-2 text-danger" />
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-4 col-12 mb-2">
                                            <div class="form-group">
                                                <label :for="'passportNumber-' + index">Passport {{ index + 1 }} Number</label>
                                                <TextInput
                                                    :id="'passportNumber-' + index"
                                                    type="text"
                                                    class="form-control"
                                                    required
                                                    placeholder="Passport Number"
                                                    v-model="adult.passportNumber"
                                                />
                                                <InputError :message="form.errors[`adult_infos.${index}.passportNumber`]" class="mt-2 text-danger" />
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-4 col-12 mb-2">
                                            <div class="form-group">
                                                <label :for="'passportCopy-' + index">Passport {{ index + 1 }} Copy</label>
                                                <input type="file" :id="'passportCopy-' + index" class="form-control" @change="handleFileUpload($event, 'adult_infos', index)" />
                                                <InputError :message="form.errors[`adult_infos.${index}.passportCopy`]" class="mt-2 text-danger" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" v-for="(child, index) in childInfos" :key="'child-' + index">
                                        <div class="col-lg-3 col-md-4 col-12 mb-2">
                                            <div class="form-group">
                                                <label :for="'childTitle-' + index">Child {{ index + 1 }} Title</label>
                                                <select v-model="child.title" class="form-control" :id="'childTitle-' + index">
                                                    <option value="Mr.">Mr.</option>
                                                    <option value="Mrs.">Mrs.</option>
                                                    <option value="Miss">Miss</option>
                                                    <option value="M/S">M/S</option>
                                                </select>
                                                <InputError :message="form.errors[`child_infos.${index}.title`]" class="mt-2 text-danger" />
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-4 col-12 mb-2">
                                            <div class="form-group">
                                                <label :for="'childName-' + index">Guest {{ index + 1 }} Name</label>
                                                <TextInput
                                                    :id="'childName-' + index"
                                                    type="text"
                                                    class="form-control"
                                                    required
                                                    placeholder="Guest Name"
                                                    v-model="child.name"
                                                />
                                                <InputError :message="form.errors[`child_infos.${index}.name`]" class="mt-2 text-danger" />
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-4 col-12 mb-2">
                                            <div class="form-group">
                                                <label :for="'childPassport-' + index">Passport {{ index + 1 }} Number</label>
                                                <TextInput
                                                    :id="'childPassport-' + index"
                                                    type="text"
                                                    class="form-control"
                                                    required
                                                    placeholder="Passport Number"
                                                    v-model="child.passportNumber"
                                                />
                                                <InputError :message="form.errors[`child_infos.${index}.passportNumber`]" class="mt-2 text-danger" />
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-4 col-12 mb-2">
                                            <div class="form-group">
                                                <label :for="'childPassportCopy-' + index">Passport {{ index + 1 }} Copy</label>
                                                <input type="file" :id="'childPassportCopy-' + index" class="form-control" @change="handleFileUpload($event, 'child_infos', index)" />
                                                <InputError :message="form.errors[`child_infos.${index}.passportCopy`]" class="mt-2 text-danger" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-12 mb-2">
                                            <div class="form-group">
                                                <label for="journey_date">Journey Date</label>
                                                <div class="mb-3 mb-md-0">
                                                    <div class="date" id="date1" data-target-input="nearest">
<!--                                                        <input type="text" v-model="form.journey_date" class="form-control datetimepicker-input" placeholder="Journey Date" data-target="#date1" data-toggle="datetimepicker"/>-->
                                                        <VueDatePicker class="form-control" v-model="form.journey_date"></VueDatePicker>
                                                        <InputError :message="form.errors.journey_date" class="mt-2 text-danger" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-12 mb-2">
                                            <div class="form-group">
                                                <label for="other_requirements">Other Requirements</label>
                                                <textarea v-model="form.other_requirements" class="form-control" rows="5"></textarea>
                                                <InputError :message="form.errors.other_requirements" class="mt-2 text-danger" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pb-3">
                                <div class="bg-white mb-3" style="padding: 30px;">
                                    <div class="d-flex mb-3">
                                        <a class="text-primary text-uppercase text-decoration-none" href="">Cost Details</a>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <h6>Adult Cost({{ package.package_price }} * {{ numAdults }}):</h6>
                                        </div>
                                        <div class="col-6">{{ package.package_price * numAdults }}</div>

                                        <div class="col-6">
                                            <h6>Child Cost({{ package.package_price * 0.75 }} * {{ numChildren }}):</h6>
                                        </div>
                                        <div class="col-6">{{ package.package_price * 0.75 * numChildren }}</div>

                                        <div class="col-6">
                                            <h6>Total Amount :</h6>
                                        </div>
                                        <input type="hidden" v-model="form.total_amount" />
                                        <div class="col-6">{{ package.package_price * numAdults + package.package_price * 0.75 * numChildren }}</div>

                                        <div class="col-6">
                                            <h6>Advanced To Be Paid({{ package.package_price * numAdults + package.package_price * 0.75 * numChildren }} / 2):</h6>
                                        </div>
                                        <div class="col-6">{{ (package.package_price * numAdults + package.package_price * 0.75 * numChildren) / 2 }}</div>

                                        <div class="col-6">
                                            <h6>Due Amount After Completing Advance({{ package.package_price * numAdults + package.package_price * 0.75 * numChildren }} / 2):</h6>
                                        </div>
                                        <div class="col-6">{{ (package.package_price * numAdults + package.package_price * 0.75 * numChildren) / 2 }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="button">
                                    <button type="submit" class="btn btn-dark">Book This Tour</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </Layouts>
</template>
