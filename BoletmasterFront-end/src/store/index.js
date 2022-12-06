import Vue from 'vue'
import Vuex from 'vuex'
import HTTP from '../utils/HTTP'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    user: {
      id: '',
      name: '',
      apellido: '',
      email: '',
      role: '',
      user: '',
      logueado: false,
    }
  },
  mutations: {
    loguear(state, data) {
      state.user.id = data.id
      state.user.name = data.nombre
      state.user.apellido= data.apellido
      state.user.email = data.email
      state.user.role = data.rol
      state.user.user = data.usuario
      state.user.logueado = true
    },
    async logout(state) {
      state.user = {
        id: '',
        name: '',
        apellido: '',
        email: '',
        role: '',
        user: '',
        logueado: false,
      }
      

      try {
        HTTP.post('/auth/logout');
        localStorage.removeItem('token');

      } catch (error) {
        
      }
    },
  },
  actions: {

  },
  modules: {
  }
})
