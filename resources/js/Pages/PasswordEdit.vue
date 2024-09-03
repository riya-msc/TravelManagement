<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import Layouts from "@/Layouts/Layouts.vue";
import InputError from "@/Components/InputError.vue";
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const passwordForm = useForm({
    password: '',
});


const updateUserPassword = () => {
    passwordForm.post(route('user.password.update'), {
        preserveScroll: true,
        onSuccess: () => {
            toast("Password Updated Successfully", {
                autoClose: 1000,
            });
            passwordForm.reset();
        },
    });
};
</script>

<template>
    <Layouts>
        <Head title="Package Booking" />

        <div class="d-flex flex-column align-items-center mt-4">
            <h3 class="display-4 text-dark text-uppercase">User Password Edit</h3>
        </div>

        <div class="container-fluid py-3">
            <form @submit.prevent="updateUserPassword">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="pb-3">
                                <div class="bg-white mb-3" style="padding: 30px;">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-3 mb-2">
                                            <div class="form-group">
                                                <label for="user_name">Change Password</label>
                                                <div class="mb-3 mb-md-0">
                                                    <div class="date" id="date1" data-target-input="nearest">
                                                        <input type="password" class="form-control" v-model="passwordForm.password">
                                                        <InputError :message="passwordForm.errors.password" class="mt-2 text-danger" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="button">
                                    <button type="submit" class="btn btn-dark">Update Password</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </Layouts>
</template>
