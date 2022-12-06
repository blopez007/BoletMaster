<template>

  <body>
    <div>
      <!-- Carrusel principal donde se visualizarán los banners de los eventos. -->
      <v-carousel cycle>
        <v-carousel-item v-for="(item, i) in eventoscarrucel" :key="i" :src="item.imagen" reverse-transition="fade-transition" transition="fade-transition">
        </v-carousel-item>
      </v-carousel>

      <v-container>
        <!-- Columnas donde se mostrarán los eventos destacados y próximos. -->
        <v-row>
          <!-- Columna donde se mostraran las tarjetas de los eventos destacados. -->
          <v-col cols="6">
            <h1 class="text-center">Destacados</h1>
            <div v-for="(evento, index) in destacados" :key="i">
              <tarjeta :evento="evento"></tarjeta>
            </div>
          </v-col>
          
          <!-- Columna donde se mostraran las tarjetas de los proximos eventos. -->
          <v-col cols="6">
            <h1 class="text-center">Proximos</h1>
            <div v-for="(evento, index) in proximos" :key="i">
              <tarjeta :evento="evento"></tarjeta>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </div>
    <v-container fill-height justify-center>
      <button class="boton seis" @click="vistaeventos()">
        	<span>Ir a todos los eventos.</span>
				<svg>
					<rect x="0" y="0" fill="none"></rect>
				</svg>
			</button>
    </v-container>
    <br />
    <br />
    <br />
  </body>
</template>
<script>
import tarjeta from "../components/tarjeta_de_inicio.vue";
import HTTP from '../utils/HTTP';
export default {
  name: "inicio",
  components: { tarjeta },
  data() {
    return {
      imagenes: [],
      eventos: [],
      proximos: [],
      destacados: [],
      eventoscarrucel: []
      
    };
  },
  methods: {
    vistaeventos() {
      this.$router.push("/eventos")
    }
  },
  async beforeMount(){
    let carrucel = await HTTP.get("/event")
    this.eventoscarrucel = carrucel.data.data
    let eventos = await HTTP.get("/event/inicio")
    this.proximos = eventos.data.data.proximos
    this.destacados = eventos.data.data.destacados
    
  }
};
</script>
<style scoped>
.boton {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 50%;
  height: 40px;
  background: #0935dc;
  color: #0935dc;
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
  margin-left: px;
}

.boton span {
  position: relative;
  z-index: 2;
  transition: 0.3s ease all;
}
.boton.seis {
  background: #1a374d;
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
  stroke: #b1d0e0;
  stroke-width: 10px;
  stroke-dasharray: 2000;
  stroke-dashoffset: 2000;
  transition: 0.6s ease all;
}

.boton.seis:hover rect {
  stroke-dashoffset: 0;
}
</style>