<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />

        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-6">

                    <div class="card shadow-sm">
                        <div class="card-body">

                            <!-- Info -->
                            <p class="text-muted small mb-3">
                                Forgot your password? No problem. Just enter your email
                                and we’ll send you a reset link.
                            </p>

                            <!-- Status Message -->
                            <div v-if="status" class="alert alert-success">
                                {{ status }}
                            </div>

                            <!-- Form -->
                            <form @submit.prevent="submit">

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
                                        autofocus
                                        autocomplete="username"
                                    />

                                    <div v-if="form.errors.email" class="text-danger small mt-1">
                                        {{ form.errors.email }}
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="d-flex justify-content-end">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                        :disabled="form.processing"
                                    >
                                        Email Password Reset Link
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </GuestLayout>
</template>
