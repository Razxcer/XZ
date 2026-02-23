<script setup>
    import { computed, onMounted, ref} from 'vue';
    import { usePage, Link, useForm } from '@inertiajs/vue3';
    import { useUserStore } from '../stores/user'
    import HeadComp from './components/HeadComp.vue';

    //Pinia user.js
    const page = usePage();
    const userName = page.props.flash.userName
    const error = page.props.flash.error
    const userStore = useUserStore();
    if(!userStore.userData)
    {
        userStore.setUser(userName);
    }

    const logInWin = ref(true)
    const regWin = ref(false)
    const errorInput = ref(null)
    const passwordRepeat = ref(null)

    //Поменять форму на регистрацию
    const openRegModal=()=>{
        logInWin.value = false
        regWin.value = true   
        error=null 
    }

    //Поменять форму на вход
    const openLogInModal=()=>{
        regWin.value = false
        logInWin.value = true
        error=null
    }

    //Форма для отправки в AuthController
    const form = useForm({
        action: '',
        name: '',
        email: '',
        password: '',
    })

    //Войти
    const submitLogIn=()=>{
        form.action = 'enter'
        form.post('/profile')
    }

    //Зарегистрироваться
    const submitReg=()=>{
        if(form.password != passwordRepeat.value){
            errorInput.value = "Пароли не совпадают!"
            return;
        }
        else{
            form.action = 'reg'
            form.post('/profile')
        }
    
    }


</script>

<template>

    <div class="wrapper">
        <HeadComp/>

        <div class="auth">
            <form v-if="logInWin" @submit.prevent="submitLogIn">
                <div class="title"><p>Вход</p></div>
                <input type="text" v-model="form.name"  name="login" id="login" class="input login" placeholder="Логин">
                <div v-if="form.errors.name" class="text-red-500 error">{{ form.errors.name }}</div>
                
                <input type="password" v-model="form.password" name="password" id="password" class="input password" placeholder="Пароль">
                <div v-if="form.errors.password" class="text-red-500 error">{{ form.errors.password }}</div>
                <div v-if="error" class="text-red-500 error">{{ error }}</div>

                <input type="submit" value="Войти" class="submit">

                <div class="link_sign_up">
                    <p>Ещё нет аккаунта?</p>
                    <a @click="openRegModal">Зарегистрироваться</a>
                </div>
                <a>Забыли пароль?</a>
            </form>

            <form v-if="regWin" @submit.prevent="submitReg">
                <div class="title"><p>Регистрация</p></div>

                <input type="text" v-model="form.name"  name="login" id="login" class="input login" placeholder="Логин">
                <div v-if="form.errors.name" class="text-red-500 error">{{ form.errors.name }}</div>

                <input type="text" v-model="form.email" name="email" id="email" class="input email" placeholder="Email">
                <div v-if="form.errors.email" class="text-red-500 error">{{ form.errors.email }}</div>

                <input type="password" v-model="form.password" name="password" id="password" class="input password" placeholder="Пароль">  
                <input type="password" v-model="passwordRepeat" name="password" id="password" class="input password" placeholder="Повторите пароль">
                <div v-if="form.errors.password" class="text-red-500 error">{{ form.errors.password }}</div>
                <div v-if="errorInput" class="text-red-500 error">{{ errorInput }}</div>
                <div v-if="errorDisplay" class="text-red-500 error">{{ error }}</div>

                <input type="submit" :disabled="form.processing" value="Зарегистрироваться" class="submit">

                <div class="link_sign_up">
                    <p>Уже есть аккаунт?</p>
                    <a @click="openLogInModal">Войти</a>
                </div>
            </form>
        </div>

    </div>



</template>

<style scoped>

.wrapper{
    width: 100%;
    margin-top: 60px;
    display: flex;
    justify-content: center;
}

.auth{
    margin-top: 30px;
    width: 600px;
    height: 500px;
    display: flex;
    justify-content: center;
    opacity: 0.97;
    background-color: var(--first-color);
    border-radius: 1.5em;
    box-shadow:0px 0px 10px;
    flex-wrap: wrap;    
}

.auth .title{
    width: 80%;
    height: 40px;
    margin: 5px auto;
    display: flex;
    justify-content: center;
    align-items: center;

    opacity: 0.8;
}

.title>p{
    color: var(--fifth-color);
    font-size: 3em;
    justify-content: center;
    font-weight: bold;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
}

form{
    width: 100%;
    height: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
}

.input{
    width: 70%;
    height: 30px;
    border: none;
    border-bottom: 5px solid var(--fifth-color);
    color: var(--fifth-color);
    background-color: rgba(111, 111, 111, 0);
    font-size: 22px;
    text-indent: 30px;
    padding-bottom: 4px;

    opacity: 0.8;
}

.input:autofill{
    color: var(--fifth-color);
    background-color: rgba(111, 111, 111, 0);
    font-size: 30px;
}

.input::placeholder{
    color: var(--fifth-color);
    font-size: 1em;
}

.input:focus{
    outline: none;
}

.submit{
    width: 55%;
    height: 40px;
    background-color: var(--second-color);
    color: var(--fifth-color);
    border-radius: 10px;
    font-size: 25px;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    font-weight: bold;
    transition: 0.3s;
    border: none;
    opacity: 0.8;
}

.submit:hover{
    transform: scale(1.3);
    transition: 0.3s;
    cursor: pointer;
}

.link_sign_up{
    width: 70%;
    display: flex;
    justify-content: space-between;
}

.link_sign_up>p{
    color: var(--clr-text);
    font-size: 16px;

    opacity: 0.8;
}

.link_sign_up>a{
    color: var(--clr-text);
    font-size: 16px;

    opacity: 0.8;
}

form>a{
    color: var(--clr-text);
    font-size: 18px;
    width: 70%;
    text-align: center;
    
    opacity: 0.8;
}

form a{
    cursor: pointer;
}

form a:hover{
    color: var(--clr-accent);
}

.error{
    height: 20px;
    width: 80%;
}

</style>