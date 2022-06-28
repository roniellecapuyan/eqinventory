<script setup>
    import InputText from 'primevue/inputtext';
    import Dropdown from 'primevue/dropdown';
    import Textarea from 'primevue/textarea';
    import Button from 'primevue/button';
    import InputSwitch from 'primevue/inputswitch';
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
        'employee-created',
        'employee-updated',
        'employee-deleted',
    ]);

    let employeeDialog = ref(false);
    let deleteDialog = ref(false);
    let employee = ref({});
    let type = ['DIPLOMA PROGRAM TEACHER', 'QUALIFICATION TRAINER', 'SUPPORT STAFF']

    function showCreate() {
        employeeDialog.value = true;
        employee.value = {
            name: null,
            types: null,
            office: null,
            active: null
        };
    }

    function showUpdate(selectedEmployee) {
        employeeDialog.value = true;
        employee.value = selectedEmployee;
    }

    function showDelete(selectedEmployee) {
        deleteDialog.value = true;
        employee.value = selectedEmployee;
    }

    function hideDialogs() {
        employeeDialog.value = false;
        deleteDialog.value = false;
    }

    function saveEmployee() {
        // NO EMPLOYEE ID means... CREATE!
        if(!employee.value.id) {
            Axios.post('http://localhost/EquipmentInventory/api/employees/create-employee.php', employee.value)
                .then(function(response) {
                    hideDialogs();
                    emit('employee-created');
                });
        }
        
        // HAVE EMPLOYEE.ID means... UPDATE!
        else if(employee.value.id) {
            Axios.post('http://localhost/EquipmentInventory/api/employees/update-employee.php', employee.value)
                .then(function() {
                    hideDialogs();v
                    emit('employee-updated');
                });
        }
    }

    function deleteEmployee() {
        if(employee.value.id) {
            Axios.post('http://localhost/EquipmentInventory/api/employees/delete-employee.php', employee.value)
                .then(function(response) {
                    hideDialogs();
                    emit('employee-deleted');
                });
        }
    }
</script>

<template>
    <Dialog :style="{width: '300px'}" v-model:visible="deleteDialog">
        <template #header>
            <h3>Delete Employee?</h3>
        </template>
        
        <p>Are you sure?</p>

        <template #footer>
            <Button label="No" icon="pi pi-times" class="p-button-text" @click="hideDialogs()" autofocus />
            <Button label="Yes" icon="pi pi-check"  @click="deleteEmployee()"/>
        </template>
    </Dialog>

    <Dialog v-model:visible="employeeDialog" :style="{width: '450px'}"  header="Employee Details" :modal="true" class="p-fluid" required>
        <form @submit.prevent="saveEmployee()">
        <div class="field">
            <label for="name">Name</label>
            <InputText id="name" v-model="employee.name" required="true" autofocus />
        </div>
        <div class="field">
            <label for="type">Employee Type</label>
            <Dropdown v-model="employee.type" placeholder="SELECT EMPLOYEE TYPE" :options="type"></Dropdown>
        </div>
        <div class="field">
            <label for="office">Office</label>
            <InputText id="office" v-model="employee.office" required="true"/>
        </div>
        <div class="field">
            <label for="active">Inactive/Active</label>
            <br>
            <InputSwitch v-model="employee.active"/>
        </div>

            <Button label="Cancel" icon="pi pi-times" class="p-button-text" @click="hideDialogs()"/>
            <Button label="Save" icon="pi pi-check" type="submit"/>
        </form>
    </Dialog>

</template>