<script setup>
import { ref, computed, watch } from 'vue';
import '../../../../css/app.css'

const props = defineProps({
  min: { type: Number, default: 0 },
  max: { type: Number, default: 1000 },
  step: { type: Number, default: 1 }
});

const emit = defineEmits(['updatePrice']);

// Локальное состояние для двух ползунков
const minVal = ref(props.min);
const maxVal = ref(props.max);

const emitValues = () => {
  emit('updatePrice', { min: minVal.value, max: maxVal.value });
};

// Вычисляем проценты для закрашивания полоски между ползунками
const minPercent = computed(() => ((minVal.value - props.min) / (props.max - props.min)) * 100);
const maxPercent = computed(() => ((maxVal.value - props.min) / (props.max - props.min)) * 100);

// Следим за тем, чтобы ползунки не пересекались
const updateMin = () => {
  if (minVal.value > maxVal.value) minVal.value = maxVal.value;
  emitValues();
};

const updateMax = () => {
  if (maxVal.value < minVal.value) maxVal.value = minVal.value;
  emitValues();
};

</script>

<template>
  <div class="price-slider">
    <div class="slider-container">
      <!-- Фоновая полоска -->
      <div class="slider-track"></div>
      <!-- Активная часть полоски (между ползунками) -->
      <div 
        class="slider-progress" 
        :style="{ left: minPercent + '%', right: (100 - maxPercent) + '%' }"
      ></div>

      <!-- Инпуты накладываются друг на друга -->
      <input 
        type="range" 
        :min="min" :max="max" :step="step"
        v-model.number="minVal" 
        @input="updateMin"
        class="range-input"
      />
      <input 
        type="range" 
        :min="min" :max="max" :step="step"
        v-model.number="maxVal" 
        @input="updateMax"
        class="range-input"
      />
    </div>

    <div class="values">
      <span>{{ minVal }} ₽</span>
      <span>{{ maxVal }} ₽</span>
    </div>

  </div>
</template>

<style scoped>
.price-slider {
  width: 100%;
  max-width: 400px;
}

.values{
  display: flex;
  justify-content: space-between;
  margin-top: 10px;
  font-family: sans-serif;
  color: var(--clr-text);
}

.values span{
  user-select: none;
}

.slider-container {
  position: relative;
  height: 6px;
  background: var(--bg-surface);
  border-radius: 3px;
}

.slider-track {
  position: absolute;
  width: 100%;
  height: 100%;
  z-index: 1;
}

.slider-progress {
  position: absolute;
  height: 100%;
  background: var(--clr-accent); /* Цвет Vue */
  border-radius: 3px;
  z-index: 2;
}

.range-input {
  position: absolute;
  width: 100%;
  top: -3px;
  height: 10px;
  background: none;
  pointer-events: none; /* Пропускаем клики сквозь инпут */
  -webkit-appearance: none;
  appearance: none;
  margin: 0;
  z-index: 3;
}

/* Стилизация самих "кружков" (ползунков) */
.range-input::-webkit-slider-thumb {
  height: 18px;
  width: 18px;
  border-radius: 50%;
  background: var(--clr-text);
  border: 3px solid var(--bg-surface);
  cursor: pointer;
  pointer-events: auto; /* Возвращаем клики только на кружки */
  -webkit-appearance: none;
}

.range-input::-moz-range-thumb {
  height: 18px;
  width: 18px;
  border-radius: 50%;
  background: var(--clr-text);
  border: 3px solid var(--bg-surface);
  cursor: pointer;
  pointer-events: auto;
}
</style>