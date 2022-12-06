<template>
  <v-container fluid elevation="24">


    <div class="contenedor">
      <div class="contenedor_tarjeta">
        <figure id="tarjeta">
          <img :src="evento.imagen" class="frontal" alt="" />
          <figcaption class="trasera">
            <h2 class="titulo">{{ evento.titulo }}</h2>
            <hr />
            <p>{{ evento.descripcion }}</p>

            <button class="boton comprar" @click="redireccionar()">
              <div class="icono">
                <svg width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                  <path
                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
              </div>
              <span> Comprar </span>
            </button>
          </figcaption>
        </figure>
      </div>
    </div>
  </v-container>
</template>

<script>
import Vuex from "vuex";
export default {
  name: "",
  props: ["evento"],

  data: () => ({
    revelars: false,
    loading: false,
    selection: 1,
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
* {
  margin: 0;
  padding: 0;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

body {
  background: #f0f2f1;
  font-family: "Open Sans", sans-serif;
}

a {
  text-decoration: none;
}

.contenedor {
  max-width: 1200px;
  margin: 50px auto;
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: center;
}

.contenedor_tarjeta {
  margin: 20px;
}

.contenedor_tarjeta a {
  display: inline-block;
}

.contenedor_tarjeta:hover figure {
  transform: perspective(600px) rotateY(180deg);
  -webkit-box-shadow: 0px 2px 10px 2px rgba(0, 0, 0, 0.25);
  -moz-box-shadow: 0px 2px 10px 2px rgba(0, 0, 0, 0.25);
  box-shadow: 0px 2px 10px 2px rgba(0, 0, 0, 0.25);
}

.contenedor_tarjeta:hover figure img {
  /* Si queremos podemos aplicar un efecto blur a nuestra imagen al girar */
  filter: blur(8px);
}

figure {
  width: 300px;
  height: 350px;
  margin: 0;
  position: relative;
  transition: all ease 0.5s;
  transform-style: preserve-3d;
  /* Nota:
		Establecemos que la imagen tendra una rotacion de 0grados al inicio porque si no
		ponemos esta propiedad nos da un poco de problemas en algunos navegadores al pasar el cursor.
	*/
  transform: perspective(600px) rotateY(0deg);
}

figure .frontal,
figure .trasera {
  width: 100%;
  height: 100%;
  border-radius: 5px;
  transition: all ease 0.5s;
}

figure .frontal {
  display: block;
  background: #000;

  /* Podemos ocultar la imagen al da la vuelta si lo queremos */
  /*backface-visibility: hidden;*/
}

figure .trasera {
  position: absolute;
  top: 0;
  padding: 20px;
  color: #fff;
  transform: perspective(600px) rotateY(180deg);
  backface-visibility: hidden;
  overflow: auto;
}

figure .trasera .titulo {
  color: #fff;
  font-weight: normal;
  margin-bottom: 20px;
  font-family: "Roboto", sans-serif;
  font-size: 24px;
}

figure .trasera hr {
  height: 2px;
  background: #fff;
  border: none;
  margin-bottom: 20px;
  opacity: 0.5;
}

figure .trasera p {
  font-family: "Open Sans", sans-serif;
  line-height: 22px;
  font-size: 14px;
}

@media screen and (max-width: 992px) {
  figure .trasera {
    /*position: relative;*/
    backface-visibility: visible;
    transform: perspective(600px) rotateY(0deg);
  }

  .contenedor_tarjeta:hover figure {
    transform: perspective(600px) rotateY(0deg);
  }
}

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