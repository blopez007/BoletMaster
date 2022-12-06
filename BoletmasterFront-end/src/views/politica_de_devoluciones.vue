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
          <h1 class="titulo"> Política de Devoluciones </h1>
        </v-img>
      </v-card>
      <!-- v-card que contendrá la Política de Devoluciones -->
      <v-card elevation="24" class="mt-n16" color="#ECEFF1" max-width="1100">
        <v-div>
          <br>
          <br>
          <p class="texto mx-16">
            Bolet Master está a disposición de cualquier tipo de devolución de entradas o boletos, para cualquier evento publicitado y vendido por nosotros. El periodo de devolución es de 7 días después de la adquisición de las entradas o boletos.
          </p>
          <br>
          <h3 class="subtitulo mx-16"> Para el proceso de devolución tenemos que: </h3>
          <br>
          <p class="texto mx-16">
            1- Enviar un correo a bomastdevoluciones@gmail.com solicitando en el asunto la devolución. Añadiendo una foto o el escaneo de el comprobante de compra de los boletos.
            <br>
            2- Esperar de 1 a 2 días hábiles para la anulación de la compra y la devolución íntegra del dinero.
          </p>
          <br>
          <h3 class="subtitulo1 mx-16"> ADVERTENCIA </h3>
          <br>
          <p class="texto mx-16">
            Bolet Master no se hace responsable por devoluciones después de los días hábiles previamente establecidos, ni por la devolución del dinero el día del evento o días posteriores a este. Recuerde siempre ser responsable a la hora de realizar compras en línea y asesorarse por nuestra página o personas con experiencia previa.
          </p>
          <br>
          <h3 class="subtitulo mx-16"> Ley a la que nos establecemos como empresa </h3>
          <br>
          <p class="texto mx-16">
            La Ley de Protección al Consumidor establece, que, para ejercer el derecho de pedir cambios, devoluciones o exigir garantías, el consumidor debe presentar su factura de compra.
          </p>
          <br>
          <br>
          <br>
        </v-div>
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

.subtitulo1{
        font-size: 25px;
        color: red;
        font-family: 'Expletus Sans', cursive;
        text-align: justify;
        line-height: 30px; 
}
@import url('https://fonts.googleapis.com/css2?family=Expletus+Sans&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Dosis&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Mukta+Vaani&display=swap');
</style>