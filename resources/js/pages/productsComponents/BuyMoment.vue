<script setup>
import { ref, defineEmits } from 'vue';

const emit = defineEmits(['buy-close'])

const close=()=>{
    emit('buy-close')
}


</script>


<template>

<div class="wrap">
    <p>Если бы это был реальный сайт, то тут бы был QR-код ツ</p>
    

    <button @click="close">Закрыть</button>
</div>

</template>

<style scoped>

.wrap{
    left: calc(calc(100vw - 350px)/2);
    z-index: 999;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    position: absolute;
    width: 600px;
    height: 600px;
    background-color: var(--bg-surface);
    color: var(--clr-text);
    border-radius: 1.5em;
}

button{
    width: 70%;
    height: 50px;
}

p{
    width: 80%;
}

</style>