<script setup>
    import { ref, onMounted } from 'vue';
    import HomeForm from './HomeForm.vue';
    import Button from 'primevue/button';
    import InputText from 'primevue/inputtext';
    import DataTable from 'primevue/datatable';
    import Column from 'primevue/column';
    import Toolbar from 'primevue/toolbar';
    import Axios from 'axios';

    onMounted(getItem);

    let item = ref([]);
    let search = ref('');
    let itemDialog = ref(false);
    let HomeFormRef = ref(null);

    function getItem() {
        search.value = '';
        Axios.get('http://localhost/EquipmentInventory/api/items/get-items.php')
            .then(function(response) {
                item.value = response.data;
            });
    }

    function searchItem() {
        Axios.get('http://localhost/EquipmentInventory/api/items/search-items.php?search=' + search.value)
            .then(function(response) {
                item.value = response.data;
            });
    }

</script>

<template>
    <HomeForm 
        ref="HomeFormRef"
        @item-created="getItem()"
        @item-updated="getItem()"
        @item-deleted="getItem()">
    </HomeForm>

    <Toolbar class="mb-4">
        <template #start>
            <h3 class="m-0 mb-2 md:m-0"></h3>
        </template>

        <template #end>
            <span class="p-input-icon-left mr-2">
                <i class="pi pi-search" />
                <InputText v-model="search" placeholder="Search..." @keydown.enter="searchItem()" />
            </span>
            <Button label="New" icon="pi pi-plus" class="p-button-success mr-2" @click="HomeFormRef.showCreate()" />
            <Button label="Refresh" icon="pi pi-refresh" @click="getItem"/>
        </template>
    </Toolbar>
    
    <DataTable :value="item" responsiveLayout="scroll">
        <Column field="id" header="ID"></Column>
        <Column field="account" header="Account Name"></Column>
        <Column field="article" header="Article"></Column>
        <Column field="description" header="Item Description"></Column>
        <Column field="date" header="Date Acquired"></Column>
        <Column field="number" header="Property Number"></Column>
        <Column field="measurement" header="Unit of Measurement"></Column>
        <Column field="value" header="Unit Value"></Column>
        <Column field="office" header="Requesting Office"></Column>
        <Column field="issued" header="Issued to (Employee)"></Column>
        <Column field="po" header="PO Number"></Column>
        <Column field="status" header="Status"></Column>
        <Column field="serial" header="Serial Number"></Column>
        <Column field="ris" header="RIS (Issuance Number)"></Column>
        <Column field="stock" header="Stock Card"></Column>
        <Column field="par" header="PAR Number"></Column>
        <Column field="ics" header="ICS Number"></Column>
        <Column field="property" header="Property Card"></Column>
        <Column :exportable="false" style="min-width:8rem">

            <template #body="slotProps">
                <Button icon="pi pi-pencil" class="p-button-rounded mr-2" @click="HomeFormRef.showUpdate(slotProps.data)" />
                <Button icon="pi pi-trash" class="p-button-rounded p-button-danger" @click="HomeFormRef.showDelete(slotProps.data)" />
            </template>
        </Column>
    </DataTable>
</template>