<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import Layouts from "@/Layouts/Layouts.vue";
import InputError from "@/Components/InputError.vue";
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const props = defineProps({
    user: Object,
});

const profileForm = useForm({
    name: props.user.name,
    email: props.user.email,
    phone: props.user.phone,
    profile_photo_path: null,
});

const getImageUrl = (imagePath) => {
    return `http://127.0.0.1:8000/${imagePath}`;
}

const updateUser = () => {
    profileForm.post(route('user.profile.update'), {
        preserveScroll: true,
        onSuccess: () => {
            toast("Profile Updated Successfully", {
                autoClose: 1000,
            });
            profileForm.reset('profile_photo_path');
        },
    });
};

// Function to handle file change and show preview
const handleFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        profileForm.profile_photo_path = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            document.getElementById('imagePreview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};
</script>

<template>
    <Layouts>
        <Head title="Package Booking" />

        <div class="d-flex flex-column align-items-center mt-4">
            <h3 class="display-4 text-dark text-uppercase">User Profile Edit</h3>
        </div>

        <div class="container-fluid py-3">
            <form @submit.prevent="updateUser" enctype="multipart/form-data">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="pb-3">
                                <div class="bg-white mb-3" style="padding: 30px;">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-3 mb-2">
                                            <div class="form-group">
                                                <label for="user_name">User Name</label>
                                                <div class="mb-3 mb-md-0">
                                                    <div class="date" id="date1" data-target-input="nearest">
                                                        <input type="text" class="form-control" v-model="profileForm.name">
                                                        <InputError :message="profileForm.errors.name" class="mt-2 text-danger" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-3 mb-2">
                                            <div class="form-group">
                                                <label for="user_email">User Email</label>
                                                <input type="email" class="form-control" v-model="profileForm.email" readonly>
                                                <InputError :message="profileForm.errors.email" class="mt-2 text-danger" />
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-3 mb-2">
                                            <div class="form-group">
                                                <label for="user_phone">User Phone</label>
                                                <input type="text" class="form-control" v-model="profileForm.phone">
                                                <InputError :message="profileForm.errors.phone" class="mt-2 text-danger" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-6 mb-2">
                                            <div class="form-group">
                                                <label for="profile_image">User Profile Image</label>
                                                <input type="file" class="form-control" @change="handleFileChange">
                                                <InputError :message="profileForm.errors.profile_photo_path" class="mt-2 text-danger" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-6 mb-2">
                                            <img :src="user.profile_photo_path ? getImageUrl(user.profile_photo_path) : getImageUrl('upload/def_profile.png')"
                                                 id="imagePreview"
                                                 alt="Profile Image"
                                                 class="img-fluid"
                                            style="height: 100px"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="button">
                                    <button type="submit" class="btn btn-dark">Update Profile</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </Layouts>
</template>
