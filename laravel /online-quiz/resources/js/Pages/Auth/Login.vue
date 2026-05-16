<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

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
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <h4 class="mb-1">Welcome to Sneat! 👋</h4>
        <p class="mb-6">Please sign-in to your account and start the adventure</p>

        <!-- Status Message -->
        <div v-if="status" class="alert alert-success">
            {{ status }}
        </div>

        <form id="formAuthentication" class="mb-6" @submit.prevent="submit">
            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="form-label">Email</label>
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    v-model="form.email"
                    placeholder="Enter your email"
                    autofocus
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

            <!-- Remember Me & Forgot Password -->
            <div class="mb-8">
                <div class="d-flex justify-content-between">
                    <div class="form-check mb-0">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="remember_me"
                            v-model="form.remember" />
                        <label class="form-check-label" for="remember_me"> Remember Me </label>
                    </div>
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                    >
                        <span>Forgot Password?</span>
                    </Link>
                </div>
            </div>

            <div class="mb-6">
                <button class="btn btn-primary d-grid w-100" type="submit" :disabled="form.processing">Log in</button>
            </div>
        </form>

        <p class="text-center">
            <span>New on our platform?</span>
            <Link :href="route('register')">
                <span>Create an account</span>
            </Link>
        </p>

    </GuestLayout>
</template>
