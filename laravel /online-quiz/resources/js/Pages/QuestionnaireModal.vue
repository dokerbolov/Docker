<template>
    <div class="questionnaire-overlay">
        <!-- Online users card -->
        <div class="online-users-card card shadow border-0">
            <div class="card-body text-center">
                <h6 class="text-muted mb-1">
                    Active Users
                </h6>
                <h6 class="fw-bold mb-0">
                    <ul>
                        <li
                            v-for="user in onlineUsers"
                            :key="user.id"
                            :class="user.finished ? 'text-success' : 'text-dark'"
                        >
                            {{ user.name }}
                        </li>
                    </ul>
                </h6>
            </div>
        </div>
        <div v-if="!isFinished" class="questionnaire-modal">
            <h3 class="mb-4 text-center">
                {{ questionnaire.Name }}
            </h3>
            <div v-if="activeQuestion">
                <div class="card shadow-sm border-0">
                    <div class="card-header fw-bold text-center">
                        {{ activeQuestion.Name }}
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li
                                v-for="answer in activeQuestion.answers"
                                :key="answer.id"
                                class="mb-3"
                            >
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        :checked="activeQuestion.user_answer === answer.id"
                                        @click="setQuestionAnswer(activeQuestion.id, answer.id)"
                                    />
                                    <label class="form-check-label">
                                        {{ answer.Name }}
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <button
                            class="btn btn-outline-secondary"
                            @click="goPrevious"
                            v-if="pointer !== 0"
                        >
                            Previous
                        </button>
                        <button
                            class="btn btn-primary ms-auto"
                            @click="goNext"
                            v-if="pointer + 1 !== sizeOfQuestionions"
                        >
                            Next
                        </button>
                        <button
                            class="btn btn-success ms-auto"
                            @click="finishQuestionnaire"
                            v-if="pointer + 1 === sizeOfQuestionions"
                        >
                            Finish
                        </button>
                    </div>
                </div>
            </div>
            <div v-else class="text-center">
                Loading questionnaire...
            </div>
        </div>
        <div v-else class="questionnaire-modal text-center">
            <h2>Finished</h2>
        </div>
    </div>
</template>

<script setup>
import {ref, onMounted} from 'vue';
import Swal from 'sweetalert2';

const props = defineProps({
    questionnaireId: Number,
    room_id: Number,
    onlineUsers: Array,
    user: Object,
});

const questionnaire = ref({});
const activeQuestion = ref(null);
const pointer = ref(0);
const sizeOfQuestionions = ref(0);
const questionnaireState = ref([]);
const isFinished = ref(false);

function getQuestionnaire(id) {

    axios.get('/api/questionnaire/' + id)

        .then((response) => {

            console.log(response.data);

            questionnaire.value = response.data ?? {};

            questionnaireState.value =
                questionnaire.value.questions ?? [];

            sizeOfQuestionions.value =
                questionnaireState.value.length;

            if (sizeOfQuestionions.value > 0) {
                changeQuestion(0);
            }

        })

        .catch((error) => {

            console.error(error);

            Swal.fire({
                title: 'Error',
                text: 'Failed to load questionnaire',
                icon: 'error'
            });

        });
}

function changeQuestion(pointerValue) {

    activeQuestion.value =
        questionnaireState.value[pointerValue] ?? null;
}

function goNext() {

    if (pointer.value + 1 < sizeOfQuestionions.value) {

        pointer.value++;

        changeQuestion(pointer.value);
    }
}

function goPrevious() {

    if (pointer.value > 0) {

        pointer.value--;

        changeQuestion(pointer.value);
    }
}

function setQuestionAnswer(questionId, answerId) {

    const question =
        questionnaireState.value.find(
            q => q.id === questionId
        );

    if (question) {

        question.user_answer = answerId;
    }
}

function finishQuestionnaire() {

    if (!props.user?.id) {

        Swal.fire({
            title: 'Error',
            text: 'User not found',
            icon: 'error'
        });

        return;
    }

    const answers = [];

    questionnaireState.value.forEach((value) => {

        answers.push({
            question_id: value.id,
            answer_id: value.user_answer ?? 0
        });

    });

    axios.post('/api/results/submit-questionnaire-room', {
        user_id: props.user.id,
        questionnaire_id: questionnaire.value.id,
        room_id: props.room_id,
        answers
    })

        .then(() => {
            isFinished.value = true;
        })

        .catch((error) => {

            console.error(error);

            Swal.fire({
                title: 'Error',
                text: 'Failed to submit questionnaire',
                icon: 'error'
            });

        });
}

onMounted(() => {
    if (props.questionnaireId) {

        getQuestionnaire(props.questionnaireId);
    }
});


</script>

<style scoped>
.questionnaire-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.questionnaire-modal {
    background: white;
    width: 700px;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,.2);
}

/* Top-right floating users card */
.online-users-card {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 180px;
    border-radius: 14px;
    z-index: 10000;
}

.card {
    margin-top: 20px;
}
</style>
