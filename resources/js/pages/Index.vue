<script setup>
import HeadComp from './components/HeadComp.vue'
import Filters from './productsComponents/Filters.vue'
import Catalog from './productsComponents/CatalogProducts.vue'
import {Head, Link} from '@inertiajs/vue3';

  const props = defineProps({
    products:Array,
  });

</script>

<template>

<div class="wrapper">  

    <Head title="Главная страница" />

    <HeadComp />

    <Filters class="left-menu"/>

    <Catalog :products="props.products" class="right-catalog"/>

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