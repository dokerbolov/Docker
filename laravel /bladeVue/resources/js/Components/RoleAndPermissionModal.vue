<template>
    <div class="fixed inset-0 z-50 flex items-center justify-center"
        v-show="show">

        <!-- Overlay -->
        <div
            class="absolute inset-0 bg-black bg-opacity-50"
            @click="closeModal"
        ></div>

        <!-- Modal -->
        <div class="relative bg-white w-full max-w-md mx-auto rounded-lg shadow-lg p-6 z-10">

            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">{{ role.id == null ? 'Create Role' : 'Change Role' }}</h2>
                <button
                    @click="closeModal"
                    class="text-gray-500 hover:text-gray-700 text-2xl"
                >
                    &times;
                </button>
            </div>

            <!-- Form -->
            <div class="space-y-4">

                <input type="hidden" name="id" v-model="role.id">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Name
                    </label>
                    <input
                        type="text"
                        name="name"
                        placeholder="Enter role name"
                        v-model="role.name"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Guard Name
                    </label>
                    <input
                        type="text"
                        name="guard_name"
                        placeholder="Enter guard name"
                        v-model="role.guard_name"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                    >
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-2 pt-4">
                    <button
                        type="button"
                        @click="closeModal"
                        class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600"
                        v-on:click="role.id == null ? createRole() : changeRole()"
                    >
                        Save
                    </button>
                </div>

            </div>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import {ref, watch} from "vue";

const props = defineProps({
    isModal: {
        type: Boolean,
        default: false,
    },
    role: {
        type: Object,
        default: ''
    },
});

const show = ref(props.isModal);
console.log('show after props', show);

function closeModal() {
    console.log('show before',show.value);
    show.value = false;
    console.log('show after',show.value);
}

watch(
    () => props.isModal,
    () => {
        show.value = props.isModal;
        if (show.value) {
            document.body.style.overflow = '';
        } else {
            document.body.style.overflow = 'hidden';
        }
    },
);


function createRole() {
    let params = {
        name: props.role.name,
    }

    axios.post('/api/role/create', params)
        .then(function (response) {
            if(response.status === 201) {
                Swal.fire({
                    title: "Created!",
                    text: "Successfully created!",
                    icon: "success"
                });

                getRoles();
            } else {
                Swal.fire({
                    title: "Error!",
                    text: "Something went wrong!",
                    icon: "error"
                });
            }
        })
        .catch(function (error) {
            console.log(error);
        });
}

function changeRole() {
    let params = {
        id: props.role.id,
        name: props.role.name
    }

    axios.post('/api/role/change', params)
        .then(function (response) {
            if(response.status === 200) {
                Swal.fire({
                    title: "Changed!",
                    text: "Successfully changed!",
                    icon: "success"
                });
            } else {
                Swal.fire({
                    title: "Error!",
                    text: "Something went wrong!",
                    icon: "error"
                });
            }
        })
        .catch(function (error) {
            console.log(error);
        });
}

</script>
