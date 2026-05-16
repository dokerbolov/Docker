<template>
    <Head title="Questionnaires" />

    <AuthenticatedLayout>
        <div class="row">
            <div class="col-2" v-for="questionnaire in questionnaires">
                <div class="card m-2 p-2">
                    <div class="card-title">
                        {{ questionnaire.Name }}
                    </div>
                    <div class="card-body">
                        Questions count: {{ (questionnaire.questions).length }}
                        Rating: {{ questionnaire.rating }}
                    </div>
                    <div class="card-footer">
                        <button
                            v-on:click="startQuestionnaire(questionnaire.id)"
                            class="btn btn-success m -2">
                            Start
                        </button>
                        <button
                            v-on:click="createRoom(questionnaire.id)"
                            class="btn btn-primary mt-2">
                            Play with friends
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue'

const page = usePage();
const user = page.props.auth.user;

const questionnaires = ref([]);

function getQuestionnaires() {
    axios.get('api/questionnaire')
        .then(function (response) {
            questionnaires.value = response.data;
            console.log(questionnaires.value);
        }).catch(function (error) {
            questionnaires.value = [];
            console.log(error);
        });
}

function startQuestionnaire(id) {
    const url = window.location.origin;
    window.location.replace(url + '/questionnaire/' + id);
}

function joinRoom(id) {
    const url = window.location.origin;
    window.location.replace(url + '/questionnaire/room/' + id);
}

function createRoom(id) {
    axios.post('/api/websocket/create-room', {
        questionnaire_id: id,
        user_id: user.id
    }).then((result) => {
        console.log(result.data);
        joinRoom(result.data)
    }).catch((error) => {
        console.log(error);
    })
}

onMounted(() => {
    getQuestionnaires();
})

</script>

<style scoped>

</style>
