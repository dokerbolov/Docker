<template>
    <Head title="TestPage" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Admin panel
            </h2>
        </template>

        <div class="py-2">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <Link
                            :href="route('roles-and-permissions')"
                        >
                            <div class="text-gray-900">
                                <h1>
                                    Roles and Permissions
                                </h1>
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-2">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <Link
                            :href="route('admin-users')"
                        >
                            <div class="text-gray-900">
                                <h1>Users</h1>
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-2">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <Link
                            :href="route('test-redis')"
                        >
                            <div class="text-gray-900">
                                <h1>Redis</h1>
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue'
import axios from 'axios'

const movies = ref([])

const getData = async () => {
    const response = await axios.get('/api/test')
    console.log(response)
    movies.value = response.data
}

const changePage = async () => {
    window.href('/roles-and-permissions');
}

onMounted(() => {
    getData()
})
</script>
