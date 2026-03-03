<script setup>
import HeadComp from './components/HeadComp.vue'
import Filters from './productsComponents/Filters.vue'
import Catalog from './productsComponents/CatalogProducts.vue'
import { usePage, Link, useForm, Head, } from '@inertiajs/vue3';
import { useUserStore } from '../stores/user'
import { ref, computed } from 'vue';

  //Если к нам пришли с юзер неймом
  const page = usePage();
  const userStore = useUserStore();
  if(!userStore.userData)
  {
    userStore.setUser(page.props.flash.userName);
  }

  const props = defineProps({
    products:Array,
  });

  const filter = ref({})


  //Логика фильтров

  const maxPriceValue = computed(() => 
    props.products.reduce((max, product) => (product.price > max ? product.price : max), props.products[0].price)
  );

  const minPriceValue = computed(() => 
    props.products.reduce((min, product) => (product.price < min ? product.price : min), props.products[0].price)
  );
  
  filter.value.minPrice=minPriceValue.value
  filter.value.maxPrice=maxPriceValue.value

  const updatePrice=(payload)=>{
    filter.value.minPrice = payload.min
    filter.value.maxPrice = payload.max
  }







</script>

<template>

<div class="wrapper">  

    <Head title="Главная страница" />

    <HeadComp />

    <Filters :products="props.products" class="left-menu" @updatePrice="updatePrice" />

    <Catalog :products="props.products" :filter="filter" class="right-catalog"/>

</div> 

</template>

<style scoped>

.wrapper{
  width: 100%;
  height: 1000px;
  display: flex;
  flex-wrap: wrap;
  padding-top: 60px;
}

.left-menu{
  width: 350px;
  height: 100%;
}

.right-catalog{
  margin-top: 20px;
  width: calc(100% - 350px);
}




@media (min-width: 1024px) {
}
</style>