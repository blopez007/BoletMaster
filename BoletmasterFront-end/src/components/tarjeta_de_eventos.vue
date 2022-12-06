<template>
  <v-card class="mx-auto my-12" max-width="374">
    <template slot="progress">
      <v-progress-linear color="deep-purple" height="10" indeterminate></v-progress-linear>
    </template>
    <v-img height="250" :src="evento.imagen"> </v-img>
    <v-card-title>{{ evento.titulo }}</v-card-title>
    <v-card-text>
      <v-row align="center" class="mx-0"> </v-row>
      <div class="my-4 text-subtitle-1">
        {{ evento.lugar }}
      </div>
      <div>{{evento.fecha_hora}}</div>
    </v-card-text>
    <v-divider class="mx-4"></v-divider>
    <v-card-title> Entradas Disponibles </v-card-title>
    <v-card-text>
    </v-card-text>
    <v-card-actions>
      <button class="boton comprar" @click="redireccionar()">
        <div class="icono">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3"
            viewBox="0 0 16 16">
            <path
              d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
          </svg>
        </div>
        <span> Comprar </span>
      </button>
    </v-card-actions>
  </v-card>
</template>
<script>

export default {
  name: "",
  props: ["evento"],
  data: () => ({
    value: false,
  }),
  computed: {
  },
  methods: {
    redireccionar(){
      this.$router.push({name: 'Comprar', params:{id: this.evento.id}})
    }
  },
};
</script>
<style scoped>
.boton {
  display: inline-flex;
  margin-left: 3px;
  align-items: center;
  justify-content: center;
  width: 103%;
  height: 40px;
  background: #1a374d;
  color: #000;
  font-family: "Roboto", sans-serif;
  font-size: 16px;
  font-weight: 500;
  border: none;
  cursor: pointer;
  text-transform: uppercase;
  transition: 0.3s ease all;
  border-radius: 5px;
  position: relative;
  overflow: hidden;
}

.boton.comprar span {
  transition: 0.4s ease-in-out all;
  position: absolute;
  color: #fff;
  left: 35%;
}

.boton.comprar .icono {
  display: flex;
  align-items: center;
  position: absolute;
  z-index: 2;
  left: -40px;
  transition: 0.3s ease-in-out all;
  opacity: 0;
}

.boton.comprar svg {
  color: #fff;
  width: 35px;
  height: 35px;
}

.boton.comprar:hover {
  background: #6998ab;
}

.boton.comprar:hover .icono {
  left: calc(100% - 50px);
  opacity: 1;
}

.boton.comprar:hover span {
  left: 20px;
}
</style>
