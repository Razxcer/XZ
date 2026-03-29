<script setup>
import { onMounted, ref } from 'vue';
import { defineProps, watch } from 'vue';
import RowTiles from './components/RowTiles.vue';
import WorkTiles from './components/WorkTiles.vue';
import { Link } from '@inertiajs/vue3';
import { useUserStore } from '../../../stores/userStore';

//Pinia userStore.js
const userStore = useUserStore();

const scoreForDiscount=ref(10)
const currentDiscount=ref(5)

const score = ref(0)
const gameSize = 600
const tileSize = gameSize*0.125
const offsetpixel = 10
const linesDoneX = ref([])
const linesDoneY = ref([])
const matrix = ref([
  [0,0,0,0,0,0,0,0],
  [0,0,0,0,0,0,0,0],
  [0,0,0,0,0,0,0,0],
  [0,0,0,0,0,0,0,0],
  [0,0,0,0,0,0,0,0],
  [0,0,0,0,0,0,0,0],
  [0,0,0,0,0,0,0,0],
  [0,0,0,0,0,0,0,0]
])  

const matrixParts = ref([
  // Кубы 2Х2 3Х3
  [
  [1,1],
  [1,1]
  ],

  [
  [1,1,1],
  [1,1,1],
  [1,1,1]
  ],

  // Палки 3Х1 1Х3

  [
  [1,1,1]
  ],

  [
  [1],
  [1],
  [1]
  ],
  // Палки 4Х1 1Х4
  [
  [1,1,1,1]
  ],

  [
  [1],
  [1],
  [1],
  [1]
  ],

  // Блок 2Х3 3Х2

  [
  [1,1,1],
  [1,1,1]
  ],

  [
  [1,1],
  [1,1],
  [1,1]
  ],

  // Угол 4 положения 

  [
  [1,1],
  [1,0]
  ],

  [
  [0,1],
  [1,1]
  ],

  [
  [1,0],
  [1,1]
  ],

  [
  [1,1],
  [0,1]
  ],


  // Г - все 8 положений
  [
  [1,1,1],
  [0,0,1]
  ],

  [
  [0,0,1],
  [1,1,1]
  ],

  [
  [1,0,0],
  [1,1,1]
  ],

  [
  [1,1,1],
  [1,0,0]
  ],

  [
    [1,1],
    [1,0],
    [1,0]
  ],

  [
    [1,0],
    [1,0],
    [1,1]
  ],

  [
    [0,1],
    [0,1],
    [1,1]
  ],

  [
    [1,1],
    [0,1],
    [0,1]
  ],

  // Т - все 4 положения

  [
  [1,1,1],
  [0,1,0]
  ],

  [
  [0,1,0],
  [1,1,1]
  ],

  [
  [0,1],
  [1,1],
  [0,1]
  ],

  [
  [1,0],
  [1,1],
  [1,0]
  ],

  // Змея 4 положения

  [
  [1,1,0],
  [0,1,1]
  ],

  [
  [0,1,1],
  [1,1,0]
  ],

  [
  [0,1],
  [1,1],
  [1,0]
  ],

  [
  [1,0],
  [1,1],
  [0,1]
  ]


])


const partMatrix = ref([
  [1,1],
  [1,1]
])


watch(matrix.value,()=>{

  for(let i=0;i<matrix.value.length;i+=1)
  {
    let flagVert = true
    let flagHoriz = true
    for(let j=0;j<matrix.value[i].length;j+=1)
    {
      if(matrix.value[i][j] < 1) flagHoriz = false
    }

    for(let j=0;j<matrix.value.length;j+=1)
    {
      if(matrix.value[j][i] < 1) flagVert = false
    }

    if(flagHoriz){
      linesDoneX.value.push(i);
    }
    if(flagVert){
      linesDoneY.value.push(i);
    }
  }

  for(let i=0;i<linesDoneX.value.length;i+=1)
  {
    for(let j=0;j<matrix.value[0].length;j+=1)
    {
      matrix.value[linesDoneX.value[i]][j]=0
    }
    score.value+=8
  }

  for(let i=0;i<linesDoneY.value.length;i+=1)
  {
    for(let j=0;j<matrix.value[0].length;j+=1)
    {
      matrix.value[j][linesDoneY.value[i]]=0
    }
    score.value+=8
  }

  linesDoneX.value = []
  linesDoneY.value =[]

  if(score.value >= scoreForDiscount.value){
    userStore.setUserDiscount(currentDiscount.value);
    scoreForDiscount.value = currentDiscount.value*10;
    alert('Скидка получена ('+ currentDiscount.value +'%)');
    currentDiscount.value +=5
  }
})




