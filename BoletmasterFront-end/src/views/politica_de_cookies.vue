<template>
  <body class="fondo">
    <!-- v-row que contendrá las v-card que se utilizarán -->
    <v-row justify="space-around">
      <!-- v-card que contendrá la imagen de cabecera de la página estática -->
      <v-card width="1500">
        <v-img height="400px" src="https://www.bbva.com/wp-content/uploads/2020/05/festival2-1920x1180.jpg">
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <h1 class="titulo"> Política de Cookies </h1>
        </v-img>
      </v-card>
      <!-- v-card que contendrá la Política de Cookies -->
      <v-card elevation="24" class="mt-n16" max-width="1100">
        <body style="background-color:#F5F5F5;">
          <br>
          <br>
          <p class="texto mx-16">
            Una cookie se refiere a un fichero que es enviado con la finalidad de solicitar permiso
            para almacenarse en su ordenador, al aceptar dicho fichero se crea y la cookie sirve entonces para tener
            información respecto al tráfico web, y también facilita las futuras visitas a una web recurrente. Otra
            función que tienen las cookies es que con ellas las webs pueden reconocerte individualmente y por tanto
            brindarte el mejor servicio personalizado de su web.
          <br>
          <br>
            Nuestro sitio web emplea las cookies para poder identificar las páginas que son visitadas y su frecuencia.
            Esta información es empleada únicamente para análisis estadístico y después la información se elimina de
            forma permanente. Usted puede eliminar las cookies en cualquier momento desde su ordenador. Sin embargo, las
            cookies ayudan a proporcionar un mejor servicio de los sitios web, estás no dan acceso a información de su
            ordenador ni de usted, a menos de que usted así lo quiera y la proporcione directamente. Usted puede aceptar
            o negar el uso de cookies, sin embargo, la mayoría de los navegadores aceptan cookies automáticamente pues
            sirve para tener un mejor servicio web. También usted puede cambiar la configuración de su ordenador para
            declinar las cookies. Si se declinan es posible que no pueda utilizar algunos de nuestros servicios.
          </p>
          <br>
          <br>
          <br>
        </body>
      </v-card>
    </v-row>
  </body>
</template>

<style scoped>
.fondo{
    background-image: url(https://cdn.discordapp.com/attachments/483300246869245960/976242084853977118/copyrich.png);
    background-size: 1500px;
    background-repeat: repeat-y;
}
.texto {
        font-size: 19px;
        font-family: 'Mukta Vaani', sans-serif;
        text-align: justify;
        line-height: 30px;
}
.titulo{
  color: #FFF;
  margin: 0 auto;
  margin-left: 120px;
  margin-top: 60px;
  text-align: left;
  font-family: 'Dosis', sans-serif;
  font-size: 70px;
  bottom: 0;
  border-bottom: 10px inset rgba(213, 248, 11, 0.75) 9px underline;
}

@import url('https://fonts.googleapis.com/css2?family=Expletus+Sans&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Dosis&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Mukta+Vaani&display=swap');
</style>