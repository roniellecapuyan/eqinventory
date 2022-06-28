<script setup>
    import InputText from 'primevue/inputtext';
    import Dropdown from 'primevue/dropdown';
    import Textarea from 'primevue/textarea';
    import Button from 'primevue/button';
    import RadioButton from 'primevue/radiobutton';
    import InputNumber from 'primevue/inputnumber';
    import Dialog from 'primevue/dialog';
    import Calendar from 'primevue/calendar';

    import Axios from 'axios';
    import { ref } from 'vue';

    defineExpose({
        showCreate,
        showUpdate,
        showDelete,
    });
    let emit = defineEmits([
        'report-created',
        'report-update',
        'report-deleted',
    ]);

    let reportDialog = ref(false);
    let deleteDialog = ref(false);
    let report = ref({});
    let statuses = ['Serviceable','Serviceable-Under Repair', 'Unserviceable']
    let item_type = ['Semi-Expandable', 'Equipment']

    function showCreate() {
        reportDialog.value = true;
        report.value = {
            item_type: null,
            article: null,
            description: null,
            unit: null,
            requesting_office: null,
            issued_to: null,
            status: null,
            stock_number: null,
            date_acquired: null,
            coa_reports: null,
            unit_value: null,
            balance: null,
            onhand: null,
            remarks: null
        };
    }

    function showUpdate(selectedReport) {
        reportDialog.value = true;
        report.value = selectedReport;
    }

    function showDelete(selectedReport) {
        deleteDialog.value = true;
        report.value = selectedReport;
    }

    function hideDialogs() {
        reportDialog.value = false;
        deleteDialog.value = false;
    }

    function saveReport() {
        // NO REPORT ID means... CREATE!
        if(!report.value.id) {
            Axios.post('http://localhost/EquipmentInventory/api/reports/create-report.php', report.value)
                .then(function(response) {
                    hideDialogs();
                    emit('report-created');
                });
        }
        
        // HAVE REPORT.ID means... UPDATE!
        else if(report.value.id) {
            Axios.post('http://localhost/EquipmentInventory/api/reports/update-report.php', report.value)
                .then(function() {
                    hideDialogs();
                    emit('report-updated');
                });
        }
    }

    function deleteReport() {
        if(report.value.id) {
            Axios.post('http://localhost/EquipmentInventory/api/reports/delete-report.php', report.value)
                .then(function(response) {
                    hideDialogs();
                    emit('report-deleted');
                });
        }
    }
</script>

<template>
    <Dialog :style="{width: '300px'}" v-model:visible="deleteDialog">
        <template #header>
            <h3>Delete Report?</h3>
        </template>
        
        <p>Are you sure?</p>

        <template #footer>
            <Button label="No" icon="pi pi-times" class="p-button-text" @click="hideDialogs()" autofocus />
            <Button label="Yes" icon="pi pi-check"  @click="deleteReport()"/>
        </template>
    </Dialog>

    <Dialog v-model:visible="reportDialog" :style="{width: '450px'}"  header="Report Details" :modal="true" class="p-fluid">
        <div class="field">
            <label for="item_type">Item Type</label>
            <Dropdown v-model="report.item_type" placeholder="Select Item Type" :options="item_type"></Dropdown>
        </div>
        <div class="field">
            <label for="article">Article</label>
            <InputText id="article" v-model="report.article" required="true"/>
        </div>
        <div class="field">
            <label for="description">Description</label>
            <InputText id="description" v-model="report.description" required="true"/>
        </div>
        <div class="field">
            <label for="unit">Unit of Measurement</label>
            <InputText id="unit" v-model="report.unit" required="true"/>
        </div>
        <div class="field">
            <label for="requesting_office">Requesting Office</label>
            <InputText id="requesting_office" v-model="report.requesting_office" required="true"/>
        </div>
        <div class="field">
            <label for="issued_to">Issued to (Employee)</label>
            <InputText id="issued_to" v-model="report.issued_to" required="true"/>
        </div>
        <div class="field">
            <label for="status">Status</label>
            <Dropdown v-model="report.status" placeholder="Select Status" :options="statuses"></Dropdown>
        </div>
        <div class="field">
            <label for="stock_number">Stock Number</label>
            <InputText id="stock_number" v-model="report.stock_number" required="true"/>
        </div>
        <div class="field">
            <label for="date_acquired">Date Acquired</label>
            <Calendar v-model="report.date_acquired"/>
        </div>
        <div class="field">
            <label for="coa_reports">COA Reports</label>
            <InputText id="coa_reports" v-model="report.coa_reports" required="true"/>
        </div>
        <div class="field">
            <label for="unit_value">Unit Value</label>
            <InputText id="unit_value" v-model="report.unit_value" required="true"/>
        </div>
        <div class="field">
            <label for="balance">Balance Per Card (Quantity)</label>
            <InputText id="balance" v-model="report.balance" required="true"/>
        </div>
        <div class="field">
            <label for="onhand">On Hand Per Card (Quantity)</label>
            <InputText id="onhand" v-model="report.onhand" required="true"/>
        </div>
        <div class="field">
            <label for="remarks">Remarks</label>
            <InputText id="remarks" v-model="report.remarks" required="true"/>
        </div>

        <template #footer>
            <Button label="Cancel" icon="pi pi-times" class="p-button-text" @click="hideDialogs()"/>
            <Button label="Save" icon="pi pi-check" @click="saveReport()" />
        </template>
    </Dialog>

</template>