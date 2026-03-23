<script setup>
import HeadComp from './components/HeadComp.vue'
import Filters from './productsComponents/Filters.vue'
import Catalog from './productsComponents/CatalogProducts.vue'
import { usePage, Link, useForm, Head, router} from '@inertiajs/vue3';
import { useUserStore } from '../stores/userStore'
import { ref, computed, onMounted, watch } from 'vue';


  const props = defineProps({
    products: Array,
    genres: Array,
    genresProducts: Array,
    selectedProduct: Object,
  });

  const filter = ref({})
  const searchText=ref(null)

  const updateFilter=(payload)=>{
    filter.value = payload
  }

  const searchItem=(payload)=>{
    searchText.value = payload
  }


</script>

<template>

<div class="wrapper">  

    <Head title="Главная страница" />

    <HeadComp @search="searchItem"/>

    <Filters 
    :products="props.products" 
    :genres="props.genres" 
    @update-filter="updateFilter"
    class="left-menu" />

    <Catalog 
    :searchText="searchText"
    :products="props.products" 
    :filter="filter" 
    :genresProducts="props.genresProducts" 
    :selectedProduct="props.selectedProduct"
    class="right-catalog" />

</div> 

</template>

<style scoped>

.wrapper{
  width: 100%;
  display: flex;
  flex-wrap: wrap;
  padding-top: 60px;
}

.left-menu{
  width: 350px;
  min-height: 100vh;
}

.right-catalog{
  margin-top: 20px;
  width: calc(100% - 350px);
}




@media (min-width: 1024px) {
}
</style>