<script setup>
    import { ref, onMounted } from 'vue';
    import EmployeesForm from './EmployeesForm.vue';
    import Button from 'primevue/button';
    import InputText from 'primevue/inputtext';
    import DataTable from 'primevue/datatable';
    import InputSwitch from 'primevue/inputswitch';
    import Column from 'primevue/column';
    import Toolbar from 'primevue/toolbar';
    import Axios from 'axios';

    onMounted(getEmployees);

    let employee = ref([]);
    let search = ref('');
    let employeeDialog = ref(false);
    let EmployeesFormRef = ref(null);

    function getEmployees() {
        search.value = '';
        Axios.get('http://localhost/EquipmentInventory/api/employees/get-employees.php')
            .then(function(response) {
                employee.value = response.data;
            });
    }

    function searchEmployees() {
        Axios.get('http://localhost/EquipmentInventory/api/employees/search-employees.php?search=' + search.value)
            .then(function(response) {
                employee.value = response.data;
            });
    }

</script>

<template>
    <EmployeesForm 
        ref="EmployeesFormRef"
        @employee-created="getEmployees()"
        @employee-updated="getEmployees()"
        @employee-deleted="getEmployees()">
    </EmployeesForm>

    <Toolbar class="mb-4">
        <template #start>
            <h3 class="m-0 mb-2 md:m-0">EMPLOYEES</h3>
        </template>

        <template #end>
            <span class="p-input-icon-left mr-2">
                <i class="pi pi-search" />
                <InputText v-model="search" placeholder="Search..." @keydown.enter="searchEmployees()" />
            </span>
            <Button label="New" icon="pi pi-plus" class="p-button-success mr-2" @click="EmployeesFormRef.showCreate()" />
            <Button label="Refresh" icon="pi pi-refresh" @click="getEmployees"/>
        </template>
    </Toolbar>
    
    <DataTable :value="employee" responsiveLayout="scroll">
        <Column field="id" header="ID"></Column>
        <Column field="name" header="Name"></Column>
        <Column field="type" header="Employee Type"></Column>
        <Column field="office" header="Office"></Column>
        <Column field="active" header="Inactive/Active"></Column>
        <Column :exportable="false" style="min-width:8rem">

            <template #body="slotProps">
                <Button icon="pi pi-pencil" class="p-button-rounded mr-2" @click="EmployeesFormRef.showUpdate(slotProps.data)" />
                <Button icon="pi pi-trash" class="p-button-rounded p-button-danger" @click="EmployeesFormRef.showDelete(slotProps.data)" />
            </template>
        </Column>
    </DataTable>
</template>