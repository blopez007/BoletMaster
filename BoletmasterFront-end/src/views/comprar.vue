<template>
  <v-row justify="space-around pt-3">
    <v-card width="1500">
      <v-img height="400px" :src="evento.imagen"> </v-img>
    </v-card>

    <v-card elevation="24" class="mt-n16" width="70vw">
      <div style="background-color: #f5f5f5">
        <v-container>
          <v-row>
            <v-col cols="12">
              <v-stepper v-model="e1">
                <v-stepper-header>
                  <v-stepper-step color="#1A374D" :complete="e1 > 1" step="1">
                    <span class="subtitulo1">Seleccionar entradas</span>
                  </v-stepper-step>

                  <v-divider></v-divider>

                  <v-stepper-step class="subtitulo1" color="#1A374D" :complete="e1 > 2" step="2">
                    Rellenar datos
                  </v-stepper-step>

                  <v-divider></v-divider>

                  <v-stepper-step class="subtitulo1" color="#1A374D" step="3">
                    Confirmacion de pago
                  </v-stepper-step>
                </v-stepper-header>

                <v-stepper-items>
                  <v-stepper-content step="1">
                    <v-container>
                      <p class="text-center subtitulo">{{ evento.titulo }}</p>
                      <p class="text-center subtitulo">
                        {{ evento.descripcion }}
                      </p>
                      <v-simple-table>
                        <thead class="thead">
                          <tr class="tr">
                            <th class="text-md-center white--text">
                              Tipo de Entrada
                            </th>
                            <th class="text-md-center white--text">Cantidad</th>
                            <th class="text-md-center white--text">Costo</th>
                            <th class="text-md-center white--text">Subtotal</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="tr" v-for="(entrada, index) in evento.entradas" :key="index">
                            <td class="td">{{ entrada.tipo_entrada }}</td>
                            <td>
                              <cantentrada :cantidad="entrada.cantidad" @agregarEntrada="agregarEntrada(entrada)"
                                @quitarEntrada="quitarEntrada(entrada)" />
                            </td>
                            <td class="td">${{ entrada.precio }}</td>
                            <td class="td">
                              ${{ entrada.cantidad * entrada.precio }}
                            </td>
                          </tr>
                        </tbody>
                      </v-simple-table>
                      <br />
                    </v-container>

                    <button class="boton seis5" @click="siguiente()">
                      <span>Siguiente</span>
                      <svg>
                        <rect x="0" y="0" fill="none"></rect>
                      </svg>
                    </button>
                    <br />
                    <br />
                  </v-stepper-content>

                  <v-stepper-content class="text-center subtitulo" step="2">
                    Informacion de pago.
                    <v-container>
                      <v-text-field disabled outlined v-model="nombre" label="Nombre"
                        prepend-icon="mdi-card-account-details-outline"></v-text-field>
                      <v-text-field disabled outlined v-model="correo" label="Correo" prepend-icon="mdi-email-outline">
                      </v-text-field>
                      <v-text-field onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" counter
                        maxlength="16" hint="Maximo 16 carcteres permitidos" :rules="[rules.required, rules.min]" outlined v-model="tarjeta"
                        label="Tarjeta de Credito" prepend-icon="mdi-credit-card-multiple-outline"></v-text-field>

                      <v-dialog v-model="menu2" :close-on-content-click="false" :nudge-right="40"
                        transition="scale-transition" offset-y width="290px">
                        <template v-slot:activator="{ on, attrs }">
                          <v-text-field v-model="caducidad" label="MM/AA" prepend-icon="mdi-calendar"
                            style="width: 100%" readonly outlined v-bind="attrs" v-on="on"></v-text-field>
                        </template>
                        <v-date-picker v-model="caducidad" type="month" @input="menu2 = false" locale="es-sv">
                        </v-date-picker>
                      </v-dialog>
                      <v-text-field onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" counter
                        maxlength="3" hint="Maximo 3 caracteres permitidos" :rules="[cvcrules.required, cvcrules.min]" outlined v-model="cvc" label="CVC"
                        prepend-icon="mdi-credit-card-chip-outline"></v-text-field>
                    </v-container>
                    <button class="boton seis" @click="e1 = 1">
                      Anterior
                      <svg>
                        <rect x="0" y="0" fill="none"></rect>
                      </svg>
                    </button>
                    <button class="boton seis1" @click="siguiente2()">
                      Siguiente
                      <svg>
                        <rect x="0" y="0" fill="none"></rect>
                      </svg>
                    </button>
                  </v-stepper-content>

                  <v-stepper-content step="3">
                    <v-row>
                      <v-container>
                        <v-toolbar-title class="titulo">RESUMEN DE PEDIDO.</v-toolbar-title>
                        <br />
                        <br />
                        <span class="textoticket text-center">{{ nombre }}, gracias por comprar contenido de
                          entretenimiento en Bolet Master.
                        </span>
                        <br />
                        <br />
                        <span class="textoticket text-center">
                          A nombre de: {{ nombre }}
                        </span>
                        <br />
                        <br />
                        <span class="textoticket">Correo: {{ correo }}</span>
                        <br />
                        <br />
                        <span class="textoticket">Fecha: {{ fecha_compra }}</span>
                        <br />
                        <br />
                        <v-toolbar-title class="titulo1"><span>TOTAL A PAGAR: $ </span>
                          {{ total }}
                        </v-toolbar-title>
                      </v-container>
                    </v-row>
                    <br />
                    <br />
                    <br />
                    <v-container>
                      <v-row>
                        <button class="boton seis2" @click="e1 = 2">
                          Anterior
                          <svg>
                            <rect x="0" y="0" fill="none"></rect>
                          </svg>
                        </button>

                        <button class="boton seis4" @click="comprar()">
                          Realizar Pago
                          <svg>
                            <rect x="0" y="0" fill="none"></rect>
                          </svg>
                        </button>
                      </v-row>
                    </v-container>
                  </v-stepper-content>
                </v-stepper-items>
              </v-stepper>
            </v-col>
          </v-row>
        </v-container>
      </div>
    </v-card>
  </v-row>
