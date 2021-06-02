import vueRouter from 'vue-router'
import Vue from 'vue'

import Main from './components/Main'
import ListProfiles from './components/ListProfiles.vue'
import Thrid from './components/Third.vue'
import Second from './components/Second.vue'

Vue.use(vueRouter)

const routes = [{
        path: '/',
        component: Main
    },
    {
        path: '/listprofiles',
        component: ListProfiles
    },
]

export default new vueRouter({
    mode: 'history',
    routes
})
