<template>
  <v-tabs vertical class="ma-3">
    <v-tab class="tabla">
      <v-icon left color="#1A374D"> mdi-calendar </v-icon>
      <h4 class="tab">Eventos</h4>
    </v-tab>
    <v-tab-item style="background: #f6f6f6">
      <admineventos></admineventos>
    </v-tab-item>
    <v-tab>
      <v-icon left color="#1A374D"> mdi-account-multiple </v-icon>
      <h4 class="tab">Usuarios</h4>
    </v-tab>
    <v-tab-item style="background: #f6f6f6">
      <v-col cols="12" md="11">
        <v-text-field v-model="buscar" label="Buscar" required></v-text-field>
        <h2 class="subtitulo">Lista de usuarios</h2>

        <v-switch color="#1a374d" fluid inset v-model="switch2" label="Usuarios Archivados" @click="obtenerusuarios()">
        </v-switch>

        <v-simple-table class="tabla">
          <template v-slot:default>
            <thead class="thead">
              <tr class="tr">
                <th class="text-md-center white--text">Nombre</th>
                <th class="text-md-center white--text">Correo</th>
                <th class="text-md-center white--text">Usuario</th>
                <th class="text-md-center white--text">Administrador</th>
                <th class="text-md-center white--text">Acciones</th>
              </tr>
              <tr class="tr" v-for="(usuario, index) in usuarios" :key="index">
                <td>{{ usuario.nombre }}</td>
                <td>{{ usuario.email }}</td>
                <td>{{ usuario.usuario }}</td>
                <td>
                  <v-checkbox v-model="usuario.rol"></v-checkbox>
                </td>
                <td>
                  <v-btn color="#1A374D" class="mr-4" rounded @click="editar(usuario)">
                    <v-icon color="white">mdi-pencil</v-icon>
                    <span>EDITAR</span>
                  </v-btn>
                  <v-btn color="red" class="mr-4" rounded @click="modificar(usuario.id)">
                    <v-icon color="white">mdi-delete</v-icon>
                    <span>ARCHIVAR</span>
                  </v-btn>
                </td>
              </tr>
            </thead>
            <tbody></tbody>
          </template>
        </v-simple-table>
      </v-col>
    </v-tab-item>

    <v-tab class="tabla">
      <v-icon left color="#1A374D"> mdi-chart-bar </v-icon>
      <h4 class="tab">Dashboard</h4>
    </v-tab>
    <v-tab-item style="background: #f6f6f6">
      <v-container>
        <br />
        <div>
          <h2 class="subtitulo2">
            Graficos con distintas representaciones de datos, todos para ayudar
            a generar mejores tomas de decisiones en BoletMaster.
          </h2>
        </div>
        <br />
        <div>
          <button class="boton reporte" @click="descargarReporte">
            <div class="icono">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-file-earmark-bar-graph" viewBox="0 0 16 16">
                <path
                  d="M10 13.5a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-6a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v6zm-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-1z" />
                <path
                  d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
              </svg>
            </div>
            <span>Reporte</span>
          </button>
        </div>
        <v-row>
          <v-col>
            <br />
            <br />
            <div>
              <Grafica1chart></Grafica1chart>
            </div>
          </v-col>
          <v-col>
            <br />
            <br />
            <div>
              <Graficachart></Graficachart>
            </div>
            <br />
            <br />
          </v-col>
        </v-row>
      </v-container>
    </v-tab-item>
  </v-tabs>
</template>
<script>
import HTTP from "../utils/HTTP";
import admineventos from "../components/administracion_eventos.vue";
import Graficachart from "../components/dashboard/graficachart.vue";
import Grafica1chart from "../components/dashboard/grafica1chart.vue";
import { mapMutations, mapState } from "vuex";

export default {
  name: "administrador",
  data: () => ({
    switch2: false,
    buscar: "",
    users: [],
    usuarios: [],
    switch2: false
  }),
  methods: {
    
    modificar(iduser) {
      this.$confirm(
        "Estas seguro de querer modificar uduario?.",
        "Confirmacion",
        "question"
      ).then((resultado) => {
        if (resultado === true) {
          var response = HTTP.delete(`/users/${iduser}`);
        }
      });
    },
    //eliminaruser
    async eliminaruser() {
      this.$confirm(
        "Estas seguro de eliminar este usuario?.",
        "Confirmacion",
        "question"
      ).then(() => { });
    },
    //modificar user

    editar(usuario) {
      this.$confirm(
        "Estas seguro de editar este usuario?.",
        "Confirmacion",
        "question"
      ).then((resultado,) => {
        if (resultado === true) {
          let data = {
            rol: usuario.rol
          };
          var response = HTTP.post(`/users/${usuario.id}/convertir`, data);
          this.$alert("Datos Actualizados.", "Realizado.", "success", {
            confirmButtonText: "OK",
          })
        }
      });
    },
    async descargarReporte() {
      let response = await HTTP.get("/report/ventas", {
        responseType: "blob",
      });
      let blob = new Blob([response.data], {
        type: "application/pdf",
      });
      let link = document.createElement("a");
      link.href = window.URL.createObjectURL(blob);
      link.download = "reporte-ventas.pdf";
      link.click();
    },
    async obtenerusuarios() {
      

      let filter = {
        //titulo: this.buscar,
        archivados: this.switch2 ? true : null,
        // fecha_fin: this.fechaFin,
        // fecha_inicio: this.fehca,
        //categorias: this.categorias
      }
      let users = await HTTP.get("/users", { params: filter })
      this.usuarios = users.data.data
    },

  },
  components: {
    admineventos,
    Grafica1chart,
    Graficachart,
  },
  computed: {
  ...mapState(["user"]),
},
  async beforeMount() {
    if(this.user.role !== 1){
      this.$router.push("/")
      console.log("jola1")
    }else{
    this.obtenerusuarios()
    }
  },
  mounted: {
  },
};
</script>
<style scoped>
span {
  color: white;
}

.span2 {
  color: black;
}

.subtitulo {
  font-size: 30px;
  font-family: "Expletus Sans", cursive;
  text-align: center;
  line-height: 80px;
}

.subtitulo2 {
  font-size: 15px;
  font-family: "Expletus Sans", cursive;
  text-align: center;
  line-height: 80px;
}

@import url("https://fonts.googleapis.com/css2?family=Expletus+Sans&display=swap");

.tabla {
  background-color: white;
  text-align: center;
  border-collapse: collapse;
  width: 100%;
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

.boton {
  display: inline-flex;
  margin-left: 462px;
  align-items: center;
  justify-content: center;
  width: 20%;
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

.boton.reporte span {
  transition: 0.4s ease-in-out all;
  position: absolute;
  color: #fff;
  left: 32%;
}

.boton.reporte .icono {
  display: flex;
  align-items: center;
  position: absolute;
  z-index: 2;
  left: -40px;
  transition: 0.3s ease-in-out all;
  opacity: 0;
}

.boton.reporte svg {
  color: #fff;
  width: 21px;
  height: 21px;
}

.boton.reporte:hover {
  background: #6998ab;
}

.boton.reporte:hover .icono {
  left: calc(100% - 50px);
  opacity: 1;
}

.boton.reporte:hover span {
  left: 20px;
}
</style>
