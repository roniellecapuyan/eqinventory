<script setup>
    import { ref, onMounted } from 'vue';
    import ReportsForm from './ReportsForm.vue';
    import Button from 'primevue/button';
    import InputText from 'primevue/inputtext';
    import DataTable from 'primevue/datatable';
    import Column from 'primevue/column';
    import Toolbar from 'primevue/toolbar';
    import Axios from 'axios';

    onMounted(getReports);

    let reports = ref([]);
    let search = ref('');
    let reportsDialog = ref(false);
    let ReportsFormRef = ref(null);

    function getReports() {
        search.value = '';
        Axios.get('http://localhost/EquipmentInventory/api/reports/get-reports.php')
            .then(function(response) {
                reports.value = response.data;
            });
    }

    function searchReports() {
        Axios.get('http://localhost/EquipmentInventory/api/reports/search-reports.php?search=' + search.value)
            .then(function(response) {
                reports.value = response.data;
            });
    }

</script>

<template>
    <ReportsForm 
        ref="ReportsFormRef"
        @report-created="getReports()"
        @report-updated="getReports()"
        @report-deleted="getReports()">
    </ReportsForm>

    <Toolbar class="mb-4">
        <template #start>
            <h3 class="m-0 mb-2 md:m-0">Manage Report</h3>
        </template>

        <template #end>
            <span class="p-input-icon-left mr-2">
                <i class="pi pi-search" />
                <InputText v-model="search" placeholder="Search..." @keydown.enter="searchReports()" />
            </span>
            <Button label="New" icon="pi pi-plus" class="p-button-success mr-2" @click="ReportsFormRef.showCreate()" />
            <Button label="Refresh" icon="pi pi-refresh" @click="getReports"/>
        </template>
    </Toolbar>
    
    <DataTable :value="reports" responsiveLayout="scroll">
        <Column field="id" header="ID"></Column>
        <Column field="item_type" header="Type of Item"></Column>
        <Column field="article" header="Article"></Column>
        <Column field="description" header="Description"></Column>
        <Column field="unit" header="Unit of Measure"></Column>
        <Column field="requesting_office" header="Requesting Office"></Column>
        <Column field="issued_to" header="Issued to (Employee)"></Column>
        <Column field="status" header="Status"></Column>
        <Column field="stock_number" header="Stock Number"></Column>
        <Column field="date_acquired" header="Date Acquired"></Column>
        <Column field="coa_reports" header="COA Reports"></Column>
        <Column field="unit_value" header="Unit Value"></Column>
        <Column field="balance" header="Balance Per Card (Quantity)"></Column>
        <Column field="onhand" header="On Hand Per Card (Quantity)"></Column>
        <Column field="remarks" header="Remarks"></Column>
        <Column :exportable="false" style="min-width:8rem">

            <template #body="slotProps">
                <Button icon="pi pi-pencil" class="p-button-rounded mr-2" @click="ReportsFormRef.showUpdate(slotProps.data)" />
                <Button icon="pi pi-trash" class="p-button-rounded p-button-danger" @click="ReportsFormRef.showDelete(slotProps.data)" />
            </template>
        </Column>
    </DataTable>
</template>