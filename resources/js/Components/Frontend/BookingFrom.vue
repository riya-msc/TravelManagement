<script setup>
import { onMounted, ref } from "vue";
import { toast } from "vue3-toastify";
import flatpickr from "flatpickr";  // Example with flatpickr date picker
import "flatpickr/dist/flatpickr.css";

const destinations = ref([]);

const fetchDestinations = async () => {
    try {
        const response = await fetch(route('fetch.destinations'));
        if (!response.ok) {
            throw new Error("Failed to fetch destinations.");
        }
        const data = await response.json();
        console.log(data)
        destinations.value = data;
    } catch (error) {
        console.error("Error fetching destinations:", error);
        toast.error("Failed to fetch destinations. Please try again later.");
    }
};

onMounted(() => {
    fetchDestinations();

    // Initialize flatpickr
    flatpickr("#start_date", {
        onChange: (selectedDates, dateStr) => {
            searchForm.start_date = dateStr;  // Update the Vue state when date is picked
        },
    });

    flatpickr("#return_date", {
        onChange: (selectedDates, dateStr) => {
            searchForm.return_date = dateStr;  // Update the Vue state when date is picked
        },
    });
});

const searchForm = ref({
    destination: '',
    start_date: '',
    return_date: '',
});

const searchTour = async () => {
    const query = new URLSearchParams({
        destination: searchForm.value.destination,
        start_date: searchForm.value.start_date,
        return_date: searchForm.value.return_date,
    }).toString();

    try {
        window.location.href = `${route('package')}?${query}`;
    } catch (error) {
        console.error("Error during search:", error);
        toast.error("Failed to search. Please check your inputs.");
    }
};
</script>

<template>
    <div class="container-fluid booking mt-5 pb-5">
        <div class="container pb-5">
            <div class="bg-light shadow" style="padding: 30px;">
                <form class="form" @submit.prevent="searchTour">
                    <div class="row align-items-center" style="min-height: 60px;">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3 mb-md-0">
                                        <label>Select Destination</label>
                                        <select class="custom-select px-4" style="height: 47px;" v-model="searchForm.destination">
                                            <option value="" disabled>Select Destination</option>
                                            <option v-for="destination in destinations" :key="destination.name"
                                                    :value="destination.name">
                                                {{ destination.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3 mb-md-0">
                                        <label>Depart Date</label>
                                        <input type="text" id="start_date" class="form-control p-4"
                                               v-model="searchForm.start_date" placeholder=""/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3 mb-md-0">
                                        <label>Return Date</label>
                                        <input type="text" id="return_date" class="form-control p-4"
                                               v-model="searchForm.return_date" placeholder=""/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-block" style="margin-top: 35px;">Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
