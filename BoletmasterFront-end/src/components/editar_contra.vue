<template>
  <div class="text-center">
    <v-dialog v-model="dialog" width="500">
      <template v-slot:activator="{ on, attrs }">
        <button class="boton seis" dark v-bind="attrs" v-on="on">
          <span>Editar Contraseña.</span>
          <svg>
            <rect x="0" y="0" fill="none"></rect>
          </svg>
        </button>
      </template>

      <v-card style="background: #f6f6f6">
        <v-card-title class="fondo">
          <h3 class="white--text">Cambio de Contraseña.</h3>
        </v-card-title>

        <v-card-text>
          <v-form>
            <v-text-field v-model="oldpassword" maxlength="50" :rules="[rules.required, rules.min]" @click:append="show1 = !show1" :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'" :type="show1 ? 'text' : 'password'" label="Contraseña Actual" prepend-icon="mdi-lock-minus"></v-text-field>
            <v-text-field v-model="newpassword1" maxlength="50" :rules="[rules.required, rules.min]" @click:append="show4 = !show4" :append-icon="show4 ? 'mdi-eye' : 'mdi-eye-off'" :type="show4 ? 'text' : 'password'" label="Contraseña Nueva" prepend-icon="mdi-lock-plus"></v-text-field>
            <v-text-field v-model="newpassword2" maxlength="50" :rules="[rules.required, rules.min]" @click:append="show5 = !show5" :append-icon="show5 ? 'mdi-eye' : 'mdi-eye-off'" :type="show5 ? 'text' : 'password'" label="Confirmar Contraseña Nueva"
              prepend-icon="mdi-lock-check"></v-text-field>

          </v-form>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="#406882" @click="actualizarpassword()">
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
      oldpassword: "",
      newpassword1: "",
      newpassword2: "",
      show1: false,
      show4: false,
      show5: false,
      rules: {
      required: (value) => !!value || "Campo Requerido.",
      min: (v) => v.length >= 8 || "Minimo 8 Caracteres.",
    },
 
    }
  },
  computed: {
    ...mapState(["user"]),
  },
  methods: {

    async actualizarpassword() {
      if (this.oldpassword === "" || this.newpassword1 === "" || this.newpassword2 === "") {
        this.$alert("Llene los campos solicitados", "AVISO", "warning", {
          confirmButtonText: "Aceptar",
        })
      }

      if (this.newpassword1 !== this.newpassword2) {
        this.$alert("Las contraseñas nuevas no coinciden", "AVISO", "warning", {
          confirmButtonText: "Cerrar",
        })
      }
      else {
        const data = {
          oldpassword: this.oldpassword,
          newpassword1: this.newpassword1,
          newpassword2: this.newpassword2
        };
        var response = await HTTP.put(`user/${this.user.id}/resetpassword`, data);
        this.$alert("Contraseña Actualizada", "Realizado", "success", {
          confirmButtonText: "Aceptar",
        })
        this.dialog = false
      }

    },
  }
}
</script>

<style scoped>
.fondo {
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