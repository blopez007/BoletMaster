<template id="fondo">
  <!-- Se inserta imagen de fondo. -->
  <v-app
    :style="{ 'background-image': 'url(https://cdn.discordapp.com/attachments/483300246869245960/976242084853977118/copyrich.png)' }"
    id="inspire">
    <!-- Contendor para los formularios de iniciar sesión y regitrar nuevo usuario. -->
    <v-container class="fill-height" fluid>
      <v-row align="center" justify="center">
        <v-col cols="12" sm="8" md="8">
          <v-card class="elevation-24">
            <v-window v-model="step">
              <v-window-item :value="1">
                <v-row>
                  <v-col cols="12" md="8">
                    <v-card-text class="mt-12">
                      <h1 class="text-center display-2"> Ingresa a Bolet Master </h1>
                      <h4 class="text-center mt-4"> Ingresa tu correo y contraseña para acceder </h4>
                      <v-form>
                        <!-- Caja de texto para ingresar el email del usuario registrado. -->
                        <v-text-field label="Email" type="email" color="blue-grey" v-model="email" />

                        <!-- Caja de texto para ingresar la contraseña. -->
                        <v-text-field :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                          :type="show1 ? 'text' : 'password'" label="Contraseña" color="blue-grey" v-model="password"
                          @click:append="show1 = !show1" />
                        <!-- @keydown.enter="preguntar()" -->
                      </v-form>
                      <h3 class="text-center mt-4"> Olvidaste la contraseña? </h3>
                    </v-card-text>

                    <!-- Botón para iniciar sesión. -->
                    <button class="boton entrar" @click="iniciarSesion({ email, password })">
                      <!-- Icono del Botón para iniciar sesión. -->
                      <div class="icono">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                          class="bi bi-arrow-right" viewBox="0 0 16 16">
                          <path fill-rule="evenodd"
                            d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                        </svg>
                      </div>
                      <span> Entrar </span>
                    </button>
                    <br />
                    <br />
                    <br />
                  </v-col>

                  <v-col cols="12" md="4" class="blue-grey darken-1">
                    <v-card-text class="white--text mt-12">
                      <h1 class="text-center display-1">Hola, Amigo!</h1>
                      <h5 class="text-center">
                        Ingresa tus datos personales y comienza a adquirir tus
                        entradas a tus eventos favoritos!
                      </h5>
                    </v-card-text>

                    <!-- Botón para acceder al formulario plano de registro de usuarios. -->
                    <button class="boton registrarse boton1" @click="step++">
                      <!-- Icono del Botón para acceder al formulario plano de registro de usuarios. -->
                      <div class="icono">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                          class="bi bi-bookmark-plus" viewBox="0 0 16 16">
                          <path
                            d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                          <path
                            d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4z" />
                        </svg>
                      </div>
                      <span>Registrarse</span>
                    </button>
                    <p></p>
                    <p></p>
                    <div>
                      <!-- Logo de la empresa. -->
                      <img :src="require('../assets/cilo.png')" height="140" class="mx-5" />
                    </div>
                  </v-col>
                </v-row>
              </v-window-item>
              <v-window-item :value="2">
                <v-row class="fill-height">
                  <v-col cols="12" md="4" class="blue-grey darken-1">
                    <v-card-text class="white--text mt-12">
                      <h1 class="text-center display-1">
                        Ya tienes una cuenta?
                      </h1>
                      <h5 class="text-center">
                        Ingresa tus datos para entrar
                      </h5>
                    </v-card-text>

                    <!-- Botón para regresar al formulario de inicio de sesión. -->
                    <button class="boton entrar1 boton2" @click="step--">
                      <!-- Icono del Botón para regresar al formulario de inicio de sesión. -->
                      <div class="icono">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                          class="bi bi-arrow-left" viewBox="0 0 16 16">
                          <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                        </svg>
                      </div>
                      <span> Entrar </span>
                    </button>

                    <div>
                      <!-- Logo de la empresa. -->
                      <img :src="require('../assets/cilo.png')" height="140" class="mx-7" />
                    </div>
                  </v-col>

                  <!-- Formulario plano para registro de nuevos usuarios. -->
                  <v-col cols="12" md="8">
                    <v-card-text class="mt-12">
                      <h1 class="text-center display-2"> Crear Cuenta </h1>
                      <h4 class="text-center mt-4"> Ingresa un correo para registrarte </h4>
                      <!-- Cajas de texto del formulario. -->
                      <v-form>
                        <v-text-field v-model="nombre" :rules="textRules" label="Nombre" type="text" color="blue-grey" />
                        <v-text-field v-model="apellido" :rules="textRules" label="Apellido" color="blue-grey" />
                        <v-text-field v-model="email" :rules="emailRules" label="Email" type="text" color="blue-grey" />
                        <v-text-field v-model="usuario2" :rules="textRules" label="Usuario" type="text" color="blue-grey" />

                        <v-text-field v-model="password" :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                          :rules="[rules.required, rules.min]" :type="show1 ? 'text' : 'password'" name="password"
                          label="Password" hint="Al menos 8 caracteres" counter @click:append="show1 = !show1"
                          color="blue-grey" />
                      </v-form>
                    </v-card-text>
                    <!-- Botón para completar el registro de nuevo usuario. -->
                    <v-container justify-center>
                      <button class="boton registrarse1 boton3" @click="crearCuenta()">
                        <!-- Icono del Botón para completar el registro de nuevo usuario. -->
                        <div class="icono">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-bookmark-plus" viewBox="0 0 16 16">
                            <path
                              d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                            <path
                              d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4z" />
                          </svg>
                        </div>
                        <span> Registrarme </span>
                      </button>
                      <br />
                      <br />
                      <br />
                    </v-container>
                  </v-col>
                </v-row>
              </v-window-item>
            </v-window>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
