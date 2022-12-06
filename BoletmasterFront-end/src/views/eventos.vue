<template>
  <div>
    <br />
    <v-container>
      <v-row>
        <v-col md="3" class="hidden-md-and-down white--text filtro">
          <v-menu ref="menu" v-model="menu" :close-on-content-click="false" :return-value.sync="fecha"
            transition="scale-transition" offset-y min-width="auto">
            <template v-slot:activator="{ on, attrs }">
              <v-text-field class="" v-model="fecha" label="Fecha inicio" prepend-icon="mdi-calendar" readonly
                v-bind="attrs" v-on="on"></v-text-field>
            </template>
            <v-date-picker v-model="fecha" no-title scrollable>
              <v-spacer></v-spacer>
              <v-btn text color="primary" @click="menu = false"> Cancel </v-btn>
              <v-btn text color="primary" @click="$refs.menu.save(fecha)">
                OK
              </v-btn>
            </v-date-picker>
          </v-menu>
          <v-menu ref="menu2" v-model="menu2" :close-on-content-click="false" :return-value.sync="fechaFin"
            transition="scale-transition" offset-y min-width="auto">
            <template v-slot:activator="{ on, attrs }">
              <v-text-field class="" v-model="fechaFin" label="Fecha fin" prepend-icon="mdi-calendar" readonly
                v-bind="attrs" v-on="on"></v-text-field>
            </template>
            <v-date-picker v-model="fechaFin" no-title scrollable>
              <v-spacer></v-spacer>
              <v-btn text color="primary" @click="menu2 = false">
                Cancel
              </v-btn>
              <v-btn text color="primary" @click="$refs.menu2.save(fechaFin)">
                OK
              </v-btn>
            </v-date-picker>
          </v-menu>
          <v-card outlined>
            <v-list flat>
              <v-subheader><span class="black--text">Categoria</span></v-subheader>
              <v-list-item-group>
                <v-list-item v-for="(n, index) in categorias" :key="index">
                  <v-checkbox :label="n.name" v-model="categoriasSeleccionadas" :value="n" dense></v-checkbox>
                </v-list-item>
              </v-list-item-group>
            </v-list>
          </v-card>
          <br />
          <button class="boton seis" @click="filtrar">
            <span>Filtrar</span>
            <svg>
              <rect x="0" y="0" fill="none"></rect>
            </svg>
          </button>
          <br>
          <br>
          <button class="boton seis" @click="limpiarFiltros">
            <span>Limpiar filtros</span>
            <svg>
              <rect x="0" y="0" fill="none"></rect>
            </svg>
          </button>
        </v-col>


        <v-col cols="12" md="9" class="">
          <v-text-field class="" v-model="buscar" label="Buscar" required></v-text-field>
          <v-row>
            <v-col v-for="(evento, index) in eventos" v-bind:key="index" cols="6" md="4">
              <cardevento :evento="evento"></cardevento>
            </v-col>
          </v-row>
        </v-col>
      </v-row>

    </v-container>
    <div class="text-center">
      <v-pagination v-model="paginacion.current_page" circle :length="paginacion.last_page"
        @input="onPageChange"></v-pagination>
    </div>
  </div>
</template>

<script>
import HTTP from "../utils/HTTP";
import cardevento from "../components/tarjeta_de_eventos.vue"; //Se importa el diseño de las tarjetas de lista de eventos desde el componente "tarjeta_de_eventos.vue"

export default {
  name: "eventos",
  components: { cardevento },
  data() {
    return {
      //Visualización de los todos los eventos.
      buscar: "",
      dialog: false,
      eventos: [],
      //Datapicker implementado para los filtros de fechas.
      fecha: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
      fechaFin: null,
      menu: false,
      menu2: false,
      categorias: [],
      categoriasSeleccionadas: [],
      paginacion: {
        per_page: 15,
        current_page: 1,
        last_page: 1,
        total: 0,
        to: 0,
      },
    };
  },

  computed: {},
  //Métodos implementados para el funcionamiento de los filtros de búsqueda.
  methods: {
    async filtrar() {
      let categorias = this.categoriasSeleccionadas.map(
        (categoria) => categoria.id
      );

      let fecha = this.fecha;
      let fechaFin = this.fechaFin;
      let buscar = this.buscar;
      let payload = {
        titulo: buscar ? buscar : null,
        fecha_inicio: fecha,
        fecha_fin: fechaFin ? fechaFin : null,
        categorias: categorias,
      };
      let response = await HTTP.get("/event", { params: payload });
      this.eventos = response.data.data;
    },

    async limpiarFiltros() {
      this.buscar = "";
      this.fechaFin = null;
      this.categoriasSeleccionadas = [];
      this.fecha = new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10);
      let response = await HTTP.get("/event");
      this.eventos = response.data.data;
    },

    async onPageChange() {
      let response = await HTTP.get("/event", {
        params: { page: this.paginacion.current_page, },
      });
      this.eventos = response.data.data;
    },
  },

  async beforeMount() {
    let response = await HTTP.get("/event");
    this.eventos = response.data.data;
    this.paginacion = response.data.meta;
    response = await HTTP.get("/category");
    this.categorias = response.data.data;
  },
};

</script>
<style scoped>
.boton {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 60%;
  height: 40px;
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
  stroke-dasharray: 1000;
  stroke-dashoffset: 1000;
  transition: 0.6s ease all;
}

.boton.seis:hover rect {
  stroke-dashoffset: 0;
}
</style>