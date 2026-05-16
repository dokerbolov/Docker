<script setup>
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <section>
        <!-- Header -->
        <div class="mb-4">
            <h5 class="fw-semibold text-dark">
                Profile Information
            </h5>

            <p class="text-muted small">
                Update your account's profile information and email address.
            </p>
        </div>

        <!-- Form -->
        <form @submit.prevent="form.patch(route('profile.update'))">

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">
                    Name
                </label>

                <input
                    id="name"
                    type="text"
                    class="form-control"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <div v-if="form.errors.name" class="text-danger small mt-1">
                    {{ form.errors.name }}
                </div>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">
                    Email
                </label>

                <input
                    id="email"
                    type="email"
                    class="form-control"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <div v-if="form.errors.email" class="text-danger small mt-1">
                    {{ form.errors.email }}
                </div>
            </div>

            <!-- Email Verification -->
            <div
                v-if="mustVerifyEmail && user.email_verified_at === null"
                class="mb-3"
            >
                <div class="alert alert-warning py-2">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="btn btn-link p-0 ms-2 align-baseline"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </div>

                <div
                    v-if="status === 'verification-link-sent'"
                    class="alert alert-success py-2"
                >
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <!-- Actions -->
            <div class="d-flex align-items-center gap-3">
                <button
                    type="submit"
                    class="btn btn-primary"
                    :disabled="form.processing"
                >
                    Save
                </button>

                <span
                    v-if="form.recentlySuccessful"
                    class="text-success small"
                >
                    Saved.
                </span>
            </div>

        </form>
    </section>
</template>
