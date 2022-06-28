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
        'item-created',
        'item-update',
        'item-deleted',
    ]);

    let itemDialog = ref(false);
    let deleteDialog = ref(false);
    let item = ref({});

    function showCreate() {
        itemDialog.value = true;
        item.value = {
            account: null,
            article: null,
            description: null,
            date: null,
            number: null,
            measurement: null,
            value: null,
            office: null,
            issued: null,
            po: null,
            status: null,
            serial: null
        };
    }

    function showUpdate(selectedItem) {
        itemDialog.value = true;
        item.value = selectedItem;
    }

    function showDelete(selectedItem) {
        deleteDialog.value = true;
        item.value = selectedItem;
    }

    function hideDialogs() {
        itemDialog.value = false;
        deleteDialog.value = false;
    }

    function saveItem() {
        // NO ITEM ID means... CREATE!
        if(!item.value.id) {
            Axios.post('http://localhost/EquipmentInventory/api/items/create-item.php', item.value)
                .then(function(response) {
                    hideDialogs();
                    emit('item-created');
                });
        }
        
        // HAVE ITEM.ID means... UPDATE!
        else if(item.value.id) {
            Axios.post('http://localhost/EquipmentInventory/api/items/update-item.php', item.value)
                .then(function() {
                    hideDialogs();
                    emit('item-updated');
                });
        }
    }

    function deleteItem() {
        if(item.value.id) {
            Axios.post('http://localhost/EquipmentInventory/api/items/delete-item.php', item.value)
                .then(function(response) {
                    hideDialogs();
                    emit('item-deleted');
                });
        }
    }
</script>

<template>
    <Dialog :style="{width: '300px'}" v-model:visible="deleteDialog">
        <template #header>
            <h3>Delete Item?</h3>
        </template>
        
        <p>Are you sure?</p>

        <template #footer>
            <Button label="No" icon="pi pi-times" class="p-button-text" @click="hideDialogs()" autofocus />
            <Button label="Yes" icon="pi pi-check"  @click="deleteItem()"/>
        </template>
    </Dialog>

    <Dialog v-model:visible="itemDialog" :style="{width: '450px'}"  header="Item Details" :modal="true" class="p-fluid">
        <div class="field">
            <label for="account">Account Name</label>
            <InputText id="account" v-model="item.account" required="true" autofocus />
        </div>
        <div class="field">
            <label for="article">Article</label>
            <InputText id="article" v-model="item.article" required="true"/>
        </div>
        <div class="field">
            <label for="description">Item Description</label>
            <InputText id="description" v-model="item.description" required="true"/>
        </div>
        <div class="field">
            <label for="date">Date Acquired</label>
            <InputText id="date" v-model="item.date" required="true"/>
        </div>
        <div class="field">
            <label for="number">Property Number</label>
            <InputText id="number" v-model="item.number" required="true"/>
        </div>
        <div class="field">
            <label for="measurement">Unit of Measurement</label>
            <InputText id="measurement" v-model="item.measurement" required="true"/>
        </div>
        <div class="field">
            <label for="value">Unit Value</label>
            <InputText id="value" v-model="item.value" required="true"/>
        </div>
        <div class="field">
            <label for="office">Requesting Office</label>
            <InputText id="office" v-model="item.office" required="true"/>
        </div>
        <div class="field">
            <label for="issued">Issued to (Employee)</label>
            <InputText id="issued" v-model="item.issued" required="true"/>
        </div>
        <div class="field">
            <label for="po">PO Number</label>
            <InputText id="po" v-model="item.po" required="true"/>
        </div>
        <div class="field">
            <label for="status">Status</label>
            <InputText id="status" v-model="item.status" required="true"/>
        </div>
        <div class="field">
            <label for="serial">Serial Number</label>
            <InputText id="serial" v-model="item.serial" required="true"/>
        </div>
        <div class="field">
            <label for="ris">RIS (Issuance Number)</label>
            <InputText id="ris" v-model="item.ris" required="true"/>
        </div>
        <div class="field">
            <label for="stock">Stock Card</label>
            <InputText id="stock" v-model="item.stock" required="true"/>
        </div>
        <div class="field">
            <label for="par">PAR Number</label>
            <InputText id="par" v-model="item.par" required="true"/>
        </div>
        <div class="field">
            <label for="ics">ICS Number</label>
            <InputText id="ics" v-model="item.ics" required="true"/>
        </div>
        <div class="field">
            <label for="property">Property Card</label>
            <InputText id="property" v-model="item.property" required="true"/>
        </div>
        <template #footer>
            <Button label="Cancel" icon="pi pi-times" class="p-button-text" @click="hideDialogs()"/>
            <Button label="Save" icon="pi pi-check" @click="saveItem()" />
        </template>
    </Dialog>

</template>