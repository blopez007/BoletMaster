<template>
  <v-footer color="#1A374D" padless>
    <v-row no-gutters>
      <!-- Botones de redes sociales. -->
      <!-- Botón para redireccionar a Facebook. -->
      <v-btn icon class="mx-4 white--text" href='https://www.facebook.com/Google/'
        target='_blank'>
        <v-icon size="30px">
          mdi-facebook
        </v-icon>
      </v-btn>
      <!-- Botón para redireccionar a Twitter. -->
      <v-btn icon class="mx-4 white--text" href='https://twitter.com/Google?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor' target='_blank'>
        <v-icon size="30px">
          mdi-twitter
        </v-icon>
      </v-btn>
      <!-- Botón para redireccionar a Instagram. -->
      <v-btn icon class="mx-4 white--text" href='https://www.instagram.com/google/' target='_blank'>
        <v-icon size="30px">
          mdi-instagram
        </v-icon>
      </v-btn>
    </v-row>

    <!-- Botones del footer de la página. -->
    <!-- Botón de Acerca de Nosotros. -->
    <v-btn text class="hidden-md-and-down white--text" active-class="my-2" to="/acerca"> Acerca de Nosotros </v-btn>
    <!-- Botón de Política de Privacidad. -->
    <v-btn text class="hidden-md-and-down white--text" active-class="my-2" to="/privacidad"> Politíca de Privacidad</v-btn>
    <!-- Botón de Como Comprar. -->
    <v-btn text class="hidden-md-and-down white--text" active-class="my-2" to="/comocomprar"> Como Comprar </v-btn>
    <!-- Botón de Política de Cookies. -->
    <v-btn text class="hidden-md-and-down white--text" active-class="my-2" to="/cookies"> Política de Cookies </v-btn>
    <!-- Botón de Devoluciones. -->
    <v-btn text class="hidden-md-and-down white--text" active-class="my-2" to="/devolucion"> Devoluciones </v-btn>

    <v-col cols="3">
      <!-- Logo de la Empresa. -->
      <v-img :src="require('../assets/cilo.png')" contain height="160" position='center' />
    </v-col>

    <v-col cols="6">
      <!-- Logo Visa/MasterCard. -->
      <v-img :src="require('../assets/Visa.png')" contain height="110" position='center' />
    </v-col>

    <v-col cols="3">
      <!-- Logo PayPal. -->
      <v-img :src="require('../assets/Pay.png')" contain height="100" position='center' />
    </v-col>

    <v-col class="#FF0000 py-4 text-center white--text" cols="12">
      <!-- Se utiliza la sentencia "getFullYear" para obtener el año actual y que se muestre junto al nombre de la empresa. -->
      <strong>© Copyright. {{ new Date().getFullYear() }} — Bolet Master. Reservados todos los derechos.</strong>
    </v-col>
  </v-footer>
</template>