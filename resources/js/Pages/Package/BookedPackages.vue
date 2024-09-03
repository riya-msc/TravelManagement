<script setup>

import Layouts from "@/Layouts/Layouts.vue";
import {Head,Link} from "@inertiajs/vue3";
import BookingFrom from "@/Components/Frontend/BookingFrom.vue";

const props = defineProps({
    bookedPackages : Object
});

</script>

<template>
    <Layouts>
        <Head title="Packages" />
        <!-- Header Start -->
        <div class="container-fluid page-header">

        </div>
        <!-- Header End -->


        <!-- Packages Start -->
        <div class="container-fluid py-5">
            <div class="container pt-5 pb-3">
                <div class="text-center mb-3 pb-3">
                    <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Packages</h6>
                    <h1>Booked Packages</h1>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <td><b>Package Code</b></td>
                        <td><b>Package Name</b></td>
                        <td><b>Total Price</b></td>
                        <td><b>Due Amount</b></td>
                        <td><b>Journey Date</b></td>
                        <td><b>Booking Status</b></td>
                        <td><b>Action</b></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="bookedPackage in bookedPackages">
                        <td>{{ bookedPackage.package.package_code }}</td>
                        <td>{{ bookedPackage.package.package_name }}</td>
                        <td>{{ bookedPackage.total_amount }}</td>
                        <td>{{ bookedPackage.due_amount }}</td>
                        <td>{{ bookedPackage.journey_date }}</td>
                        <td v-if="bookedPackage.booking_status == 0">
                            <span class="badge bg-warning">Pending</span>
                        </td>

                        <td v-else-if="bookedPackage.booking_status == 1">
                            <span class="badge bg-success text-white">Approved</span>
                        </td>

                        <td v-else>
                            <span class="badge bg-danger text-white">Canceled</span>
                        </td>

                        <td>
                            <Link :href="route('view.booked.package',{ packageBooking : bookedPackage.id })" class="btn btn-primary">View</Link>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Packages End -->
    </Layouts>
</template>
