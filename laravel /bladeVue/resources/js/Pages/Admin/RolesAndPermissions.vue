<template>
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Roles and Permissions
            </h2>
        </template>

        <div class="py-4">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <button type="button" class="bg-green-500 hover:bg-green-700
                                             text-white font-bold py-2 px-4 rounded"
                v-on:click="openModal">Create</button>
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
                                <th>Guard_name</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                <tr v-for="role in roles.data">
                                    <td>{{ role.name }}</td>
                                    <td>{{ role.guard_name }}</td>
                                    <td>
                                        <button
                                            v-on:click="openModal(role)"
                                            class="bg-orange-500 hover:bg-orange-700
                                            text-white font-bold py-2 px-4 rounded">
                                            Change
                                        </button>
                                        <button
                                            v-on:click="deleteRole(role.id)"
                                            type="button"
                                            class="bg-red-500 hover:bg-red-700
                                                    text-white font-bold py-2 px-4 rounded">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <td>
                                <button v-on:click="paginate('left')">Left</button>
                            </td>
                            <td>{{ roles.current_page }}</td>
                            <td>
                                <button v-on:click="paginate('right')">Right</button>
                            </td>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <RoleAndPermissionModal
            :isModal="isModal"
            :role="role"
        ></RoleAndPermissionModal>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref, onMounted } from 'vue'
import axios from 'axios'
import RoleAndPermissionModal from "@/Components/RoleAndPermissionModal.vue";

const roles = ref([])
const isModal = ref(false);
const role = ref({
    id: null,
    name: null,
    guard_name: null
})

function getRoles(page = 1) {
    let params = {
        page: page
    };

    axios.get('/api/role', { params: params }).then(function (response) {
        roles.value = [];
        roles.value = response.data
    })
}

function paginate(chosenSide) {
    var number;
    if(chosenSide === 'left') {
        number = roles.value.current_page - 1;
        if(number <= 0) {
            number = roles.value.current_page;
        }
    } else {
        number = roles.value.current_page + 1;
        if(roles.value.to === roles.value.total) {
            number = roles.value.current_page;
        }
    }

    getRoles(number);
}

function openModal(existedRole = null) {
    isModal.value = true;
    role.value.id = existedRole.id;
    role.value.name = existedRole.name;
    role.value.guard_name = existedRole.guard_name;
}

function deleteRole(id) {
    let params = {
        id: id
    }
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            axios.post('/api/role/delete', params)
                .then( function(response) {
                    if(response.data === 1) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Successfully deleted!",
                            icon: "success"
                        });
                        getRoles();
                    } else {
                        alert('something went wrong');
                    };
                })
                .catch(function (error) {
                    console.log(error);
                });;
        }
    });

}

onMounted(() => {
    getRoles();
})
</script>

<style scoped>

</style>
