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
          <h1 class="titulo"> ¿Comó Comprar? </h1>
        </v-img>
      </v-card>
      <!-- v-card que contendrá un vídeo explicando la manera para realizar la comprar de boletos a tráves de del sitio web -->
      <v-card elevation="24" class="mt-n16" max-width="1100">
        <div style="background-color: #f5f5f5">
          <p class="subtitulo mx-16">
            <br>
            <br>
            ¿Quieres comprar y no sabes como? Tranquilo, aquí encontraras un tutorial sencillo y rápido para que puedas disfrutar tus conciertos y eventos al maximo!
          </p>
          <br>
          <br>
          <!-- Se utiliza un iframe para poder insertar el video tutorial -->
          <iframe class="mx-16" width="950" height="480" src="https://www.youtube.com/embed/cDvd4JySWjI"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
          </iframe>
          <br>
          <br>
        </div>
        <br>
        <br>
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