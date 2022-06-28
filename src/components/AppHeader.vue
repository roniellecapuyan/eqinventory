<script setup>
import Menubar from 'primevue/menubar';
import Button from 'primevue/button';

let items = [
    {
        label:'Home',
        icon:'pi pi-fw pi-home',
        to: '/',
    },
    {
        label:'Reports',
        icon:'pi pi-fw pi-pencil',
        to: '/reports',
    },
    {
        label:'Users',
        icon:'pi pi-fw pi-user',
        to: '/users'
    },
    {
        label:'Employees',
        icon:'pi pi-fw pi-user',
        to: '/employees'
    },

    
    // {
    //     label:'Quit',
    //     icon:'pi pi-fw pi-power-off',
    //     to: '/logout'
    // }
];
</script>

<template>
    <Menubar :model="items">
        <template #start>
            <img alt="logo" src="https://scontent.xx.fbcdn.net/v/t1.15752-9/283909163_479155893976771_4560956765898472557_n.png?stp=dst-png_s206x206&_nc_cat=105&ccb=1-7&_nc_sid=aee45a&_nc_eui2=AeE8V6xu7nn8RTMBklwXV7Vqy3VtspH4MuvLdW2ykfgy6wmTCW1Ss_zBikg8_2rKTwXJgMZBMbrxWhh6tXxw5Tyo&_nc_ohc=szONmnUx6pYAX_uOgqm&_nc_oc=AQmByxx-jogQM_MsKXJfyrLk38qPTu_Lwc_YqTigk2RHT4-3ifh6RHiPQxFW_6A9ZL-0EO21uOHBqfHFvYLZdTS_&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_AVKzU8vZdF2BJqr_4RXJuvp49bfWwNr8b-naQSxIRkk79Q&oe=62C4CAAE" height="60" class="mr-2">
        </template>
        <template #end>
            <Button class="p-button-text" label="Logout" icon="pi pi-fw pi-power-off">
            </Button>
        </template>
    </Menubar>
    <div class="banner"> 
      <h1>TESDA XI - RTC-KORPHIL DAVAO</h1>
      <h3>REPORT ON THE PHYSICAL COUNT OF INVENTORIES</h3>
      <h4>SEMI-EXPANDABLE OTHER MACHINERY AND EQUIPMENT</h4>
    </div>
</template>