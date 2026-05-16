<template>
    <Head title="Profile" />

    <ResultModal
        v-if="showModal"
        :result="result"
        @close="showModal = false"
    />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="h4 fw-semibold text-dark mb-0">
                Profile
            </h2>
        </template>

        <div class="py-5">
            <div class="container">
                <div class="card">
                    <table class="table">
                        <thead>
                            <th>Questionnaire Name</th>
                            <th>Rating</th>
                            <th>Score</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            <tr v-for="result in results">
                                <td>{{ result.questionnaire.Name }}</td>
                                <td>{{ result.questionnaire.rating }}</td>
                                <td>{{ result.score }}</td>
                                <td>{{ dateFormatter(result.created_at) }}</td>
                                <td>
                                    <button class="btn btn-primary"
                                        v-on:click="showResult(result.id)">
                                        Show
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, usePage} from '@inertiajs/vue3';
import {onBeforeMount, ref} from "vue";
import ResultModal from "@/Components/ResultModal.vue";

const page = usePage();
const user = page.props.auth.user;
const results = ref([]);
const result = ref();
const showModal = ref(false);


function getResults(id) {
    axios.get('/api/results/user/' + id)
        .then(function (response) {
            results.value = response.data;
        }).catch(function (error) {
        console.log(error);
    });
}

function showResult(id) {
    axios.get('/api/results/' + id)
        .then(function (response) {
            result.value = response.data;
            showModal.value = true;
            console.log(showModal.value);
        }).catch(function (error) {
        console.log(error);
    });
}

function dateFormatter(mytime) {
    const date = new Date(mytime);

    const options = {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false // Set to true for 12-hour format
    };

// 'en-GB' uses dd/mm/yyyy; we use replace to change / to -
    const formatted = new Intl.DateTimeFormat('en-GB', options).format(date);
    return formatted.replace(/\//g, '-').replace(',', '');
}

onBeforeMount(() => {
    getResults(user.id);
})
</script>
