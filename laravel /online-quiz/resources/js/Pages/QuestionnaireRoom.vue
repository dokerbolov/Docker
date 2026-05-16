<template>
    <Head title="Questionnaire"/>

    <AuthenticatedLayout>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-body text-center p-5">
                            <h2 class="fw-bold text-primary mb-3">
                                Welcome Quiz
                                <span class="text-dark">{{ questionnaire.Name }}</span>
                            </h2>
                                <h3 class="text-muted m-0">
                                    Link:
                                    <a :href="link" target="_blank" class="text-decoration-none">
                                        {{ link }}
                                    </a>
                                </h3>
                            <div class="display-4 fw-bold mb-4">
                                Online users of quiz:
                                <span class="text-success">{{ onlineUsersCount }}</span>
                            </div>
                            <QuestionnaireModal
                                v-if="survey_started"
                                :questionnaire-id="questionniare_id"
                                :user="user"
                                :room_id="id"
                                :onlineUsers="onlineUsers"
                            />
                            <div v-else>
                                <button
                                    class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm"
                                    v-on:click="start(id)"
                                >
                                    Start Questionnaire
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, usePage} from '@inertiajs/vue3';
import {ref, onBeforeMount, onMounted} from 'vue';
import Swal from 'sweetalert2';
import Questionnaire from "@/Pages/Questionnaire.vue";
import QuestionnaireModal from "@/Pages/QuestionnaireModal.vue";

const page = usePage();
const user = page.props.auth.user;

const questionnaire = ref({});
const onlineUsersCount = ref(0);
const onlineUsers = ref([]);
const survey_started = ref(false);
const id = ref(0);
const questionniare_id = ref(0);
const link = ref('');
const finishers = ref([]);

function getQuestionnaire(id) {
    axios.get('/api/questionnaire/' + id)
        .then(function (response) {
            questionnaire.value = response.data;
        }).catch(function (error) {
        questionnaire.value = [];
        console.log(error);
    });
}

function subscribeToRoom(id) {
    Echo.join(`questionnaire.${id}`)
        .here((users) => {
            users.forEach(function(item, index) {
                 item.finished = false;
            });
            onlineUsers.value = users;
            onlineUsersCount.value = users.length;
        })
        .joining((user) => {
            const exists = onlineUsers.value.find(
                u => u.id === user.id
            );
            if (!exists) {
                user.finished = false;
                onlineUsers.value.push(user);
            }
            onlineUsersCount.value =
                onlineUsers.value.length;
        })
        .leaving((user) => {
            onlineUsers.value =
                onlineUsers.value.filter(
                    u => u.id !== user.id
                );
            onlineUsersCount.value =
                onlineUsers.value.length;
        })
        .listen('.questionnaire.started', (e) => {
            console.log(e);
            survey_started.value = true;
        })
        .listen('.questionnaire.finished', (e) => {
            finishers.value.push(e.userId);
            recalculateUsers();
            isAllFinished();
        });
}

function start(room_id) {
    axios.post('/api/websocket/start-survey', {
        room_id: room_id,
    }).then(function (response) {
        console.log(response.data);
    });
}

function recalculateUsers() {
    onlineUsers.value.forEach(function(user, index) {
        console.log('user', user);
        const exists = finishers.value.find(
            f => f == user.id
        );
        if(exists) {
            user.finished = true;
        }
    });

    console.log('onlineUsers value', onlineUsers.value);
}

function isAllFinished() {
    let count = 0;
    onlineUsers.value.forEach(function (item, index) {
        if(item.finished == true) {
            count++;
        }
    })
    if(onlineUsers.value.length == count) {
        showResultPage();
    }
}

function showResultPage() {
    const url = window.location.origin;
    window.location.replace(url + '/results/room/' + id.value);
}

function getRoomData(room_id) {
    axios.post('/api/websocket/room-data', {
        room_id: room_id,
    }).then(function (response) {
        questionniare_id.value = response.data.questionnaire_id;
        getQuestionnaire(response.data.questionnaire_id);
    });
}

onBeforeMount(() => {
    link.value = window.location;
    const segments = window.location.pathname.split('/').filter(Boolean)
    id.value = segments[segments.length - 1]
    subscribeToRoom(id.value);
    getRoomData(id.value);
})

</script>

<style scoped>

</style>
