<script setup>
import { Link } from '@inertiajs/vue3';
import HeadComp from './components/HeadComp.vue';
import { ref } from 'vue'

const props = defineProps({
    basket: Array
})

const gamesHave=ref()
const gamesLen = props.basket.length

if(gamesLen%10<=0 || gamesLen%10>=5) gamesHave.value = "игр"
else if(gamesLen%10==1) gamesHave.value = "игра"
else gamesHave.value = "игры"




</script>

<template>

    <HeadComp />

    <div class="wrap">
        <div class="you-have">У вас в корзине {{ props.basket.length }} {{gamesHave}}:</div>

        <ul class="catalog">
            <li class="catalog-element" v-for="product in props.basket" >
                    <Link :href="'/product/'+product.id" preserve-scroll preserve-state class="link-prod">
                        <img :src="product.imageURL" alt="Картинка">
                    </Link>
                    <div class="basket card-button" :class="{'in-basket': product.in_basket}">
                        <svg @click="toggleBasket(product.id)" xmlns="http://www.w3.org/2000/svg" class="bi bi-cart-plus-fill" viewBox="0 0 16 17">
                            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0"/>
                        </svg>
                    </div>
                    <div class="favorites card-button" :class="{'is-favorite': product.is_favorite}">
                        <svg @click="toggleFavorite(product.id)" xmlns="http://www.w3.org/2000/svg" class="bi bi-heart-fill" viewBox="-0.5 -1 17 17">
                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                        </svg>
                    </div>
                    <p class="name-game">{{ product.title }}</p>
                    <div class="priceAndBuy">
                        <p class="price">{{product.price}} руб</p>
                        <button class="buy" @click="buyProduct">
                            <p>Купить</p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
                            </svg>
                        </button>
                    </div>                  
                </li>

        </ul>







    </div>
</template>

<style scoped>

.wrap{
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    padding-top: 60px;
    height: 100vh;
    align-content: start;
}
.you-have{
    width: 100%;
    font-size: 20px;
    text-indent: 20px;
    margin-top: 10px;
    margin-bottom: 30px;
    color: var(--clr-accent);
    font-weight: 500;
}


.catalog{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    width: 100%;
}

.catalog-element{
    width: 400px;
    height: 280px;
    background-color:var(--color-background-soft);
    list-style: none;
    border-radius: 0 0 1.1em 1.1em;
    margin-bottom: 30px;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items:start;
    box-shadow: 0px 0px 3px 0.5px var(--color-text);

    transition: 0.2s;
}

.catalog-element:hover{
    transform: scale(1.05);
    transition: 0.2s;
}


.catalog-element>.link-prod{
    width: 100%;
    height: 70%;
}

.catalog-element img{
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.catalog-element>.name-game{
    width: 100%;
    align-content: center;
    text-align: center;
    color: var(--color-text);
    font-size: 22px;
    font-weight: bold;
    /* text-shadow: 0.7px 0.7px 0.5px var(--color-text); */
    font-family: Verdana, Geneva, Tahoma, sans-serif;
}

.catalog-element>.priceAndBuy{
    width: 100%;
    display: flex;
    justify-content: space-around;
    margin-bottom: 10px;
}

.priceAndBuy>.price{
    width: 45%;
    align-content: center;
    text-align: center;
    color: var(--third-color);
    font-size: 1.4em;
    font-weight: bold;
}

.priceAndBuy>.buy{
    width: 40%;
    border: none;
    border-radius: 1.5em;
    font-size: 20px;
    background-color: var(--fourth-color);
    color: var(--first-color);
    font-family:Arial, Helvetica, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: 0.3s;
     /* box-shadow: 0px 0px 3px 2px solid var(--fourth-color); */
}

.buy:hover{
    cursor: pointer;
    transition: 0.3s;
    transform: scale(1.1);
}

.buy>svg{
    display: none;
}

.buy>p{
    display: block;
    font-weight: bold;
}

.link-prod{
    cursor: pointer;
}

.card-button{
    position: absolute;
    width: 30px;
    height: 30px;
    opacity: 0.9;
    transition: 0.2s;
}

.card-button:hover{
    transform: scale(1.2);
    transition: 0.2s;
    opacity: 1;
}


.basket{
    margin-left: calc(400px - 50px);
    margin-top: 5px;
}

.favorites{
    margin-left: calc(400px - 120px);
    margin-top: 5px;
}

.card-button>svg{
    width: 100%;
    height: 100%;
    fill: var(--bg-surface);
    stroke: var(--clr-text);
    stroke-width: 0.3px;
}

.is-favorite>svg{
    fill: palevioletred;
    opacity: 0.8;
}

.in-basket>svg{
    fill: green;
    opacity: 0.8;
}


</style>