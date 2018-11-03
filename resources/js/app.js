/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vuetify from 'vuetify';
import App from './App.vue';
import router from './router';


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(Vuetify);

Vue.config.productionTip = false;

router.beforeEach((to, from, next) => {
    if (to.path == '/') {
        if(to.query.type == 'admin'){
            next('admin');
        }
        else if (to.query.type == 'secretaria'){
            next('secretaria');
        }
        else if (to.query.type == 'cliente'){
            next('cliente');
        }
        else{
            next('home');
        }
    } else {
        next();
    }
})

const app = new Vue({
    router,
    render: h => h(App)
}).$mount('#app')
