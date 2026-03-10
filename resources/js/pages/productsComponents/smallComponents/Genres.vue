<script setup>
import { ref, defineProps, defineEmits } from 'vue';

const props = defineProps({
    genres: Array
})

const emit = defineEmits(['update-genres-list'])

const activeGenres=ref([])

const checkGenre=(clickedGenre)=>{

    if(activeGenres.value.find(genre=> genre.id == clickedGenre.id))
    {
        activeGenres.value.splice(activeGenres.value.findIndex(genre=> genre.id == clickedGenre.id),1)
    }
    else{
        activeGenres.value.push(clickedGenre)
    }
    emit('update-genres-list', activeGenres.value)
}

</script>

<template>
    <ul>
        <li v-for="genre in props.genres" :class="{'active-genre':activeGenres.find(curGenre=> curGenre.id == genre.id) }" @click="checkGenre(genre)"> 
            {{ genre.name }}
        </li>
    </ul>
</template>

<style scoped>

ul{
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 5px;
}

li{
    cursor: pointer;
    padding: 0 10px;
    width: min-content;
    border-radius: 1em;
    user-select: none;
}


li:hover{
    background-color: var(--clr-accent);
}

.active-genre{
    background-color: var(--clr-accent);
    font-weight: 600;
    color: var(--bg-surface);
}


</style>