<script setup>
import {ref} from 'vue'
import { defineProps } from 'vue';

</script>

<template>
<div class="auth" >
        <form action="" method="post">
            <div class="title"><p>Вход</p></div>
            <input type="text" name="login" id="login" class="input login" placeholder="Логин" minlength="2" maxlength="255">
            <input type="password" name="password" id="password" class="input password" placeholder="Пароль" minlength="6" maxlength="255">  
            <input type="submit" value="Войти" class="submit">

            <div class="link_sign_up">
                <p>Ещё нет аккаунта?</p>
                <a href="#">Зарегистрироваться</a>
            </div>
            <a href="#">Забыли пароль?</a>
        </form>
    </div>

</template>

<style scoped>

.auth{
    margin-top: 100px;
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

form a:hover{
    color: var(--clr-accent);
}

</style>