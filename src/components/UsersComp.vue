<script setup>
    import { ref, onMounted } from 'vue';
    import UserForm from './UserForm.vue';
    import Button from 'primevue/button';
    import InputText from 'primevue/inputtext';
    import DataTable from 'primevue/datatable';
    import Column from 'primevue/column';
    import Toolbar from 'primevue/toolbar';
    import Axios from 'axios';

    onMounted(getUsers);

    let users = ref([]);
    let search = ref('');
    let userDialog = ref(false);
    let UserFormRef = ref(null);

    function getUsers() {
        search.value = '';
        Axios.get('http://localhost/EquipmentInventory/api/users/get-users.php')
            .then(function(response) {
                users.value = response.data;
            });
    }

    function searchUsers() {
        Axios.get('http://localhost/EquipmentInventory/api/users/search-users.php?search=' + search.value)
            .then(function(response) {
                users.value = response.data;
            });
    }

</script>

<template>
    <UserForm 
        ref="UserFormRef"
        @user-created="getUsers()"
        @user-updated="getUsers()"
        @user-deleted="getUsers()">
    </UserForm>

    <Toolbar class="mb-4">
        <template #start>
            <h3 class="m-0 mb-2 md:m-0">Manage Users</h3>
        </template>

        <template #end>
            <span class="p-input-icon-left mr-2">
                <i class="pi pi-search" />
                <InputText v-model="search" placeholder="Search..." @keydown.enter="searchUsers()" />
            </span>
            <Button label="New" icon="pi pi-plus" class="p-button-success mr-2" @click="UserFormRef.showCreate()" />
            <Button label="Refresh" icon="pi pi-refresh" @click="getUsers"/>
        </template>
    </Toolbar>
    
    <DataTable :value="users" responsiveLayout="scroll">
        <Column field="id" header="ID"></Column>
        <Column field="username" header="Username"></Column>
        <Column field="password" header="Password"></Column>
        <Column field="name" header="Name"></Column>
        <Column :exportable="false" style="min-width:8rem">

            <template #body="slotProps">
                <Button icon="pi pi-pencil" class="p-button-rounded mr-2" @click="UserFormRef.showUpdate(slotProps.data)" />
                <Button icon="pi pi-trash" class="p-button-rounded p-button-danger" @click="UserFormRef.showDelete(slotProps.data)" />
            </template>
        </Column>
    </DataTable>
</template>