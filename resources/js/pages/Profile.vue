<script setup>
import { computed, onMounted, ref} from 'vue';
import {Link} from '@inertiajs/vue3';
import HeadComp from './components/HeadComp.vue';

const props = defineProps({
    sales: Array,
    admin: Boolean
})

const admin=ref(props.admin)

console.log(props.sales)

const totalPrice=ref(0)
const preTotalPrice=ref("")
const buyText = ref("")

if(!admin.value){
    totalPrice.value = props.sales.reduce((acc, item)=>acc + item.price, 0)
    preTotalPrice.value = "Вы купили игр на "
    buyText.value = "Ваши покупки:"
}
if(admin.value){
    totalPrice.value = props.sales.reduce((acc, item)=>acc + item.product.price, 0)   
    preTotalPrice.value = "В нашем магазине купили игр на " 
    buyText.value = "Покупки ваших пользователей:"
}

const groupedData = computed(() => {
    return Object.groupBy(props.sales, (item) => item.user_id);
});

console.log(groupedData.value)




</script>

<template>
    <HeadComp />

    <div class="wrap">
        <div class="you-buy">{{ buyText }}</div>

        <ul class="catalog" v-if="!admin">
            <li class="catalog-item" v-for="product in props.sales">
                <div class="content">
                    <img :src="product.imageURL" alt="">
                    <p>{{ product.title }}</p>
                </div>
                <p>{{ product.price }} руб</p>
            </li>
        </ul>

        <ul class="catalog" v-if="admin">
            <ul class="catalog-users" v-for="user in groupedData">
                <p class="user-name">{{ user[0].user.name }}</p>
                <li class="catalog-admin-item" v-for="product in user">
                    <p class="product-title">{{ product.product.title }}</p>
                    <p class="product-price">{{ product.product.price}} ₽</p>
                </li>
                <div class="total-user-info">
                    <p class="total-product-title">Всего:</p>
                    <p class="total-product-price">{{ user.reduce((sum, item) => sum + item.product.price, 0) }} ₽</p>    
                </div>
                

            </ul>
        </ul>

        <div class="total">{{preTotalPrice}}{{ totalPrice }} рублей</div>

    </div>
</template>

<style scoped>
.wrap{
    width: 100%;
    margin-top: 60px;
    display: flex;
    flex-wrap: wrap;
    font-size: 20px;
}

.you-buy{
    width: 100%;
    font-size: 20px;
    text-indent: 20px;
    margin-top: 10px;
    margin-bottom: 20px;
}

.catalog{
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.catalog-item{
    display: flex;
    justify-content: start;
    align-items: center;
}

.catalog-item .content{
    padding: 10px 30px;
    display: flex;
    justify-content: start;
    align-items: center;
    gap: 10px;
    box-shadow: 0 0 5px 2px var(--clr-accent);
    margin-right: 20px;
    width: 470px;
}

.catalog-item img{
    width: 200px;
    height: 90px;
}

.catalog-item>p{
    color: var(--clr-accent);
}

.total{
    width: 100%;
    height: 60px;
    position: fixed;
    background-color: color-mix(in srgb, var(--bg-surface), transparent 10%);
    display: flex;
    align-items: center;
    top: calc(100vh - 60px);
    text-indent: 50px;
    font-size: 20px;
    color: var(--clr-accent);
}

.user-name{
    text-indent: 10px;
    color: var(--clr-accent-dark);
}

.catalog-admin-item{
    text-indent: 40px;
    display: flex;
}

.product-title{
    width: 300px;
    font-size: 18px;
}

.product-price{
    font-size: 18px;
    color: var(--clr-accent);
}

.total-user-info{
    display: flex;
    margin-left: 30px;
    padding: 0 10px;
    margin-top: 7px;
    border: 2px solid var(--clr-accent-dark);
}

.total-product-title{
    width: 300px;
    font-size: 18px;
}

.total-product-price{
    font-size: 18px;
    color: var(--clr-accent);
}



</style>