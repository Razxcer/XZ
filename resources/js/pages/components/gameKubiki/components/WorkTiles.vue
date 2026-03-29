<script setup>
import { defineProps, watch } from 'vue';
import { ref } from 'vue';

const props = defineProps({
    part: Array,
    idPart: Number,
    tileSize: Number
})

let currentPart
let kol=0


const aboba=()=>{
    setTimeout(()=>{
    currentPart = document.querySelectorAll('.work-tile-'+props.idPart);
    kol=0;
    for(let i=0; i<props.part.length; i++)
    {
        for(let j=0; j<props.part[0].length;j++)
        {
            if(props.part[i][j]==0)
            {
                currentPart[kol].classList.add('not-visible')
                // console.log("Сделал  что-то невидимым")
            }
            if(props.part[i][j]>0)
            {
                currentPart[kol].classList.remove('not-visible')
                // console.log("Сделал  что-то видимым")
            }
            kol+=1;
        }
    }

},100)

}




</script>

<template>
<div class="part">
    <div class="row" v-for="row in props.part">
        <div class="tile" :class="'work-tile-'+props.idPart" v-for="tile in row" :style="{width: props.tileSize+'px', height: props.tileSize+'px'}"></div>
    </div>
    <div class="for-rendr" style="display: none;">{{ aboba()}}</div>
</div>
</template>

<style scoped>
  
  .part{
    position: absolute;
    
  }

  .row{
    display: flex;
  }
  
.tile{
    background-color: grey;
    border: 2px  solid black;
    border-radius: 0.5em;
    color:black;
}

.work-tile-1{
    background-color: aqua;
}

.work-tile-2{
    background-color: red;
}

.work-tile-3{
    background-color: green;
}

.not-visible{
    background-color: rgba(0, 0, 0, 0);
    border: none;
}
</style>