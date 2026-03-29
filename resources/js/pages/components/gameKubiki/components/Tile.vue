<script setup>
import { defineProps } from 'vue';
import { ref } from 'vue';

const props = defineProps({
    active: Number
})



</script>

<template>

<div class="tile" :class="{'active': props.active>0}"></div>

</template>

<style scoped>

.tile{
    background-color: grey;
    border: 2px  solid black;
    border-radius: 0.5em;
}

.active{
    background-color: var(--clr-accent);
}

</style>