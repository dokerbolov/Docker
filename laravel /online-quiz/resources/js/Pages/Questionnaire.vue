<template>
    <Head title="Questionnaire"/>

    <AuthenticatedLayout>
        <div class="container">
            <h3>{{ questionnaire.Name }}</h3>
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        {{ activeQuestion.Name }}
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li v-for="answer in activeQuestion.answers">
                                <input v-on:click="setQuestionAnswer(activeQuestion.id, answer.id)"
                                       :checked="activeQuestion.user_answer === answer.id"
                                       type="radio"
                                       id="{{ answer.id }}"
                                       name="size"
                                       value="s">
                                <label for="small">{{ answer.Name }}</label><br>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <button v-on:click="goPrevious" v-if="pointer !== 0">Previous</button>
                        <button v-on:click="goNext" v-if="pointer+1 !== sizeOfQuestionions">Next</button>
                        <button v-on:click="finishQuestionnaire" v-if="pointer+1 === sizeOfQuestionions">Finish</button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { ref, onBeforeMount } from 'vue';
import Swal from 'sweetalert2';

const page = usePage();
const user = page.props.auth.user;

const questionnaire = ref([]);
const activeQuestion = ref();
const pointer = ref(0);
const sizeOfQuestionions = ref(0);
const questionnaireState = ref([]);

function getQuestionnaire(id) {
    axios.get('/api/questionnaire/' + id)
        .then(function (response) {
            questionnaire.value = response.data;
            sizeOfQuestionions.value = questionnaire.value.questions.length; // Count of questions
            questionnaireState.value = questionnaire.value.questions;
            changeQuestion(0);
        }).catch(function (error) {
            questionnaire.value = [];
            console.log(error);
        });
}

function changeQuestion(pointer) {
    activeQuestion.value = questionnaire.value.questions[pointer];
}

function goNext() {
    pointer.value += 1;
    changeQuestion(pointer.value)
}

function goPrevious() {
    pointer.value -= 1;
    changeQuestion(pointer.value);
}

function finishQuestionnaire() {
    const answers = [];

    const params = {
        "user_id": user.id,
        "questionnaire_id": questionnaire.value.id,
        "answers": answers
    };
    questionnaireState.value.forEach(value => {
        const question = {
            "question_id": value.id,
            "answer_id": value.user_answer ?? 0
        }
        answers.push(question)
    })

    axios.post('/api/results/submit-questionnaire', { params })
        .then(function (response) {
            if(response.status === 200) {
                Swal.fire({
                    title: "Good job!",
                    text: "You finished the questionnaire!",
                    icon: "success",
                    showDenyButton: true,
                    confirmButtonColor: "#49d630",
                    confirmButtonText: "Show me results!",
                    denyButtonColor: "#305fd6",
                    denyButtonText: 'Rate the survey',
                }).then((result) => {
                    if(result.isConfirmed) {
                        watchResults();
                    } else if (result.isDenied) {
                        showRating(questionnaire.value.id);
                    } else {
                        watchQuestionnaires();
                    }
                });
            }
        }).catch(function (error) {
        questionnaire.value = [];
        console.log(error);
    });
}

function setQuestionAnswer(questionId, answerId) {
    const question = questionnaireState.value.find((question) => question.id === questionId)
    if (question) {
        question.user_answer = answerId;
    }
}

async function showRating(questionnaire_id) {
    const { value: rating } = await Swal.fire({
        title: 'Rate our questionnaire',
        icon: 'question',
        input: 'range',
        inputLabel: 'Your rating',
        inputAttributes: {
            min: 1,
            max: 5,
            step: 1
        },
        inputValue: 3 // Default value
    });
    if (rating) {
        Swal.fire({
            title: "Thank you!",
            text: "You rating is important for us!",
            icon: "success",
            confirmButtonColor: "#49d630",
            confirmButtonText: "Show me results!",
        }).then((result) => {
            if(result.isConfirmed) {
                rateTheSurvey(questionnaire_id, rating);
                watchResults();
            } else {
                watchQuestionnaires();
            }
        });
    }
}


function watchResults() {
    const url = window.location.origin;
    window.location.replace(url + '/profile/show');
}

function watchQuestionnaires() {
    const url = window.location.origin;
    window.location.replace(url + '/questionnaires');
}

function rateTheSurvey(questionnaire_id, rating) {
    axios.post('/api/questionnaire/rate', {
            questionnaire_id: questionnaire_id,
            rating: rating
        })
        .then(function (response) {
            console.log(response.data);
        });
}

onBeforeMount(() => {
    const segments = window.location.pathname.split('/').filter(Boolean)
    const id = segments[segments.length - 1]
    getQuestionnaire(id);
})

</script>

<style scoped>

</style>
