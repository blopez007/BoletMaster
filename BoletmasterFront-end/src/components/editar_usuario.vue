<template>
  <div class="text-center">
    <v-dialog v-model="dialog" width="500">
      <template v-slot:activator="{ on, attrs }">
        <button class="boton seis" @click="datosUser()">
          <span>Editar Perfil</span>
            <svg>
              <rect x="0" y="0" fill="none"></rect>
            </svg>
        </button>
      </template>

      <v-card style="background: #f6f6f6">
        <v-card-title class="fondo">
          <h3 class="white--text">Editar Perfil.</h3>
        </v-card-title>

        <v-card-text>
          <v-form>
            <v-text-field v-model="nombre" maxlength="70" :rules="textRules" label="Nombres" prepend-icon="mdi-rename-box"></v-text-field>
            <v-text-field v-model="apellido" maxlength="70" :rules="textRules" label="Apellidos" prepend-icon="mdi-rename-box"></v-text-field>
            <v-text-field v-model="correo" maxlength="70" :rules="emailRules" label="Correo" prepend-icon="mdi-email"></v-text-field>
            <v-text-field v-model="usuario" maxlength="70" :rules="textRules" label="Usuario" prepend-icon="mdi-rename-box"></v-text-field>

          </v-form>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="#406882" @click="actualizaruser()">
            <span class="white--text">Aceptar</span>
          </v-btn>

          <v-btn color="#406882" @click="dialog = false">
            <span class="white--text">Cancelar</span>
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>


<script>
import HTTP from '../utils/HTTP';
import { mapState } from "vuex";
export default {
  data() {
    return {
      dialog: false,
      nombre: "",
      apellido: "",
      correo: "",
      usuario: "",
      emailRules: [
        v => !!v || 'El correo es requerido',
        v => /.+@.+\..+/.test(v) || 'El correo no es valido',
      ],

      textRules: [
        v => !!v || 'El campo es requerido',
      ],

    }

  },
  computed: {
    ...mapState(["user"]),

  },
  methods: {
    datosUser() {
      this.dialog = true;
      this.nombre = this.user.name;
      this.apellido = this.user.apellido;
      this.correo = this.user.email;
      this.usuario = this.user.user
    },

    async actualizaruser() {

      const data = {
        nombre: this.nombre,
        apellido: this.apellido,
      };
      if (this.nombre === "" || this.apellido === "" || this.correo === "" || this.usuario === "") {
        this.$alert("Llene los campos solicitados", "AVISO", "warning", {
          confirmButtonText: "Aceptar",
        })
      }

      if (this.usuario !== this.user.user) {
        data["usuario"] = this.usuario
      }
      if (this.correo !== this.user.email) {
        data["email"] = this.correo
      }

      var response = await HTTP.put(`user/${this.user.id}`, data);
      this.$alert("Datos Actualizados.", "Realizado.", "success", {
          confirmButtonText: "OK",
      })
      this.dialog = false
    },
  }
}
</script>

<style scoped>
.fondo{
  background-color: #406882;
}

.boton {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 50%;
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
  margin-left: 0px;
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