</template>
<script>

import cantentrada from "../components/cantentrada.vue";
import Vuex from "vuex";
import HTTP from "../utils/HTTP";

export default {
  name: "privacidad",
  data() {
    return {
      e1: 1,
      evento: {
        titulo: "",
        id: "",
        descripcion: "",
        categorias: [],
        fecha_hora: "",
        imagen: "",
        lugar: "",
        entradas: [],
      },
      nombre: "",
      correo: "",
      tarjeta: "",
      cvc: "",
      menu2: false,
      sum: 0,
      caducidad: null,
      rules: {
      required: (value) => !!value || "Campo Requerido.",
      min: (v) => v.length >= 16 || "Minimo 16 Caracteres.",
    },

    cvcrules: {
      required: (value) => !!value || "Campo Requerido.",
      min: (v) => v.length >= 3 || "Minimo 3 Caracteres.",
    },
    };
  },
  components: { cantentrada },
  computed: {
    ...Vuex.mapState(["user"]),
    total() {
      return this.evento.entradas.reduce(
        (sum, entrada) => sum + entrada.cantidad * entrada.precio,
        0
      );
    },
    fecha_compra() {
      var date = new Date();
      var year = date.getFullYear();
      var month = (1 + date.getMonth()).toString();
      month = month.length > 1 ? month : "0" + month;
      var day = date.getDate().toString();
      day = day.length > 1 ? day : "0" + day;
      return day + "-" + month + "-" + year;
    },
  },
  methods: {
    async comprar() {
      let id_evento = this.evento.id;
      let entradas = this.evento.entradas.filter(entrada => entrada.cantidad > 0).map((entrada) => {
        return {
          id: entrada.id,
          cantidad: entrada.cantidad,
        };
      });

      let response = await HTTP.post("/voucher/comprar", {
        id_evento,
        entradas,
      });

      if (this.$alert("Compra realizada satisfactorirmente",  "Succes",{
        confirmButtonText: "OK",
      })
      );
      this.$router.push("/cuenta")
    },
    camposvacios() {
      this.$alert("Llene los campos solicitados", "AVISO", "warning", {
        confirmButtonText: "Cerrar",
      }).then(() => console.log("Closed"));
    },

    siguiente() {
      if (this.evento.entradas.some((entrada) => entrada.cantidad > 0)) {
        if (this.e1 !== 3) {
          this.e1++;
        }
      }
    },

    siguiente2() {
      if (this.nombre === "" || this.correo === "" || this.tarjeta === "" || this.cvc === "" || this.caducidad === null || this.tarjeta.length < 16 || this.cvc.length < 3) {
        this.camposvacios();
      } else {
        this.e1++;
      }
    },
    anterior() {
      if (this.e1 !== 1) {
        this.e1--;
      }
    },
    agregarEntrada(entrada) {
      entrada.cantidad++;
    },
    quitarEntrada(entrada) {
      if (entrada.cantidad > 0) {
        entrada.cantidad--;
      }
    },
  },
  async beforeMount() {
    let id = this.$route.params.id;
    let response = await HTTP.get(`/event/${id}`);
    let evento = response.data.data;
    this.nombre = this.user.name + " " + this.user.apellido;
    this.correo = this.user.email;
    evento.entradas = evento.entradas.map((entrada) => {
      entrada.cantidad = 0;
      return entrada;
    });
    this.evento = evento;
  },
};
</script>
<style scoped>
.encabezado {
  color: #fff;
  margin: 0 auto;
  text-align: center;
  font-weight: 700;
  font: italic bold 100px Georgia, Serif;
  text-shadow: -4px 3px 0 #34d16e, -14px 7px 0 #0a0e27;
}

