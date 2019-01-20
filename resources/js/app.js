
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('materialize-css');
window.Vue = require('vue');

import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import App from './components/App';
import router from './router';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

Vue.router = router

Vue.use(require('@websanova/vue-auth'), {

    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),

    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),

    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
    fetchData: {
        url : 'api/auth/user'
    },
    refreshData: {
        url : 'api/auth/refresh'
    }

});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
if(document.getElementById('app')) {
    const app = new Vue({
        el: '#app',
        render: h => h(App),
        router
    });
}

M.AutoInit();