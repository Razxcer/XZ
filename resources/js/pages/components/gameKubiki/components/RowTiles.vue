<script setup>
import { defineProps } from 'vue';
import Tile from './Tile.vue';

const props = defineProps({
    row: Array
})



</script>

<template>
    <div class="row">
        <Tile class="tile" v-for="tile in props.row" :active="tile" />
    </div>
</template>

<style scoped>

.row{
    display: flex;
}

.tile{
    width: 12.5%;
    height: 100%;
}

</style>