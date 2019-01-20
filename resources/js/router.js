import VueRouter from 'vue-router'
import Index from './components/Index.vue'
import Register from './components/Register.vue'
import Login from './components/Login.vue'
import Categories from './components/Categories.vue'
import Calc from './components/Calc.vue'
import Results from './components/Results.vue'

export default new VueRouter({
    routes: [
        {
            path: '',
            component: Index,
            name : 'home',

        },
        {
            path: '/login',
            component: Login,
            name : 'login',
            meta: {

                auth: false
            }
        },{
            path: '/register',
            component: Register,
            name : 'register',
            meta: {

                auth: false
            }
        },{
            path: '/categories',
            component: Categories,
            name : 'categories',
            meta: {

                auth: true
            }
        },{
            path: '/calc',
            component: Calc,
            name : 'calc',
            meta: {

                auth: true
            }
        },,{
            path: '/results',
            component: Results,
            name : 'results',
            meta: {

                auth: true
            }
        },
    ],
    mode: 'history'
})