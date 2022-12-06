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
          <h1 class="titulo"> Política de Privacidad </h1>
        </v-img>
      </v-card>
      <!-- v-card que contendrá la Política de Privacidad -->
      <v-card elevation="24" class="mt-n16" max-width="1100">
        <div style="background-color: #f5f5f5">
        <br>
        <br>
        <p class="texto mx-16">
          El presente Política de Privacidad establece los términos en que
          Bolet Master usa y protege la información que es proporcionada por
          sus usuarios al momento de utilizar su sitio web. Esta compañía está
          comprometida con la seguridad de los datos de sus usuarios. Cuando le
          pedimos llenar los campos de información personal con la cual usted
          pueda ser identificado, lo hacemos asegurando que sólo se empleará de
          acuerdo con los términos de este documento. Sin embargo, esta Política
          de Privacidad puede cambiar con el tiempo o ser actualizada por lo que
          le recomendamos y enfatizamos revisar continuamente esta página para
          asegurarse que está de acuerdo con dichos cambios.
        </p>
        <br>
        <h2 class="subtitulo mx-16"> Información que es recogida </h2>
        <br>
        <p class="texto mx-16">
          Nuestro sitio web podrá recoger información personal, por ejemplo:
          Nombre, información de contacto como su dirección de correo
          electrónica e información demográfica. Así mismo cuando sea necesario
          podrá ser requerida información específica para procesar algún pedido
          o realizar una entrega o facturación.
        </p>
        <h2 class="subtitulo mx-16"> Uso de la información recogida </h2>
        <br>
        <p class="texto mx-16">
          Nuestro sitio web emplea la información con el fin de proporcionar el
          mejor servicio posible, particularmente para mantener un registro de
          usuarios, de pedidos en caso que aplique, y mejorar nuestros productos
          y servicios. Es posible que sean enviados correos electrónicos
          periódicamente a través de nuestro sitio con ofertas especiales,
          nuevos productos y otra información publicitaria que consideremos
          relevante para usted o que pueda brindarle algún beneficio, estos
          correos electrónicos serán enviados a la dirección que usted
          proporcione y podrán ser cancelados en cualquier momento.
        <br>
        <br>
          Bolet Master está altamente comprometido para cumplir con el
          compromiso de mantener su información segura. Usamos los sistemas más
          avanzados y los actualizamos constantemente para asegurarnos que no
          exista ningún acceso no autorizado.
        </p>
        <h2 class="subtitulo mx-16"> Control de su información personal </h2>
        <br>
        <p class="texto mx-16">
          En cualquier momento usted puede restringir la recopilación o el uso
          de la información personal que es proporcionada a nuestro sitio web.
          Cada vez que se le solicite rellenar un formulario, como el de alta de
          usuario, puede marcar o desmarcar la opción de recibir información por
          correo electrónico. En caso de que haya marcado la opción de recibir
          nuestro boletín o publicidad usted puede cancelarla en cualquier
          momento.
        <br>
        <br>
          Esta compañía no venderá, cederá ni distribuirá la información
          personal que es recopilada sin su consentimiento, salvo que sea
          requerido por un juez con un orden judicial.
        <br>
        <br>
        Bolet Master Se reserva el derecho de cambiar los términos de la
        presente Política de Privacidad en cualquier momento.
        <br>
        <br>
        <br>
        </p>
        </div>
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
  margin-left: 165px;
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