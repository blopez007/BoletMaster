<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ticket</title>
  <style>
    * {
      font-size: 12px;
      font-family: 'Times New Roman';
    }

    td,
    th,
    tr,
    table {
      border-top: 1px solid black;
      border-collapse: collapse;
    }

    td.producto,
    th.producto {
      width: 110px;
      max-width: 100px;
    }

    td.cantidad,
    th.cantidad {
      width: 200px;
      max-width: 200px;
      word-break: break-all;
    }

    td.precio,
    th.precio {
      width: 100px;
      max-width: 100px;
      word-break: break-all;
    }

    .centrado {
      text-align: center;
      align-content: center;
    }

    .producto1 {
      font-size: 15px;
      font-family: 'Times New Roman';
    }

    .ticket {
      width: 205px;
      max-width: 505px;
    }

    img {
      max-width: inherit;
      width: inherit;
    }

.span{
  align-content: center;
  margin: 0 auto;
}
</style>
<div class="ticket" id="body">
            <img
             :src="{{asset('/cilo.png')}}"
              class=""
              height="130"
              alt="Logotipo"
            />
            <p class="centrado">
              Gracias por su Preferencia Boletmaster <br />EL SALVADOR <br> <br>
              <br />FECHA: {{$fecha_compra}} <br />HORA:{{$hora_compra}}  <br />
             <br />TICKET:# {{$id}}
            </p>
            <br />FECHA: {{$fecha_evento}}<br />HORA: {{$hora_evento}}  <br />Evento:{{$evento}}
            <table>
              <thead>
                <tr>
                  <th>Tipo entrada</th>
                  <th class="cantidad">Cantidad</th>
                  <th class="producto">Precio</th>
                  <th class="precio">Subtotal</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($entradas as $entrada)
        <tr>
          <td class="text--center">{{$entrada->entrada->tipo_entrada}}</td>
          <td class="text--center">{{$entrada->cantidad_comprada}}</td>
          <td class="textcenter">${{$entrada->entrada->precio}}</td>
          <td class="textjustify">${{$entrada->precio_total}}</td>

        </tr>
        @endforeach
      </tbody>

    </table>
    <span class="cantidad"> Total ${{$monto_compra}}</span>
    <br>
    <p class="centrado">
      ¡GRACIAS POR SU COMPRA! <br />Precio Iva Incluido <br />15 dias
      para cambios y devoluciones <br />www.BoletMaster.com
    </p>
    <img :src="require('../assets/codebar.png')" class="" height="100" alt="Logotipo" />
  </div>
</body>

</html>
