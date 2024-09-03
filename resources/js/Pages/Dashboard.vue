<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import Layouts from "@/Layouts/Layouts.vue";
import {Head, Link} from "@inertiajs/vue3";

const getImageUrl = (imagePath) => {
    return `http://127.0.0.1:8000/${imagePath}`;
}

</script>

<template>
    <Layouts>
        <Head title="User Profile" />
        <div class="container">
            <div class="row mt-4">
                <div class="col-10">
                    <h3>User Information</h3>
                    <div class="row">
                        <div class="col-4">
                            <img :src="$page.props.auth.user.profile_photo_path ? getImageUrl($page.props.auth.user.profile_photo_path) : getImageUrl('upload/def_profile.png')"
                                 id="imagePreview"
                                 alt="Profile Image"
                                 class="img-fluid"
                                 style="height: 200px"/>
                        </div>
                        <div class="col-8">
                            <table class="table">
                                <tr>
                                    <td><b>Name</b></td>
                                    <td>{{ $page.props.auth.user.name }}</td>
                                </tr>

                                <tr>
                                    <td><b>Email</b></td>
                                    <td>{{ $page.props.auth.user.email }}</td>
                                </tr>

                                <tr>
                                    <td><b>Phone</b></td>
                                    <td>{{ $page.props.auth.user.phone }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-2 mt-3">
                    <Link :href="route('user.profile.edit')" class="btn btn-primary mt-2">Edit Profile</Link>
                    <Link :href="route('user.password.edit')" class="btn btn-primary mt-2">Change Password</Link>
                    <Link :href="route('user.booked.packages')" class="btn btn-primary mt-2">Booked Packages</Link>
                </div>
            </div>
        </div>
    </Layouts>
</template>
