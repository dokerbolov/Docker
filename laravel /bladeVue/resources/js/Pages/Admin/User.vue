<template>
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Users
            </h2>
        </template>

        <div class="py-4">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            </div>
        </div>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <table class="table-auto">
                            <thead>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created_at</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                            <tr v-for="user in users">
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.created_at }}</td>
                                <td>
                                    <span v-on:click="authorize">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-black" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg"
                                             width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/>
                                        </svg>
                                    </span>

<!--                                    <button-->
<!--                                        v-on:click="openModal(role)"-->
<!--                                        class="bg-orange-500 hover:bg-orange-700-->
<!--                                                text-white font-bold py-2 px-4 rounded">-->
<!--                                        Change-->
<!--                                    </button>-->
                                    <div v-if="user.deleted_at !== null">
                                        <button
                                            v-on:click="userRestore(user.id)"
                                            type="button"
                                            class="bg-yellow-500 hover:bg-yellow-700
                                                        text-white font-bold py-2 px-4 rounded">Restore</button>
                                    </div>
                                    <div v-else>
                                        <button
                                            v-on:click="userDelete(user.id)"
                                            type="button"
                                            class="bg-red-500 hover:bg-red-700
                                                        text-white font-bold py-2 px-4 rounded">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref, onMounted } from 'vue'
import axios from 'axios'

const users = ref([])

const getUsers = async () => {
    const response = await axios.get('/api/users')
    users.value = response.data
}

function authorize(id) {
    axios.post('/api/users/auth', {id: id})
        .then(function(response) {
            if(response.status === 200) {
                window.location.reload();
            }
        }).catch(function (error) {
            console.log(error);
        })
}

function userDelete(id) {
    axios.post('/api/users/delete', {id: id})
        .then(function (response) {
            if(response.status === 200) {
                window.location.reload();
            }
        }).catch(function (error) {
            console.log(error)
    });
}

function userRestore(id) {
    axios.post('/api/users/restore', {id: id})
        .then(function (response) {
            if(response.status === 200) {
                window.location.reload();
            }
        }).catch(function (error) {
        console.log(error)
    });
}

onMounted(() => {
    getUsers();
})

</script>

