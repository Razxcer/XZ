<script setup>
import { Link, router } from '@inertiajs/vue3';
import HeadComp from './components/HeadComp.vue';
import { ref, computed } from 'vue'
import { useUserStore } from '../stores/userStore';

const props = defineProps({
    favorites: Array
})

const gamesHave = computed(()=>{
    let gamesHave
    if(props.favorites.length%10<=0 || props.favorites.length%10>=5) gamesHave = "игр"
    else if(props.favorites.length%10==1) gamesHave = "игра"
    else gamesHave= "игры"
    return gamesHave
})

const toggleFavorite = (productId) => {
        if(useUserStore().user)
        {
            router.post("/product/"+ productId + '/toggle-favorite', {}, {
                preserveScroll: true, // Страница останется на том же месте
                onSuccess: () => {
                    products.value.find(product => product.id == productId).is_favorite = !products.value.find(product => product.id == productId).is_favorite
                }
            })
        }
        else{
            alert("У вас есть аккаунт? авторизуйтесь если так, иначе зарегистрируйтесь")
        }
    }

    //Корзина
    const toggleBasket = (productId) => {
        if(useUserStore().user)
        {
            router.post("/product/"+ productId + '/toggle-basket', {}, {
                preserveScroll: true, // Страница останется на том же месте
                onSuccess: () => {
                    products.value.find(product => product.id == productId).in_basket = !products.value.find(product => product.id == productId).in_basket
                }
            })
        }
        else{
            alert("У вас есть аккаунт? авторизуйтесь если так, иначе зарегистрируйтесь")
        }
    }



</script>

<template>

    <HeadComp />

    <div class="wrap">
        <div class="you-have">У вас в избранном {{ props.favorites.length }} {{gamesHave}}:</div>

        <ul class="catalog">
            <li class="catalog-element" v-for="product in props.favorites" >
                    <Link :href="'/product/'+product.id" preserve-scroll preserve-state class="link-prod">
                        <img :src="product.imageURL" alt="Картинка">
                    </Link>
                    <div class="basket card-button" :class="{'in-basket': product.in_basket}">
                        <svg @click="toggleBasket(product.id)" xmlns="http://www.w3.org/2000/svg" class="bi bi-cart-plus-fill" viewBox="0 0 16 17">
                            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0"/>
                        </svg>
                    </div>
                    <div class="favorites card-button" :class="{'is-favorite': product.is_favorite}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-heart-fill" viewBox="-0.5 -1 17 17">
                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                        </svg>
                    </div>
                    <p class="name-game">{{ product.title }}</p>
                    <div class="priceAndBuy">
                        <p class="price">{{product.price}} руб</p>
                        <button class="buy" @click="toggleFavorite(product.id)">
                            <p>Удалить</p>
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
    background-color: color-mix(in srgb, #880808, transparent 50%);
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