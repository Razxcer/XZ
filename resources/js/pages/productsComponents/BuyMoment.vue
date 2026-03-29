<script setup>
import { ref, defineEmits } from 'vue';
import { useUserStore } from '../../stores/userStore';

//Pinia userStore.js
const userStore = useUserStore();

const emit = defineEmits(['buy-close'])

const close=()=>{
    emit('buy-close')
}

console.log("Отправляю")
alert("Дальнейшая информация на почте")
router.post('/sendToEmail', {
    email: userStore.user.email,
    name: userStore.user.name
},
{
    preserveScroll: true, // страница не дернется вверх после обновления
});





</script>


<template>

<div class="wrap">
    <p>Данные по дальнейшим действиям у вас на почте ツ</p>
    

    <button @click="close">Закрыть</button>
</div>

</template>

<style scoped>

.wrap{
    z-index: 999;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    position: fixed;
    width: 300px;
    height: 300px;
    background-color: var(--bg-surface);
    color: var(--clr-text);
    border-radius: 1.5em;
}

button{
    width: 70%;
    height: 50px;
    margin-top: 70px;
    background-color: var(--bg-main);
    border-radius: 10px;
}

p{
    margin-top: 20px;
    width: 80%;
    font-size: 20px;
    text-align: center;
}

</style>