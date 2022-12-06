<template>
  <div>
    <v-app-bar color="#1A374D" height="95">
      <v-toolbar-title><img :src="require('../assets/cilo.png')" class="" height="120" /></v-toolbar-title>

      <v-btn text class="hidden-md-and-down white--text" active-class="no-active" to="/">Inicio</v-btn>
      <v-btn text class="hidden-md-and-down white--text" active-class="no-active" to="/eventos">Eventos</v-btn>
      <v-btn text class="hidden-md-and-down white--text" active-class="no-active" to="/administrador"  v-if="(user.role === 1)">Administrar
      </v-btn>


      <v-spacer></v-spacer>
      <v-menu offset-y>
        <template v-slot:activator="{ on, attrs }">
          <v-btn rounded text class="hidden-md-and-down white--text" v-bind="attrs" v-on="on" active-class="no-active"
            @click="iniciar()">
            <span v-if="!user.logueado">Iniciar Sesion</span>
            <span v-else>
              <v-icon size="40px">mdi-account</v-icon>{{ user.name }}
            </span>
          </v-btn>
        </template>
        <v-list  color="#406882" dense round v-if="user.logueado">
          <v-list-item>
            <v-icon color="white">mdi-account-edit</v-icon>
            <v-list-item @click="cuenta()"><span class="white--text">Cuenta</span></v-list-item>
          </v-list-item>
          <v-list-item>
            <v-icon color="white">mdi-logout</v-icon>
            <v-list-item @click="logout2()"><span class="white--text">Cerrar Sesion</span></v-list-item>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-app-bar>
  </div>
</template>


<script>
import { mapMutations, mapState } from "vuex";

export default {
  name: "barra",
  data: () => ({
  }),
  computed: {
    ...mapState(["user"]),
  },
  methods: {
    iniciar() {
      if (this.user.logueado === true) return;
      this.$router.push("/login");
    },

    async cuenta() {
     await this.$router.push('/cuenta')
    },

    logout2() {
      this.logout()
      this.$router.push("/");

    },
    ...mapMutations(['logout'])
  },
};
</script>

<style scoped>
.boton {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 115%;
  height: 40px;
  margin-left: -25px;
  background: #0935dc;
  color: #0935dc;
  font-family: "Roboto", sans-serif;
  font-size: 12px;
  font-weight: 1000;
  border: 1000px;
  cursor: pointer;
  text-transform: uppercase;
  transition: 0.3s ease all;
  border-radius: 5px;
  position: relative;
  overflow: hidden;
}

.boton span {
  position: relative;
  z-index: 2;
  transition: 0.3s ease all;
}

.boton.seis {
  background: #406882;
  color: #fff;
}

.boton.seis svg {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  fill: none;
}

.boton.seis rect {
  width: 100%;
  height: 100%;
  stroke: #000000;
  stroke-width: 10px;
  stroke-dasharray: 1000;
  stroke-dashoffset: 1000;
  transition: 0.6s ease all;
}

.boton.seis:hover rect {
  stroke-dashoffset: 0;
}

.boton.flotante {
  position: left;
  margin-right: 35px;
  margin-left: -20px;
  border-radius: 100px;
}

.titulo {
  font-size: 25px;
  font-family: "Expletus Sans", cursive;
  text-align: center;
  line-height: 30px;
  color: white;
}

.subtitulo {
  font-size: 15px;
  font-family: "Expletus Sans", cursive;
  text-align: center;
  line-height: 30px;
  color: #406882;
}

.tabla {
  background-color: white;
  text-align: center;
  border-collapse: collapse;
  width: 100%;
}

.thead {
  background-color: #406882;
  border-bottom: solid 100px #000;
  color: white;
}

.th {
  padding: 20px;
  text-align: center;
  color: white;
}

.td {
  padding: 20px;
  text-align: center;
}

.tr:nth-child(even) {
  background-color: #ddd;
}

.tr:hover td {
  background-color: #6998ab;
  color: white;
}

.fondo{
color: #406882;

}

@import url("https://fonts.googleapis.com/css2?family=Expletus+Sans&display=swap");
</style>
