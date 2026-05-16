<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Confirm Password" />

        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-6">

                    <div class="card shadow-sm">
                        <div class="card-body">

                            <!-- Info -->
                            <p class="text-muted small mb-4">
                                This is a secure area of the application. Please confirm your
                                password before continuing.
                            </p>

                            <!-- Form -->
                            <form @submit.prevent="submit">

                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">
                                        Password
                                    </label>

                                    <input
                                        id="password"
                                        type="password"
                                        class="form-control"
                                        v-model="form.password"
                                        required
                                        autocomplete="current-password"
                                        autofocus
                                    />

                                    <div v-if="form.errors.password" class="text-danger small mt-1">
                                        {{ form.errors.password }}
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="d-flex justify-content-end">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                        :disabled="form.processing"
                                    >
                                        Confirm
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
