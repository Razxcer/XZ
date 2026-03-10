<script setup>
import {ref, defineProps, watch, computed} from 'vue'
import '../../../css/app.css'
import AboutGameModal from './AboutGameModal.vue';

    const props = defineProps({
        products: Array,
        filter: Object,
        genresProducts: Array
    });

    const products = ref(props.products)
    const currentProduct = ref(null)

    //Отфильтрованный массив
    const filtredArray = computed(() => 
    {
        if(props.filter.genres)
        {
            if(props.filter.genres == []){
                products.value.forEach(product => {
                    product.level = null
                })
            }
            else{
                products.value.forEach(product => {
                    let level = 0
                    props.filter.genres.forEach(genre => {
                        if(props.genresProducts.find(item => item.product_id == product.id && item.genre_id == genre.id)) level++
                    });
                    product.level = level
                });
            }     
        }
        let temp = products.value.filter(product=> product.price>=props.filter.minPrice && product.price<=props.filter.maxPrice)
        return temp
    })

    const groupedByLevel = computed(() => {
        return filtredArray.value.reduce((acc, item) => {
        if (!acc[item.level]) acc[item.level] = [];
        acc[item.level].push(item);
        return acc;
    }, {});
    });

    // 2. Получаем список уровней и сортируем их [5, 4, 3, 2, 1, 0]
    const sortedLevels = computed(() => {
        return Object.keys(groupedByLevel.value)
        .map(Number)
        .sort((a, b) => b - a); // b - a дает обратный порядок (от большего к меньшему)
        
    });

    const productCLicked=(product)=>{
        currentProduct.value = product
    }

    const closeModal=()=>{
        currentProduct.value=null
    }


</script>


<template>

    <div class="wrap">
        <AboutGameModal class="about-game" :product="currentProduct" v-if="currentProduct" @closeModal="closeModal"/>

        <div class="catalog">

            <ul class="level-section catalog" v-for="level in sortedLevels">
                <div class="level-title" v-if="props.filter.genres != null && props.filter.genres.length!=0" >Совпадений по жанрам {{ level }} из {{ props.filter.genres.length}}</div>

                <li class="catalog-element" v-for="product in groupedByLevel[level]" >
                    <a class="link-prod" @click="productCLicked(product)">
                        <img :src="product.imageURL" alt="Картинка">
                    </a>
                    <p class="name-game">{{ product.title }}</p>
                    <div class="priceAndBuy">
                        <p class="price">{{product.price}} руб</p>
                        <button class="buy">
                            <p>Купить</p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
                            </svg>
                        </button>
                    </div>                  
                </li>
            </ul>
        </div>


    </div>

</template>


<style scoped>

.wrap{
    display: flex;
}

.about-game{
    position: fixed;
    left: 400px;
    top: 80px;
    width: calc(100vw - 450px);
    height: calc(100vh - 100px);
    z-index: 999;
    animation: growIn 0.5s ease-out forwards;
}




.catalog{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    width: 100%;
}

.level-section{
    border: 4px solid var(--bg-surface);
    border-bottom: none;
    width: calc(100% - 20px);
    padding-top: 10px;
}
.level-title{
    width: 100%;
    text-align: center;
    padding-bottom: 15px;
    opacity: 0.8;
    font-size: 17.5px;
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

@keyframes growIn {
  from {
    transform: scale(0); /* Полностью сжат */
    opacity: 0;          /* Невидим */
  }
  to {
    transform: scale(1); /* Исходный размер */
    opacity: 1;          /* Полностью видим */
  }
}
.catalog-element:hover{
    transform: scale(1.05);
    transition: 0.2s;
}

.catalog-element>a{
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
    font-size: 1.5em;
    font-weight: bold;
    text-shadow: 0.7px 0.7px 0.5px var(--color-text);
    font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
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


</style>