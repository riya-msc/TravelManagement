<script setup>

import {Head, Link} from "@inertiajs/vue3";
import Layouts from "@/Layouts/Layouts.vue";

const props = defineProps({
    bookedPackage : Object,
});

const getImageUrl = (imagePath) => {
    return `http://127.0.0.1:8000/${imagePath}`;
}
console.log(props.bookedPackage.data.package)

</script>

<template>
    <Layouts>
        <Head title="Package" />
        <div class="d-flex flex-column align-items-center mt-4" >
            <h3 class="text-dark text-uppercase">{{ bookedPackage.data.package.package_name }}</h3>
        </div>
        <div class="container">
            <div class="d-flex flex-column align-items-center mt-4" >
                <h4 class="text-dark text-uppercase">Booking Info</h4>
            </div>
            <table class="table">
                <tr>
                    <th>Traveller Email</th>
                    <td>{{ bookedPackage.data.traveller_email }}</td>
                </tr>
                <tr>
                    <th>Traveller Phone</th>
                    <td>{{ bookedPackage.data.traveller_phone }}</td>
                </tr>
                <tr>
                    <th>Number of Adult Traveller</th>
                    <td>{{ bookedPackage.data.number_of_adult }}</td>
                </tr>
                <tr>
                    <th>Number of Child Traveller</th>
                    <td>{{ bookedPackage.data.number_of_child }}</td>
                </tr>
                <tr>
                    <th>Coupon</th>
                    <td>{{ bookedPackage.data.coupon }}</td>
                </tr>
                <tr>
                    <th>Journey Date</th>
                    <td>{{ bookedPackage.data.journey_date }}</td>
                </tr>
                <tr>
                    <th>Other Requirements</th>
                    <td>{{ bookedPackage.data.other_requirements }}</td>
                </tr>
                <tr>
                    <th>Booking Status</th>
                    <td v-if="bookedPackage.data.booking_status == 0">
                        <span class="badge bg-warning">Pending</span>
                    </td>

                    <td v-else-if="bookedPackage.data.booking_status == 1">
                        <span class="badge bg-success text-white">Approved</span>
                    </td>

                    <td v-else>
                        <span class="badge bg-danger text-white">Canceled</span>
                    </td>
                </tr>
                <tr>
                    <th>Total Amount</th>
                    <td>{{ bookedPackage.data.total_amount }}</td>
                </tr>
                <tr>
                    <th>Paid Amount</th>
                    <td>{{ bookedPackage.data.paid_amount }}</td>
                </tr>
                <tr>
                    <th>Discount Amount</th>
                    <td>{{ bookedPackage.data.discount_amount }}</td>
                </tr>
                <tr>
                    <th>Due Amount</th>
                    <td>{{ bookedPackage.data.due_amount }}</td>
                </tr>
                <tr>
                    <th>Due Payment date</th>
                    <td>{{ bookedPackage.data.due_payment_date }}</td>
                </tr>
                <tr>
                    <th>Payment Status</th>
                    <td v-if="bookedPackage.data.payment_status == 0">
                        <span class="badge bg-warning">Full Payment Pending</span>
                    </td>

                    <td v-else-if="bookedPackage.data.payment_status == 1">
                        <span class="badge bg-success">Paid</span>
                    </td>

                    <td v-else>
                        <span class="badge bg-primary text-white">Due Pending</span>
                    </td>
                </tr>
            </table>

            <div class="d-flex flex-column align-items-center mt-4" >
                <h4 class="text-dark text-uppercase">Adult Info</h4>
            </div>
            <table class="table">
                <tr>
                    <th>Title</th>
                    <th>Name</th>
                    <th>Passport Number</th>
                    <th>Passport copy</th>
                </tr>

                <tr v-for="adult in bookedPackage.data.adult_infos">
                    <td>{{ adult.title }}</td>
                    <td>{{ adult.name }}</td>
                    <td>{{ adult.passportNumber }}</td>
                    <td>
                        <img class="w-100" :src="getImageUrl(adult.passportCopy)" alt="Image" style="height: 100px;width: 100px">
                    </td>
                </tr>
            </table>

            <div class="d-flex flex-column align-items-center mt-4" >
                <h4 class="text-dark text-uppercase">Child Info</h4>
            </div>
            <table class="table">
                <tr>
                    <th>Title</th>
                    <th>Name</th>
                    <th>Passport Number</th>
                    <th>Passport copy</th>
                </tr>

                <tr v-for="child in bookedPackage.data.child_infos">
                    <td>{{ child.title }}</td>
                    <td>{{ child.name }}</td>
                    <td>{{ child.passportNumber }}</td>
                    <td>
                        <img class="w-100" :src="getImageUrl(child.passportCopy)" alt="Image" style="height: 100px;width: 100px">
                    </td>
                </tr>
            </table>
        </div>

        <!-- Blog End -->
    </Layouts>
</template>
