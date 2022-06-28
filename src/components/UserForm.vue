<script setup>
    import InputText from 'primevue/inputtext';
    import Dropdown from 'primevue/dropdown';
    import Textarea from 'primevue/textarea';
    import Button from 'primevue/button';
    import RadioButton from 'primevue/radiobutton';
    import InputNumber from 'primevue/inputnumber';
    import Dialog from 'primevue/dialog';

    import Axios from 'axios';
    import { ref } from 'vue';

    defineExpose({
        showCreate,
        showUpdate,
        showDelete,
    });
    let emit = defineEmits([
        'user-created',
        'user-update',
        'user-deleted',
    ]);

    let userDialog = ref(false);
    let deleteDialog = ref(false);
    let user = ref({});

    function showCreate() {
        userDialog.value = true;
        user.value = {
            name: null,
            username: null,
            password: null
        };
    }

    function showUpdate(selectedUser) {
        userDialog.value = true;
        user.value = selectedUser;
    }

    function showDelete(selectedUser) {
        deleteDialog.value = true;
        user.value = selectedUser;
    }

    function hideDialogs() {
        userDialog.value = false;
        deleteDialog.value = false;
    }

    function saveUser() {
        // NO USER ID means... CREATE!
        if(!user.value.id) {
            Axios.post('http://localhost/EquipmentInventory/api/users/create-user.php', user.value)
                .then(function(response) {
                    hideDialogs();
                    emit('user-created');
                });
        }
        
        // HAVE USER.ID means... UPDATE!
        else if(user.value.id) {
            Axios.post('http://localhost/EquipmentInventory/api/users/update-user.php', user.value)
                .then(function() {
                    hideDialogs();
                    emit('user-updated');
                });
        }
    }

    function deleteUser() {
        if(user.value.id) {
            Axios.post('http://localhost/EquipmentInventory/api/users/delete-user.php', user.value)
                .then(function(response) {
                    hideDialogs();
                    emit('user-deleted');
                });
        }
    }
</script>

<template>
    <Dialog :style="{width: '300px'}" v-model:visible="deleteDialog">
        <template #header>
            <h3>Delete User?</h3>
        </template>
        
        <p>Are you sure?</p>

        <template #footer>
            <Button label="No" icon="pi pi-times" class="p-button-text" @click="hideDialogs()" autofocus />
            <Button label="Yes" icon="pi pi-check"  @click="deleteUser()"/>
        </template>
    </Dialog>

    <Dialog v-model:visible="userDialog" :style="{width: '450px'}"  header="User Details" :modal="true" class="p-fluid">
        <div class="field">
            <label for="username">Username</label>
            <InputText id="username" v-model="user.username" required="true" autofocus />
        </div>
        <div class="field">
            <label for="password">Password</label>
            <InputText id="password" v-model="user.password" required="true"/>
        </div>
        <div class="field">
            <label for="name">Name</label>
            <InputText id="name" v-model="user.name" required="true"/>
        </div>

        <template #footer>
            <Button label="Cancel" icon="pi pi-times" class="p-button-text" @click="hideDialogs()"/>
            <Button label="Save" icon="pi pi-check" @click="saveUser()" />
        </template>
    </Dialog>

</template>