.subtitulo {
  font-size: 25px;
  font-family: "Expletus Sans", cursive;
  text-align: justify;
  line-height: 30px;
}

.subtitulo1 {
  font-size: 20px;
  font-family: "Arial", cursive;
  text-align: justify;
  line-height: 10px;
}

.textoticket {
  font-size: 22px;
  font-family: "Arial";
  text-align: center;
  line-height: 10px;
}

.titulo {
  font-size: 25px;
  font-family: "Expletus Sans", cursive;
  text-align: center;
  line-height: 30px;
  color: white;
  background-color: #1a374d;
}

.titulo1 {
  font-size: 25px;
  font-family: "Expletus Sans", cursive;
  text-align: center;
  line-height: 30px;
  color: white;
  background-color: black;
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
  align-items: center;
  justify-content: center;
  width: 20%;
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

.boton.seis1 {
  background: #1a374d;
  color: #fff;
  margin-left: 35px;
}

.boton.seis1 svg {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  fill: none;
}

.boton.seis1 rect {
  width: 100%;
  height: 100%;
  stroke: #b1d0e0;
  stroke-width: 10px;
  stroke-dasharray: 1000;
  stroke-dashoffset: 1000;
  transition: 0.6s ease all;
}

.boton.seis1:hover rect {
  stroke-dashoffset: 0;
}

.boton.seis2 {
  background: #1a374d;
  color: #fff;
  margin-left: 271px;
}

.boton.seis2 svg {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  fill: none;
}

.boton.seis2 rect {
  width: 100%;
  height: 100%;
  stroke: #b1d0e0;
  stroke-width: 10px;
  stroke-dasharray: 1000;
  stroke-dashoffset: 1000;
  transition: 0.6s ease all;
}

.boton.seis2:hover rect {
  stroke-dashoffset: 0;
}

.boton.seis5 {
  background: #1a374d;
  color: #fff;
  margin-left: 730px;
}

.boton.seis5 svg {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  fill: none;
}

.boton.seis5 rect {
  width: 100%;
  height: 100%;
  stroke: #b1d0e0;
  stroke-width: 10px;
  stroke-dasharray: 1000;
  stroke-dashoffset: 1000;
  transition: 0.6s ease all;
}

.boton.seis5:hover rect {
  stroke-dashoffset: 0;
}

.boton.seis4 {
  background: #1a374d;
  color: #fff;
  margin-left: 35px;
}

.boton.seis4 svg {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  fill: none;
}

.boton.seis4 rect {
  width: 100%;
  height: 100%;
  stroke: #b1d0e0;
  stroke-width: 10px;
  stroke-dasharray: 1000;
  stroke-dashoffset: 1000;
  transition: 0.6s ease all;
}

.boton.seis4:hover rect {
  stroke-dashoffset: 0;
}

.boton {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 20%;
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
}
</style>
