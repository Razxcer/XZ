<script setup>
import '../../../css/app.css'
import {ref, defineProps} from 'vue'

const props = defineProps({
    product: Object
})

const inFavoritesClass = ref(null)

const emit = defineEmits(['closeModal'])

const closeModal = ()=>{
    emit('closeModal')
}

const inFavorites=()=>{
    if(inFavoritesClass.value == 'in-favorites') inFavoritesClass.value=null
    else inFavoritesClass.value = 'in-favorites'
}

</script>

<template>
    <div class="wrap">
        <div class="panel-actions">
            <p class="game-name">{{ product.title }}</p>
            <div class="actions">
                <svg xmlns="http://www.w3.org/2000/svg"  class="bi bi-heart-fill action-btn like-btn" :class="inFavoritesClass" viewBox="0 0 16 16" @click="inFavorites">
                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg"  class="bi bi-basket2-fill action-btn" viewBox="0 0 16 16">
                    <path d="M5.929 1.757a.5.5 0 1 0-.858-.514L2.217 6H.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h.623l1.844 6.456A.75.75 0 0 0 3.69 15h8.622a.75.75 0 0 0 .722-.544L14.877 8h.623a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1.717L10.93 1.243a.5.5 0 1 0-.858.514L12.617 6H3.383zM4 10a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0zm4-1a1 1 0 0 1 1 1v2a1 1 0 1 1-2 0v-2a1 1 0 0 1 1-1"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-x-lg close-btn action-btn" viewBox="0 0 16 16" @click="closeModal">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                </svg>
            </div>
        </div>
    
    
        <div class="left">
            <img class="product-img" :src="props.product.imageURL" alt="Альтушка">    
        </div>

        <div class="right"></div>


    </div>
</template>

<style scoped>

.wrap{
    background-color: var(--bg-surface);
    border-radius: 0 0 1.1em 1.1em;
    box-shadow: 0px 0px 5px 2px var(--clr-text);
    padding: 10px;
    display: flex;
    flex-wrap: wrap;
}

.left{
    width: 50%;
    height: 90%;
    background-color: red;
}

.product-img{
    width: 100%;
}

.right{
    width: 50%;
    height: 90%;
    background-color: green;
}



.panel-actions{
    width: 100%;
    height: 50px;
    display: flex;
}

.game-name{
    width: 80%;
    height: 100%;
    font-size: 25px;
    font-weight: 600;
    text-align: center;
}

.actions{
    display: flex;
    justify-content: space-around;
    width: 20%;
    height: 100%;
}

.action-btn{
    width: 40px;
    height: 40px;
    fill: var(--clr-text);
    cursor: pointer;
}

.close-btn>path{
    stroke: var(--clr-text);
    stroke-width: 0.6px;
}

.like-btn:hover{
    fill: palevioletred;
    fill-opacity: 0.4;
}

.in-favorites{
    fill: palevioletred;
    fill-opacity: 1;
}
</style>