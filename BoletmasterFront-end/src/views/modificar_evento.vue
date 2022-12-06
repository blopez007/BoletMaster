<template>
  <v-container class="white">
    <v-container class="fondo1 campos">
      <v-row>
        <v-col cols="12" md="8">
          <v-container class="pa-0">
            <v-toolbar-title class="titulo">Informacion General del Evento </v-toolbar-title>
            <br />
            <br />
            <v-row>
              <v-col cols="12" md="6">
                <!--campos principales-->

                <v-text-field v-model="titulo" label="Titulo" prepend-icon="mdi-calendar-star" style="width: 100%"
                  outlined required></v-text-field>
                <v-text-field v-model="descripcion" label="Descripcion" prepend-icon="mdi-note-text-outline"
                  style="width: 100%" outlined required></v-text-field>
                  <v-img :src="imagen" style="" min-height="10vh" min-width="100%">
                  
                </v-img>
              </v-col>

              <v-col cols="12" md="6">
                <v-combobox multiple :item-value="(categoria) => categoria.id" :item-text="(categoria) => categoria.name"
                  v-model="categoriasSeleccionadas" :items="category" label="Categoria"
                  prepend-icon="mdi-playlist-minus" outlined></v-combobox>
                <v-text-field v-model="lugar" label="Lugar" prepend-icon="mdi-map-marker-outline" style="width: 100%"
                  outlined required></v-text-field>

                <v-dialog v-model="menu2" :close-on-content-click="false" :nudge-right="40"
                  transition="scale-transition" offset-y width="290px">
                  <!--fecha-->
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field v-model="fecha" label="Fecha" prepend-icon="mdi-calendar" style="width: 100%" readonly
                      outlined v-bind="attrs" v-on="on"></v-text-field>
                  </template>
                  <v-date-picker v-model="fecha" @input="menu2 = false" locale="es-sv"></v-date-picker>
                </v-dialog>
                <!-- Hora-->
                <v-dialog ref="dialog" v-model="modalhora" :return-value.sync="hora" persistent width="290px">
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field v-model="hora" label="Hora del evento" prepend-icon="mdi-clock-time-four-outline"
                      style="width: 100%" readonly outlined v-bind="attrs" v-on="on"></v-text-field>
                  </template>

                  <v-time-picker v-if="modalhora" v-model="hora" full-width>
                    <v-spacer></v-spacer>
                    <v-btn text color="primary" @click="modalhora = false">
                      Cancel
                    </v-btn>
                    <v-btn text color="primary" @click="$refs.dialog.save(hora)">
                      OK
                    </v-btn>
                  </v-time-picker>
                </v-dialog>
              </v-col>
            </v-row>
          </v-container>
        </v-col>

        <!-- entradas -->
        <v-col md="4">
          <v-toolbar-title class="titulo">Entradas del Evento</v-toolbar-title>
          <br />
          <br />
          <v-text-field v-model="tipoentrada" type="Text" label="Tipo de entrada" style="width: 100%" outlined required>
          </v-text-field>
          <v-text-field onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" counter maxlength="5"
            v-model="cantidad" label="Cantidad de entradas" style="width: 100%" outlined required></v-text-field>
          <v-text-field onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" counter maxlength="4"
            v-model="precio" label="Precio de la entrada" prefix="$" style="width: 100%" outlined required>
          </v-text-field>
          <v-btn :disabled="!valid" color="#1A374D" class="mr-4" @click="agregarentrada()">
            <span class="span">Añadir tipo de entrada</span>
          </v-btn>
          <br />
          <br />
          <v-container class="tabla">
            <v-simple-table>
              <thead>
                <tr>
                  <th>Tipo de entrada</th>
                  <th>Cantidad</th>
                  <th>Precio</th>
                  <th>Quitar</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(e, index) in entradas" :key="index">
                  <td>{{ e.tipo_entrada }}</td>
                  <td>{{ e.cantidad }}</td>
                  <td>${{ e.precio }}</td>
                  <td>
                    <v-btn @click="quitar(index)" color="#B1D0E0">
                      <v-icon>mdi-close-circle-outline</v-icon>
                    </v-btn>
                  </td>
                </tr>
              </tbody>
            </v-simple-table>
          </v-container>
        </v-col>
      </v-row>
    </v-container>
    <br />
    <div class="text-center">
      <v-btn :disabled="!valid" color="#1A374D" class="mr-4" @click="actualizarevento()">
        <span class="span">Guardar</span>
      </v-btn>

      <v-btn color="error" class="mr-4" @click="cancelar()"> Cancelar </v-btn>
    </div>
  </v-container>
