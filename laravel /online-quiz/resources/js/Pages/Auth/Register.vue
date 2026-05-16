<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <h4 class="mb-1">Adventure starts here 🚀</h4>
        <p class="mb-6">Make your app management easy and fun!</p>

        <form id="formAuthentication" class="mb-6" @submit.prevent="submit">
            
            <!-- Name -->
            <div class="mb-6">
                <label for="name" class="form-label">Name</label>
                <input
                    type="text"
                    class="form-control"
                    id="name"
                    v-model="form.name"
                    placeholder="Enter your name"
                    autofocus
                    required />
                <div v-if="form.errors.name" class="invalid-feedback d-block mt-2">
                    {{ form.errors.name }}
                </div>
            </div>

            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="form-label">Email</label>
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    v-model="form.email"
                    placeholder="Enter your email"
                    required />
                <div v-if="form.errors.email" class="invalid-feedback d-block mt-2">
                    {{ form.errors.email }}
                </div>
            </div>

            <!-- Password -->
            <div class="mb-6 form-password-toggle">
                <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                    <input
                        type="password"
                        id="password"
                        class="form-control"
                        v-model="form.password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password"
                        required />
                    <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                </div>
                <div v-if="form.errors.password" class="invalid-feedback d-block mt-2">
                    {{ form.errors.password }}
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="mb-6 form-password-toggle">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <div class="input-group input-group-merge">
                    <input
                        type="password"
                        id="password_confirmation"
                        class="form-control"
                        v-model="form.password_confirmation"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password_confirmation"
                        required />
                    <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                </div>
                <div v-if="form.errors.password_confirmation" class="invalid-feedback d-block mt-2">
                    {{ form.errors.password_confirmation }}
                </div>
            </div>

            <button class="btn btn-primary d-grid w-100 mb-6" type="submit" :disabled="form.processing">
                Sign up
            </button>
        </form>

        <p class="text-center">
            <span>Already have an account?</span>
            <Link :href="route('login')">
                <span>Sign in instead</span>
            </Link>
        </p>

    </GuestLayout>
</template>
