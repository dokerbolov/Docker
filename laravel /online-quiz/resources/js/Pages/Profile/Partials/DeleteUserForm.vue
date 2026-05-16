<script setup>
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;
    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;
    form.clearErrors();
    form.reset();
};
</script>

<template>
    <section class="mb-4">
        <!-- Header -->
        <div class="mb-3">
            <h5 class="fw-semibold text-dark">
                Delete Account
            </h5>

            <p class="text-muted small">
                Once your account is deleted, all data will be permanently removed.
                Please download anything you need before proceeding.
            </p>
        </div>

        <!-- Delete Button -->
        <button class="btn btn-danger" @click="confirmUserDeletion">
            Delete Account
        </button>

        <!-- Modal -->
        <div
            class="modal fade"
            tabindex="-1"
            :class="{ show: confirmingUserDeletion }"
            style="display: block;"
            v-if="confirmingUserDeletion"
        >
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Header -->
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Confirm Account Deletion
                        </h5>
                        <button type="button" class="btn-close" @click="closeModal"></button>
                    </div>

                    <!-- Body -->
                    <div class="modal-body">
                        <p class="text-muted">
                            Please enter your password to confirm account deletion.
                        </p>

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                Password
                            </label>

                            <input
                                id="password"
                                ref="passwordInput"
                                v-model="form.password"
                                type="password"
                                class="form-control"
                                placeholder="Password"
                                @keyup.enter="deleteUser"
                            />

                            <div v-if="form.errors.password" class="text-danger small mt-1">
                                {{ form.errors.password }}
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="modal-footer">
                        <button class="btn btn-secondary" @click="closeModal">
                            Cancel
                        </button>

                        <button
                            class="btn btn-danger"
                            :disabled="form.processing"
                            @click="deleteUser"
                        >
                            Delete Account
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Backdrop -->
        <div
            v-if="confirmingUserDeletion"
            class="modal-backdrop fade show"
        ></div>
    </section>
</template>
