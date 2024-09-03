<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Layouts from "@/Layouts/Layouts.vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Layouts>
        <Head title="Log in" />

        <div class="container-fluid bg-registration py-5" style="margin: 90px 0;">
            <div class="container py-5">
                <div class="row align-items-center">
                    <div class="col-lg-7 mb-5 mb-lg-0">
                        <div class="mb-4">
                            <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Mega Offer</h6>
                            <h1 class="text-white"><span class="text-primary">30% OFF</span> For Honeymoon</h1>
                        </div>
                        <p class="text-white">Invidunt lorem justo sanctus clita. Erat lorem labore ea, justo dolor lorem ipsum ut sed eos,
                            ipsum et dolor kasd sit ea justo. Erat justo sed sed diam. Ea et erat ut sed diam sea ipsum est
                            dolor</p>
                        <ul class="list-inline text-white m-0">
                            <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Labore eos amet dolor amet diam</li>
                            <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Etsea et sit dolor amet ipsum</li>
                            <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Diam dolor diam elitripsum vero.</li>
                        </ul>
                    </div>
                    <div class="col-lg-5">
                        <div class="card border-0">
                            <div class="card-header bg-primary text-center p-4">
                                <h1 class="text-white m-0">Sign In</h1>
                            </div>
                            <div class="card-body rounded-bottom bg-white p-5">
                                <form @submit.prevent="submit">
                                    <div class="form-group">
                                        <TextInput
                                            id="email"
                                            v-model="form.email"
                                            type="email"
                                            class="form-control p-4"
                                            required
                                            placeholder="Your Email"
                                            autofocus
                                            autocomplete="username"
                                        />
                                        <InputError class="mt-2" :message="form.errors.email" />
                                    </div>
                                    <div class="form-group">
                                        <TextInput
                                            id="password"
                                            v-model="form.password"
                                            type="password"
                                            class="form-control p-4"
                                            required
                                            autocomplete="current-password"
                                            placeholder="Your Password"
                                        />
                                        <InputError class="mt-2" :message="form.errors.password" />
                                    </div>


                                    <div class="flex items-center justify-end mt-4">
                                        <PrimaryButton class="btn btn-primary btn-block py-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                            Sign In Now
                                        </PrimaryButton>

                                        <Link :href="route('register')" class="text-primary text-uppercase mt-3">
                                            Create New Account?
                                        </Link>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layouts>

</template>
