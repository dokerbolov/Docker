<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(
    () => props.status === 'verification-link-sent',
);
</script>

<template>
    <GuestLayout>
        <Head title="Email Verification" />

        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body">

                            <p class="mb-3 text-secondary">
                                Thanks for signing up! Before getting started, could you verify your
                                email address by clicking on the link we just emailed to you? If you
                                didn't receive the email, we will gladly send you another.
                            </p>

                            <div v-if="verificationLinkSent" class="mb-3 text-success">
                                A new verification link has been sent to the email address you
                                provided during registration.
                            </div>

                            <form @submit.prevent="submit" class="d-flex justify-content-between align-items-center">

                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                    :disabled="form.processing"
                                >
                                    Resend Verification Email
                                </button>

                                <Link
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                    class="btn btn-link text-decoration-underline"
                                >
                                    Log Out
                                </Link>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </GuestLayout>
</template>
