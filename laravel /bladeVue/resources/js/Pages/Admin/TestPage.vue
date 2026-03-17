<template>
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Test REDIS
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
                      <input v-model="name" type="text" name="data"/>
                        <button
                            v-on:click="saveData(name)"
                            class="bg-green-500 hover:bg-green-700
                                            text-white font-bold py-2 px-4 rounded">
                            Save
                        </button>
                        <button
                            v-on:click="getData()"
                            class="bg-green-500 hover:bg-green-700
                                            text-white font-bold py-2 px-4 rounded">
                            get
                        </button>
                        <button
                            v-on:click="deleteData()"
                            class="bg-green-500 hover:bg-green-700
                                            text-white font-bold py-2 px-4 rounded">
                            delete
                        </button>
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
const name = ref('');

function getData() {
    const response = axios.get('/api/redis/get')
    console.log(response);
    // users.value = response.data
}

function saveData(text) {
    console.log(text);
    axios.post('/api/redis/create', {text: text})
        .then(function(response) {
            // if(response.status === 200) {
            //     window.location.reload();
            // }
        }).catch(function (error) {
        console.log(error);
    })
}

function deleteData() {
    axios.post('/api/redis/delete')
        .then(function(response) {
           console.log(response);
        }).catch(function(error) {
            console.log(error);
    });
}

onMounted(() => {
})

</script>

