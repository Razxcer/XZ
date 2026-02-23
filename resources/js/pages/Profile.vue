<script setup>
    import { computed, onMounted, ref} from 'vue';
    import { usePage, Link } from '@inertiajs/vue3';
    import { useUserStore } from '../stores/user'
    import HeadComp from './components/HeadComp.vue';

    const activeError = ref(null)

    //Pinia user.js
    const page = usePage();
    const userName = page.props.flash.userName
    const error = page.props.flash.error
    const userStore = useUserStore();
    if(!userStore.userData)
    {
        userStore.setUser(userName);
    }

    if(error){
        activeError.value = error
        console.log
    }
    




</script>

<template>

    <div class="wrapper">
    <HeadComp :activeError="activeError" />

    </div>



</template>

<style scoped>

.wrapper{
    width: 100vh;
    margin: 60px;
}


</style>