</template>

<script>
import Vuex from "vuex";
import HTTP from "../utils/HTTP";
export default {
  data: () => ({
    valid: true,
    error: false,
    rules: [
      (value) =>
        !value ||
        value.size < 2000000 ||
        "Solo se permiten imagenes que pesen menos de 2 MB",
    ],


    //variables para los eventos
    entradas: [],
    categoriasSeleccionadas: [],
    imagen: "",
    titulo: "",
    descripcion: "",
    lugar: "",
    //variable para las entradas
    tipoentrada: "",
    cantidad: 0,
    precio: 0,

    //variable de los pickers
    fecha: null,
    modal: false,
    menu2: false,

    hora: null,
    modalhora: false,

    idevento: "",
    category: []
  }),
  methods: {

    //actualizar evento
    async actualizarevento() {
      const data = new FormData();
      data.append("titulo", this.titulo);
      data.append("descripcion", this.descripcion);
      //data.append("imagen", this.archivo);
      data.append("lugar", this.lugar);
      data.append("fecha_hora", this.fecha + " " + this.hora);
      data.append("entradas", JSON.stringify(this.entradas));
      data.append("categorias", JSON.stringify(this.categoriasSeleccionadas.map(categoria => categoria.id)));
      var response = await HTTP.post(`events/${this.idevento}`, data);

      this.$alert("Evento Modificado", "Aviso", "Succes", {
        confirmButtonText: "Ok",
      });
      this.$router.push("/administrador")
    },

    //quitar tipo de entrada
    quitar(index) {
      this.entradas.splice(index, 1);
    },

    camposvacios() {
      this.$alert("Llene los campos solicitados", "AVISO", "warning", {
        confirmButtonText: "Cerrar",
      }).then(() => console.log("Closed"));
    },
    cancelar() {
      this.$confirm(
        "Se descartaran los cambios.",
        "Question",
        "question"
      ).then((resultado) => {
        if (resultado === true) {
          this.$router.push("/administrador");
        }
      });
    },
    agregarentrada() {
      //validacion para no añadir entradas vacias
      if (this.tipoentrada === "" || this.cantidad === 0 || this.precio === 0)
        return;

      this.entradas.push({
        tipo_entrada: this.tipoentrada,
        cantidad: parseInt(this.cantidad),
        precio: parseFloat(this.precio),
      });
      this.tipoentrada = "";
      this.cantidad = 0;
      this.precio = 0;
    },
    
  },
  async beforeMount() {
    let id = this.$route.params.id;
    let response = await HTTP.get(`/event/${id}`);
    let event = response.data.data;
    this.idevento = event.id
    this.titulo = event.titulo
    this.descripcion = event.descripcion
    this.categoriasSeleccionadas = event.categorias
    this.lugar = event.lugar
    this.imagen = event.imagen
    let fechaHora = new Date(event.fecha_hora);

    let hora = fechaHora.getHours();
    let minutos = fechaHora.getMinutes();

    let dia = fechaHora.getDate();
    let mes = fechaHora.getMonth() + 1;
    let anio = fechaHora.getFullYear();

    this.hora = hora +":"+ minutos
    this.fecha = anio + "-" + mes + "-" + dia
    this.entradas = event.entradas
    response = await HTTP.get("/category");
    this.category = response.data.data;
  },
  
};
</script>
<style scoped>
.v-text-field {
  width: 400px;
}

.campos {
  border: solid #1a374d;
  text-align: center;
  background: #b1d0e0;
}

span {
  color: white;
}

.fondo1 {
  background-color: #f6f9f2;
}

.tabla {
  border: solid #1a374d;
}

.titulo {
  font-size: 25px;
  font-family: "Expletus Sans", cursive;
  text-align: center;
  line-height: 30px;
  color: white;
  background-color: #1a374d;
}

@import url("https://fonts.googleapis.com/css2?family=Expletus+Sans&display=swap");
</style>
