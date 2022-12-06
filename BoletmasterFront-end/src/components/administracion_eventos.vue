<template>
  <div>
    <v-container class="">
      <v-row>
        <v-col md="3" class="hidden-md-and-down white--text filtro">
          <v-menu ref="menu" v-model="menu" :close-on-content-click="false" :return-value.sync="fecha"
            transition="scale-transition" offset-y min-width="auto">
            <template v-slot:activator="{ on, attrs }">
              <v-text-field class="subtitulo2" v-model="fecha" label="Fecha inicio" prepend-icon="mdi-calendar" readonly
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
              <v-text-field class="subtitulo2" v-model="fechaFin" label="Fecha fin" prepend-icon="mdi-calendar" readonly
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
          <v-card>
            <v-list flat>
              <v-subheader><span class="subtitulo1 black--text">Categoria</span></v-subheader>
              <v-list-item-group>
                <v-list-item v-for="(n, index) in categorias" :key="index">
                  <v-checkbox :label="n.name" v-model="categoriasSeleccionadas" :value="n.id" dense></v-checkbox>
                </v-list-item>
              </v-list-item-group>
            </v-list>
          </v-card>
          <br />
          <button class="boton1 seis" @click="obtenerEventos()">
            <span>Filtrar</span>
            <svg>
              <rect x="0" y="0" fill="none"></rect>
            </svg>
          </button>
          <br>
        <br>
          <button class="boton2 seis" @click="limpiarFiltros">
            <span>Limpiar Filtros</span>
            <svg>
              <rect x="0" y="0" fill="none"></rect>
            </svg>
          </button>
        </v-col>

        <v-col cols="12" md="9">
          <div>
            <v-row>
              <div>
                <h2 class="subtitulo" align="center">Listado de eventos</h2>
                <v-row><v-text-field class="" v-model="buscar" label="Buscar" required></v-text-field></v-row>
                <br>
                <br>
                <v-row align="center" justify="space-around">
                  <button class="boton evento" @click="agregar()">
                    <div class="icono">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-square" viewBox="0 0 16 16">
                        <path
                          d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                        <path
                          d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                      </svg>
                    </div>
                    <span>Agregar Evento</span>

                  </button>
                </v-row>
                <br>
                <v-row>
                  <v-switch class="centradoswicht" color="#1a374d" fluid inset v-model="switch1" @click="obtenerEventos()"
                    label="Eventos Archivados"> </v-switch>
                </v-row>
                <v-container>

                  <v-simple-table class="tabla">
                    <thead class="thead">
                      <tr class="tr">
                        <th class="text-md-center white--text">Titulo</th>
                        <th class="text-md-center white--text">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="tr" v-for="(evento, index) in eventos" :key="index">
                        <td>{{ evento.titulo }}</td>
                        <td>
                          <v-btn color="#1A374D" class="mr-4" rounded @click="editarevento(evento.id)">
                            <v-icon color="white">mdi-pencil</v-icon>
                            <span class="span">EDITAR</span>
                          </v-btn>
                          <v-btn color="red" class="mr-4" rounded @click="archivarevento(evento.id)">
                            <v-icon color="white">mdi-delete</v-icon>
                            <span class="span">ARCHIVAR</span>
                          </v-btn>
                        </td>
                      </tr>
                    </tbody>
                  </v-simple-table>
                </v-container>
              </div>
              <!--</v-form>-->
            </v-row>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