onMounted(()=>{
  const game = document.querySelector('.game')
  const parts = document.querySelectorAll('.work-tiles')

  // Щас всё для DragAndDrop
  let isDragging = false
  let DraggingElement
  let offsetX
  let offsetY

  document.addEventListener('mousedown',(e)=>{
    parts.forEach(part => {
      if(e.target.parentNode.parentNode==part && !e.target.classList.contains('not-visible'))
      {
        isDragging = true
        DraggingElement = part
        offsetX = e.pageX - (part.getBoundingClientRect().x + window.scrollX)
        offsetY = e.pageY - (part.getBoundingClientRect().y + window.scrollY)
      }
    });
  })

  document.addEventListener('mousemove',(e)=>{
    if(isDragging==true){
      DraggingElement.style.left = e.pageX-offsetX+'px'
      DraggingElement.style.top = e.pageY-offsetY+'px'
    }

  })

  document.addEventListener('mouseup',(e)=>{
    if(isDragging){
    isDragging = false

    let gameX = game.getBoundingClientRect().x + window.scrollX
    let gameY = game.getBoundingClientRect().y + window.scrollY

    let dragX = DraggingElement.getBoundingClientRect().x + window.scrollX
    let dragY = DraggingElement.getBoundingClientRect().y + window.scrollY

    let iteration = 0
    let jteration = 0

    for(let y = gameY; y<gameY+gameSize; y+=tileSize)
    {
      if(dragY>y-offsetpixel && dragY<y+offsetpixel) break
      iteration+=1
    }

    for(let x = gameX; x<gameX+gameSize; x+=tileSize)
    {
      if(dragX>x-offsetpixel && dragX<x+offsetpixel) break
      jteration+=1
    }
    
    if(iteration<8 && jteration<8){
      if(8-iteration<partMatrix.value.length)
      {

      }
      else if(8-jteration<partMatrix.value[0].length)
      {

      }
      else{
        let flag=true
        for(let i=0;i<partMatrix.value.length;i+=1)
        {
          for(let j=0; j<partMatrix.value[i].length;j+=1)
          {
            if(matrix.value[iteration+i][jteration+j]>0 && partMatrix.value[i][j]>0)flag = false
          }
        }

        if(flag){
        for(let i=0;i<partMatrix.value.length;i+=1)
        {
          for(let j=0; j<partMatrix.value[i].length;j+=1)
          {
            if(matrix.value[iteration+i][jteration+j]<1 && partMatrix.value[i][j]>0) matrix.value[iteration+i][jteration+j] = 1
          }
        }
          let nextPart = Math.floor(Math.random()*8)

          if(nextPart==0) partMatrix.value = matrixParts.value[Math.floor(Math.random()*2)]         // Кубы
          else if(nextPart==1) partMatrix.value = matrixParts.value[2+Math.floor(Math.random()*2)]  // Палка 3
          else if(nextPart==2) partMatrix.value = matrixParts.value[4+Math.floor(Math.random()*2)]  // Палка 4
          else if(nextPart==3) partMatrix.value = matrixParts.value[6+Math.floor(Math.random()*2)]  // Блок 2Х3
          else if(nextPart==4) partMatrix.value = matrixParts.value[8+Math.floor(Math.random()*4)]  // Углы
          else if(nextPart==5) partMatrix.value = matrixParts.value[12+Math.floor(Math.random()*8)]  // Гэшки
          else if(nextPart==6) partMatrix.value = matrixParts.value[20+Math.floor(Math.random()*4)]  // Тэшки
          else if(nextPart==7) partMatrix.value = matrixParts.value[24+Math.floor(Math.random()*4)]  // Змея

         
          

          DraggingElement.style.left = document.querySelector('.place-for-work-tiles').getBoundingClientRect().x+ window.scrollX+100+"px"   
          DraggingElement.style.top = document.querySelector('.place-for-work-tiles').getBoundingClientRect().y+ window.scrollY+20+"px"   
        }
      }
    }
  }})
})



</script>

<template>
  <div class="wrapper">
    <Link href="/basket" class="back"><- В корзину</Link>
    <div class="score">
      <p>Для скидки необходимо = {{scoreForDiscount}}</p>
      <p>Сейчас = {{ score }}</p>
    </div>

    <div class="game">
      <RowTiles class="row"  v-for="tile in matrix" :row="tile" />
    </div>

    <div class="place-for-work-tiles">
      <WorkTiles class="work-tiles" :part="partMatrix" :tileSize="tileSize" :idPart="1" />
    </div>

  </div>
</template>

<style scoped>

  body{
    background-color: var(--clr-bg-surface);
  }

  .wrapper{
    width: 100%;
    height: 100vh;
  }
  
  .score{
    width: 100%;
    height: 20px;
    text-align: center;
    font-size: 20px;
    display: flex;
    justify-content: center;
    gap: 200px;
  }

  .back{
    position: absolute;
    font-size: 20px;
    left: 40px
  }

.game{
  width: 600px;
  height: 600px;
  margin: 0 auto;
  margin-top: 20px;
  display: flex;
  flex-direction: column;
}

.row{
  width: 100%;
  height: 12.5%;
}

.place-for-work-tiles{
  width: 1000px;
  height: 400px;
  margin: 0 auto;
  margin-top: 20px;
  background-color: var(--clr-accent-dark);
  opacity: 0.7;
}

</style>
