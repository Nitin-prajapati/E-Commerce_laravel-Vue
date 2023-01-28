/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */



import * as Vue from 'vue'
window.Vue = Vue;
require('./bootstrap'); 


import {createApp} from 'vue';
import {createRouter, createWebHistory} from 'vue-router';





import {store} from './store';
import homepage from './components/GridView/HomePage.vue';
import cart from './components/Cart/cart.vue'
import registerPage from'./components/auth/register.vue'
import loginPage from './components/auth/login.vue'
import profile from './components/Profile/profile.vue'
import main from './App.vue'


const router = createRouter({
    history:createWebHistory(),
    routes:[
        {path:'/',component:homepage,name:'home'},
        {path:'/cart',component:cart,name:'cartPage'},
        {path:'/reg',component:registerPage,name:'registration'},
        {path:'/log',component:loginPage,name:'login'},
        {path:'/profile',component:profile,name:'profile'}
        
    ]
});





const app= createApp(main);
app.use(router);
app.use(store);
app.mount("#app");