<script >
import agregarevento from "./agregarevento.vue";
import HTTP from '../utils/HTTP';
export default {
  props: ["evento"],
  components: { agregarevento },
  data: () => ({
    dialog: false,
    buscar: "",
    fecha: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
      .toISOString()
      .substr(0, 10),
    fechaFin: null,
    menu: false,
    menu2: false,
    categorias: [],
    dialog: false,
    menu3: false,
    comprobantes: [],
    events: [],
    eventos: [],
    switch1: false,
    categoriasSeleccionadas: [],
  }),
  methods: {
    editarevento(idevento) {
      this.$confirm(
        "Estas seguro de que desea editar este evento?.",
        "Confirmacion",
        "question"
      ).then((resultado) => {
        if (resultado === true) 
        this.$router.push({name: 'modificar', params:{id: idevento}});
        //this.$router.push(`/modificar/${idevento}`);
      });
    },
    agregar() {
      this.$router.push("/addevento");
    },

    //eliminar evento
    archivarevento(idevento) {
      this.$confirm(
        "Estas seguro de editar este usuario?.",
        "Confirmacion",
        "question"
      ).then((resultado) => {
        if (resultado === true) {
          var response = HTTP.delete(`/events/${idevento}`);
          this.$alert("evento archivado",  "Succes",{
        confirmButtonText: "OK",
      })
        }
      });
    },
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
      let response = await HTTP.get("/events/listarAdministracion", { params: payload });
      this.eventos = response.data.data;
    },
    limpiarFiltros() {
      this.buscar = "";
      this.fechaFin = null;
      this.categoriasSeleccionadas = [];
      this.fecha = new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10);
        this.obtenerEventos()
    },

    async obtenerEventos() {
      let filter = {
        titulo: this.buscar ? this.buscar: null,
        archivados: this.switch1 ? true : null,
        fecha_fin: this.fechaFin ? this.fechaFin: null,
        fecha_inicio: this.fehca? this.fecha: null,
        categorias: this.categorias ? this.categoriasSeleccionadas : null
      }
      let events = await HTTP.get("/events/listarAdministracion", { params: filter })
      this.eventos = events.data.data
    },

  },
  async beforeMount() {
    this.obtenerEventos()
    let response = await HTTP.get("/category");
    this.categorias = response.data.data;
  }
  // computed: {

  // },
};
</script>
<style scoped>
.tabla {
  background-color: white;
  text-align: center;
  border-collapse: collapse;
  width: 100%;
  margin-right: 200px;
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

.thead {
  background-color: #406882;
  border-bottom: solid 100px #000;
  color: white;
}

.tr:nth-child(even) {
  background-color: #ddd;
}

.tr:hover td {
  background-color: #6998ab;
  color: white;
}

.span {
  color: white;
}

.subtitulo {
  font-size: 30px;
  font-family: "Expletus Sans", cursive;
  text-align: center;
  line-height: 80px;
}

@import url("https://fonts.googleapis.com/css2?family=Expletus+Sans&display=swap");

.centradoswicht {
  margin-left: 26px;
}

.boton {
  display: inline-flex;
  margin-left: 0px;
  align-items: center;
  justify-content: center;
  width: 40%;
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

.boton.evento span {
  transition: 0.4s ease-in-out all;
  position: absolute;
  color: #fff;
  left: 25%;
}

.boton.evento .icono {
  display: flex;
  align-items: center;
  position: absolute;
  z-index: 2;
  left: -40px;
  transition: 0.3s ease-in-out all;
  opacity: 0;
}

.boton.evento svg {
  color: #fff;
  width: 22px;
  height: 22px;
}

.boton.evento:hover {
  background: #6998ab;
}

.boton.evento:hover .icono {
  left: calc(100% - 50px);
  opacity: 1;
}

.boton.evento:hover span {
  left: 20px;
}


.boton1 {
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

.boton1 span {
  position: relative;
  z-index: 2;
  transition: 0.3s ease all;
}

.boton1.seis {
  background: #1a374d;
  color: #fff;
}

.boton1.seis svg {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  fill: none;
}

.boton1.seis rect {
  width: 100%;
  height: 100%;
  stroke: #b1d0e0;
  stroke-width: 10px;
  stroke-dasharray: 1000;
  stroke-dashoffset: 1000;
  transition: 0.6s ease all;
}

.boton1.seis:hover rect {
  stroke-dashoffset: 0;
}



.boton2 {
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

.boton2 span {
  position: relative;
  z-index: 2;
  transition: 0.3s ease all;
}

.boton2.seis {
  background: #1a374d;
  color: #fff;
}

.boton2.seis svg {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  fill: none;
}

.boton2.seis rect {
  width: 100%;
  height: 100%;
  stroke: #b1d0e0;
  stroke-width: 10px;
  stroke-dasharray: 1000;
  stroke-dashoffset: 1000;
  transition: 0.6s ease all;
}

.boton2.seis:hover rect {
  stroke-dashoffset: 0;
}
</style>