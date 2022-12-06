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
          <h1 class="titulo"> ¿Quienes Somos? </h1>
        </v-img>
      </v-card>
      <!-- v-card que contendrá la información de la empresa -->
      <v-card elevation="24" class="mt-n16" max-width="1100">
        <div style="background-color: #f5f5f5">
          <br>
          <br>
          <h2 class="subtitulo mx-16"> Bolet Master </h2>
          <br>
          <p class="texto mx-16">
            Porque lo eventos con amigos, son inolvidables.
          <br>
          <br>
            Somos una empresa que busca facilitar a las personas la adquisición de entradas y boletos para toda clase de eventos. A través de un sitio web seguro, confiable y fácil de usar. Ofrecemos un servicio personalizado, profesional y confiable.
          <br>
          <br>
          <h3 class="subtitulo2 mx-16"> Misión </h3>
          <br>
          <p class="texto mx-16">
            Bolet Master más que una empresa dedicada a promover y distribuir boletos para diversos tipos de eventos, somos profesionales comprometidos en brindar un servicio de calidad a nuestros usuarios, a través de nuestro sitio web buscamos generar seguridad a nuestros clientes de poder realizar compras en línea, garantizando la privacidad de su información.
          </p>
            <br>
          <br>
          <h3 class="subtitulo2 mx-16"> Visión </h3>
          <br>
          <p class="texto mx-16">
            Lograr una preferencia por parte de los usuarios y con ello llegar a ser una de las empresas más reconocidas.
          </p>
            <br>
          <br>
          <br>
          </p>
          <br>
        </div>
        <br>
        <br>
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
  margin-left: 160px;
  margin-top: 60px;
  text-align: left;
  font-family: 'Dosis', sans-serif;
  font-size: 70px;
  bottom: 0;
  border-bottom: 10px inset rgba(213, 248, 11, 0.75) 9px underline;
}
.subtitulo{
        font-size: 25px;
        font-family: 'Expletus Sans', cursive;
        text-align: justify;
        line-height: 30px; 
}
@import url('https://fonts.googleapis.com/css2?family=Expletus+Sans&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Dosis&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Mukta+Vaani&display=swap');
</style>