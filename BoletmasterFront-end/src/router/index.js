import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

const routes = [
{
    path: '/',
    name: 'Inicio',
    component: () => import(/* webpackChunkName: "Store" */ '../views/inicio.vue'),
    meta: {
      title: "Inicio",
    }
},
{
  path: '/eventos',
  name: 'Eventos',
  component: () => import(/* webpackChunkName: " Store"*/ '../views/eventos.vue'),
  meta:{
    title: 'Eventos'
  }
},


{
  path: '/comprar/:id',
  name: 'Comprar',
  component: () => import(/* webpackChunkName: " Store" */ '../views/comprar.vue'),
  meta:{
    title: 'Comprar'
  }
},
{
  path: '/login',
  name: 'login',
  component: () => import(/* webpackChunkName: "Store" */ '../views/login.vue'),
  meta:{
    title: 'Iniciar Sesion'
  }
},
{
  path: '/addevento',
  name: 'addevento',
  component: () => import(/* webpackChunkName: " Store" */ '../views/agregar_evento_vista.vue'),
  meta:{
    title: 'Agregar Eventos'
  }
},
{
  path: '/cookies',
  name: 'cookies',
  component: () => import(/* webpackChunkName: " Store" */ '../views/politica_de_cookies.vue'),
  meta:{
    title: 'Cookies',
  }
},
{
  path: '/privacidad',
  name: 'privacidad',
  component: () => import(/* webpackChunkName: " Store" */ '../views/politica_de_privacidad.vue'),
  meta:{
    title: 'Privacidad'
  }
},
{
  path: '/devolucion',
  name: 'devolucion',
  component: () => import(/* webpackChunkName: " Store" */ '../views/politica_de_devoluciones.vue'),
  meta:{
    title: 'Devolucion'
  }
},
{
  path: '/acerca',
  name: 'acerca',
  component: () => import(/* webpackChunkName: " Store" */ '../views/acerca_de_nosotros.vue'),
  meta:{
    title: 'Acerca de',
  }
},
{
  path: '/comocomprar',
  name: 'comocomprar',
  component: () => import(/* webpackChunkName: " Store" */ '../views/como_comprar.vue'),
  meta:{
    title: 'Como Comprar',
  }
},
{
  path: '/administrador',
  name: 'administrador',
  component: () => import(/* webpackChunkName: " Store" */ '../views/administrador.vue'),
  meta:{
    title: 'Administrador'
  }
},
{
  path: '/modificar/:id',
  name: 'modificar',
  component: () => import(/* webpackChunkName: " Store" */ '../views/modificar_evento.vue'),
  meta:{
    title: 'Modificar'
  }
  
},
{
  path: '/cuenta',
  name: 'cuenta',
  component: () => import(/* webpackChunkName: " Store" */ '../views/cuenta.vue'),
  meta:{
    title: 'Mi Cuenta',
  }
  
},

]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes

});
router.beforeEach((to, fron, next) => {
  document.title = `${to.meta.title}`;
  if (to.meta.admin) {
    if (localStorage.getItem("admin") == "true") {
      next();
    } else {
      next("/");
    }
  }
  next();
})

export default router