import HTTP from '../utils/HTTP';
import { mapMutations } from 'vuex';

export default {
  data: () => ({
    step: 1,
    email: "",
    password: "",
    usuario2: "",
    nombre: "",
    apellido: "",
    show1: false,
    rules: {
      required: (value) => !!value || "Campo Requerido.",
      min: (v) => v.length >= 8 || "Minimo 8 Caracteres.",
    },
    emailRules: [
        v => !!v || 'El campo es requerido',
        v => /.+@.+\..+/.test(v) || 'El correo no es valido',
      ],

      textRules: [
        v => !!v || 'El campo es requerido',
      ],
  }),
  methods: {
    async iniciarSesion(data) {
      if (this.email === "" || this.password === "" ) {
        this.$alert("Llene los campos solicitados", "AVISO", "warning", {
          confirmButtonText: "Aceptar",
        })
      }

      else{

      try {
        var response = await HTTP.post("auth/login", data);
        localStorage.setItem("token", response.data.token);
        var response = await HTTP.get("/profile");
        localStorage.setItem("userID", JSON.stringify(response.data.user.id));
        this.loguear(response.data.user);
        this.$router.push({ name: "Inicio" });
      } catch (error) {
        this.$alert("Usuario o contrasena incorrecta", "Aviso", "warning", {
          confirmButtonText: "Ok",
        });
      } }
    },
    
    async crearCuenta() {
      if (this.nombre === "" || this.apellido === "" || this.email === "" || this.usuario2 === "" || this.password === "") {
        this.$alert("Llene los campos solicitados", "AVISO", "warning", {
          confirmButtonText: "Aceptar",
        })
      }
      const data = {
        nombre: this.nombre,
        apellido: this.apellido,
        email: this.email,
        usuario: this.usuario2,
        password: this.password,
      };
      var response = await HTTP.post("user/create", data);
      this.$alert("Usuario Creado, inicie sesion", "Aviso", "Succes", {
          confirmButtonText: "OK",
      })
   
    },
    ...mapMutations(['loguear'])
  },
};
</script>
<style scoped>
.boton {
  display: inline-flex;
  margin-left: 130px;
  align-items: center;
  justify-content: center;
  width: 52%;
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

.boton.entrar span {
  transition: 0.4s ease-in-out all;
  position: absolute;
  color: #fff;
  left: 40%;
}

.boton.entrar .icono {
  display: flex;
  align-items: center;
  position: absolute;
  z-index: 2;
  left: -40px;
  transition: 0.3s ease-in-out all;
  opacity: 0;
}

.boton.entrar svg {
  color: #fff;
  width: 35px;
  height: 35px;
}

.boton.entrar:hover {
  background: #6998ab;
}

.boton.entrar:hover .icono {
  left: calc(100% - 50px);
  opacity: 1;
}

.boton.entrar:hover span {
  left: 20px;
}

.color.fondo {
  color: #406882;
}

.boton1 {
  display: inline-flex;
  margin-left: 18px;
  align-items: center;
  justify-content: center;
  width: 86%;
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

.boton.registrarse span {
  transition: 0.4s ease-in-out all;
  position: absolute;
  color: #fff;
  left: 29%;
}

.boton.registrarse .icono {
  display: flex;
  align-items: center;
  position: absolute;
  z-index: 2;
  left: -40px;
  transition: 0.3s ease-in-out all;
  opacity: 0;
}

.boton.registrarse svg {
  color: #fff;
  width: 35px;
  height: 35px;
}

.boton.registrarse:hover {
  background: #6998ab;
}

.boton.registrarse:hover .icono {
  left: calc(100% - 50px);
  opacity: 1;
}

.boton.registrarse:hover span {
  left: 20px;
}

.boton2 {
  display: inline-flex;
  margin-left: 22px;
  align-items: center;
  justify-content: center;
  width: 81%;
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

.boton.entrar1 span {
  transition: 0.4s ease-in-out all;
  position: absolute;
  color: #fff;
  left: 37%;
}

.boton.entrar1 .icono {
  display: flex;
  align-items: center;
  position: absolute;
  z-index: 2;
  left: -40px;
  transition: 0.3s ease-in-out all;
  opacity: 0;
}

.boton.entrar1 svg {
  color: #fff;
  width: 35px;
  height: 35px;
}

.boton.entrar1:hover {
  background: #6998ab;
}

.boton.entrar1:hover .icono {
  left: calc(100% - 50px);
  opacity: 1;
}

.boton.entrar1:hover span {
  left: 21px;
}

.boton3 {
  display: inline-flex;
  margin-left: 123px;
  align-items: center;
  justify-content: center;
  width: 53%;
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

.boton.registrarse1 span {
  transition: 0.4s ease-in-out all;
  position: absolute;
  color: #fff;
  left: 30%;
}

.boton.registrarse1 .icono {
  display: flex;
  align-items: center;
  position: absolute;
  z-index: 2;
  left: -40px;
  transition: 0.3s ease-in-out all;
  opacity: 0;
}

.boton.registrarse1 svg {
  color: #fff;
  width: 35px;
  height: 35px;
}

.boton.registrarse1:hover {
  background: #6998ab;
}

.boton.registrarse1:hover .icono {
  left: calc(100% - 50px);
  opacity: 1;
}

.boton.registrarse1:hover span {
  left: 20px;
}

#fondo {
  background: get("../assets/fondo-login.png");
  width: 100%;
  height: 100%;
  position: fixed;
  background-size: 100% 100%;
}
</style>