import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import vuetify from './plugins/vuetify'
import VueSession from 'vue-session'

//alertas
import VueSimpleAlert from "vue-simple-alert";


Vue.use(VueSimpleAlert);
Vue.config.productionTip = false

Vue.use(VueSession, {persist:true});

new Vue({
  router,
  store,
  vuetify, 
  render: h => h(App)
}).$mount('#app')
