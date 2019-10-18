import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


import AllGrupos from './components/AllGrupos.vue';
import AddGrupo from './components/AddGrupo.vue';
import EditGrupo from './components/EditGrupo.vue';
//import Directores from './components/Directores.vue';
export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllGrupos
    },
    {
        name: 'add',
        path: '/add',
        component: AddGrupo
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditGrupo
    },


];