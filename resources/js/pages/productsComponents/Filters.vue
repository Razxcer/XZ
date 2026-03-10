<script setup>
import '../../../css/app.css'
import Genres from './smallComponents/Genres.vue';
import Slider from './smallComponents/Slider.vue';
import { defineProps, ref, computed, defineEmits, onMounted, watch } from 'vue';

  const props = defineProps({
    products: Array,
    genres: Array
  })

  const emit = defineEmits(['update-filter'])

  const products = ref(props.products)
  const filter = ref({
    minPrice: null,
    maxPrice: null,
    genres: null
  })

  const maxPrice = computed(() => 
    products.value.reduce((max, product) => (product.price > max ? product.price : max), products.value[0].price)
  );
  const minPrice = computed(() => 
    products.value.reduce((min, product) => (product.price < min ? product.price : min), products.value[0].price)
  );

  filter.value.minPrice = minPrice.value
  filter.value.maxPrice = maxPrice.value


  const updatePrice=(payload)=>{
    filter.value.minPrice = payload.min
    filter.value.maxPrice = payload.max
  }

  const updateGenresList=(payload)=>{
    filter.value.genres = payload
  }

  onMounted(()=>{
    emit('update-filter',filter.value)
  })

  // watch(filter, ()=>{
  //   console.log(filter.value)
  //   emit('update-filter',filter.value)
  // })

</script>

<template>

    <div class="wrap">

      <div class="filter-element">
        <p class="filter-title">Цена</p>
        <Slider :max="maxPrice" :min="minPrice" @updatePrice="updatePrice" />
      </div>

      <div class="filter-element">
        <p class="filter-title">Жанры</p>
        <Genres :genres="props.genres" @update-genres-list="updateGenresList" />
      </div>



    </div>

</template>


<style scoped>

.wrap{
  background-color: var(--color-green);
  display: flex;
  flex-direction: column;
  align-items: center;
  padding-top: 20px;
}

.filter-element{
  width: 90%;
  padding: 10px;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  border-bottom: 2px solid var(--bg-main);
}

.filter-title{
  width: 80%;
  font-size: 20px;
  color: var(--clr-text);
  font-weight: 600;
  margin-bottom: 10px;
  user-select: none;
}


</style>