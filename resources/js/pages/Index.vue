<script setup>
import HeadComp from './components/HeadComp.vue'
import Filters from './productsComponents/Filters.vue'
import Catalog from './productsComponents/CatalogProducts.vue'
import { usePage, Link, useForm, Head, } from '@inertiajs/vue3';
import { useUserStore } from '../stores/userStore'
import { ref, computed, onMounted, watch } from 'vue';

  //Если к нам пришли с юзер неймом
  // const page = usePage();
  // const userStore = useUserStore();

  // const syncUser = () => {
  //   const auth = page.props.auth;
  //   console.log(auth)
  //   if (auth && auth.user) {
  //     userStore.setUser(auth.user)
  //   }
  // }

  // onMounted(()=>{
  //   syncUser()
  // })

  // watch(() => page.props.auth, syncUser, { deep: true });




  const props = defineProps({
    products: Array,
    genres: Array,
    genresProducts: Array
  });
  
  const filter = ref({})

  const updateFilter=(payload)=>{
    filter.value = payload
  }



</script>

<template>

<div class="wrapper">  

    <Head title="Главная страница" />

    <HeadComp />

    <Filters :products="props.products" :genres="props.genres" class="left-menu" @update-filter="updateFilter" />

    <Catalog :products="props.products" :filter="filter" :genresProducts="genresProducts" class="right-catalog"/>

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