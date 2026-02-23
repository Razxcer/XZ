<script setup>
    import { onMounted, defineProps, ref, watch } from 'vue';
    import LogInModal from './LogInModal.vue';
    import { computed } from 'vue';
    import { usePage, Link } from '@inertiajs/vue3';
    import { useUserStore } from '../../stores/user';

    const error = ref(null)

    //Pinia user.js
    const userStore = useUserStore();
    const userName = ref(userStore.userData);

    const props = defineProps({
        activeError: String
    })

    console.log(props.activeError)
    watch(props.activeError, ()=>{
        if(props.activeError){
            error.value = props.activeError
            modalAuthIsActive.value = true
        }
    })

    //Кнопка вход
    const modalAuthIsActive = ref(false)
    const profileClick=()=>{
        modalAuthIsActive.value=!modalAuthIsActive.value
    }

    //Кнопка выход
    const quit = ()=>{
        userStore.setUser(null);
    }




</script>

<template>
    <div class="head">

        <div class="logo-panel">
            <Link href="/" class="logo-link">
                <div class="logo">XZ</div>
            </Link>
        </div>

        <div class="search-panel">
            <input type="text" name="search" id="search" class="search" placeholder="Поиск"/>
        </div>

        <div class="head-icons-panel">
            <div class="head-icon favorites">
                <Link href="/favorites"> 
                    <button class="head-button" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                        </svg>
                        <p>Избранное</p>
                    </button>
                </Link>
            </div>

            <div class="head-icon basket">
                <Link href="/basket"> 
                    <button class="head-button" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket2-fill" viewBox="0 0 16 16">
                        <path d="M5.929 1.757a.5.5 0 1 0-.858-.514L2.217 6H.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h.623l1.844 6.456A.75.75 0 0 0 3.69 15h8.622a.75.75 0 0 0 .722-.544L14.877 8h.623a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1.717L10.93 1.243a.5.5 0 1 0-.858.514L12.617 6H3.383zM4 10a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0zm4-1a1 1 0 0 1 1 1v2a1 1 0 1 1-2 0v-2a1 1 0 0 1 1-1"/>
                        </svg>
                        <p>Корзина</p>
                    </button>
                </Link>
            </div>

            <div class="head-icon dropdown-icon profile">   
                
                <Link href="/profile" v-if="userName" class="head-button dropdown-button" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-check" viewBox="0 0 16 16">
                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                    </svg>
                    <p>{{userName}}</p>
                </Link>

                <button v-else class="head-button dropdown-button" @click="profileClick" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                    </svg>
                    <p>Войти</p>
                </button>
            
                <div class="dropdown-content"> 
                    <Link class="link">Покупки</Link>  
                    <Link class="link">Настройки</Link>  
                    <Link @click="quit" class="link">Выйти</Link>
                </div>
            </div>
        </div>
    </div>

    <LogInModal class="auth z-100" v-if="modalAuthIsActive" :error />

</template>

<style scoped>
.head{
    position: fixed;
    width: 100%;
    height: 60px;
    background-color: var(--color-background-soft);
    display: flex;
    justify-content: left;
    top: 0;
    left: 0;
    box-shadow: 0px 0px 5px 5px var(--color-background);
    z-index: 999;
}

.logo-panel{
    width: 350px;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.search-panel{
    display: flex;
    align-items: center;
    justify-content: center;
    width: calc(100vw - 710px);
    height: 100%;
}

.head-icons-panel{
    width: 350px;
    height: 100%;
    display: flex; 
    align-items: center;
    justify-content: center; 
    gap: 25px;
}



.logo-link{
    height: 100%;
    display: flex;
    justify-self:left;
    justify-content: center;

}

.logo{
    align-self: center;
    text-align:  center;
    height: 90%;
    font-weight: bold;
    font-size: 50px;
    text-align: center;
    line-height: 1;
    color: var(--color-text);
}

.search{
    width: 95%;
    height: 70%;
    border-radius: 1.5em;
    border: none;
    align-self: center;
    background-color: var(--color-text);
    color: var(--color-background-soft);
    font-size: 26px;
    text-indent: 15px;
    opacity: 0.9;
}

.search:focus{
    box-shadow: 0px 0px 3px 2px var(--color-text);
    outline: none;
}

.head-icon{
    width: 60px;
    height: 60px;
}

.head-icon>link{
    border-radius: 1em;
}

.dropdown-icon{
    display: flex;
    flex-direction: column;
}


.head-button{
    width: 60px;
    height: 60px;
    margin: 0 auto;
    background-color: var(--color-background-soft);
    color: var(--color-text);
    border-style: none;
    opacity: 0.8;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content:end;
    gap: 0;
}

.head-button>svg{
    width: 30px;
    height: 30px;
}

.head-button>p{
    text-align: center;
    font-size: 12px;
    margin-bottom: 3px;
}

.dropdown-content{
    display: none;
    margin-top: 60px;
    flex-direction: column;
    position: absolute;
    background-color: var(--color-background-soft);
    padding: 2px 10px;
    /* box-shadow: 0px 0px 0px 0px var(--second-color); */
    z-index: 1;
    border-radius: 1em;
}

.dropdown-icon:hover .dropdown-content{
    display: flex;
}

.dropdown-content>link{
    color: var(--color-text);
    font-size: 16px;
    border-radius: 10%;
}

/* Теперь всё что связанно с авторизацией */

.auth{
    width: 500px;
    height: 500px;
    position: fixed;
    top: 0px;
    left: calc(50vw - 250px);

    animation-name: moveDown;
    animation-duration: 2s;
    animation-timing-function: ease;
}

@keyframes moveDown {
    0%{
        top: -600px;
    }
    100%{
        top: 0px;
    }
}







/* @media (min-width: 1024px) {
} */
</style>