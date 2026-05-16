<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="h4 fw-semibold text-dark mb-0">
                Profile
            </h2>
        </template>

        <div class="py-5">
            <div class="container">

                <!-- Update Profile Info -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="col-lg-6">
                            <UpdateProfileInformationForm
                                :must-verify-email="mustVerifyEmail"
                                :status="status"
                            />
                        </div>
                    </div>
                </div>

                <!-- Update Password -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="col-lg-6">
                            <UpdatePasswordForm />
                        </div>
                    </div>
                </div>

                <!-- Delete User -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="col-lg-6">
                            <DeleteUserForm />
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
