<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .logo_factura {
      width: 25%;
    }

    p,
    label,
    span,
    table {
      font-family: verdana;
      font-size: 9pt;
    }

    .h2 {
      font-family: verdana;
      font-size: 16pt;
    }

    .h3 {
      font-family: verdana;
      font-size: 12pt;
      display: block;
      background: #0a4661;
      color: #fff;
      text-align: center;
      padding: 3px;
      margin-bottom: 5px;
    }

    #cabecera_reporte,
    #informacion_de_usuario {
      width: 100%;
      margin-bottom: 10px;
      align-content: center;
    }

    #tabla_meses {
      width: 100%;
      align-content: center;
      margin-bottom: 10px;
    }

    #tabla_entradas {
      width: 100%;
      align-content: center;
      margin-bottom: 10px;
    }

    .logo_empresa {
      width: 110%;
    }

    .info_empresa {
      width: 50%;
      text-align: center;
    }

    .info_reporte {
      width: 25%;
    }

    .info_usuario {
      width: 100%;
    }

    .datos_usuario {
      width: 100%;
    }

    .datos_usuario tr td {
      width: 50%;
    }

    .datos_usuario {
      padding: 10px 10px 0 10px;
    }

    .datos_usuario label {
      width: 75px;
      display: inline-block;
    }

    .datos_usuario p {
      display: inline-block;
    }

    .textright {
      text-align: right;
    }

    .textleft {
      text-align: left;
    }

    .textcenter {
      text-align: center;
    }

    .round {
      border-radius: 10px;
      border: 1px solid #0a4661;
      overflow: hidden;
      padding-bottom: 15px;
    }

    .round p {
      padding: 0 15px;
    }

    .round1 {
      border-radius: 10px;
      border: 1px solid #0a4661;
      overflow: hidden;
      padding-bottom: 15px;
    }

    .round1 p {
      padding: 0 15px;
    }

    .round2 {
      border-radius: 10px;
      border: 1px solid #0a4661;
      overflow: hidden;
      padding-bottom: 15px;
    }

    .round2 p {
      padding: 0 15px;
    }

    #detalle_meses tr:nth-child(even) {
      background: #ededed;
    }

    #detalle_entradas tr:nth-child(even) {
      background: #ededed;
    }

    #detalle_totales span {
      font-family: verdana;
    }

    #detalle_totales1 span {
      font-family: verdana;
    }

    .nota {
      font-size: 8pt;
    }

    .label_nombreempresa {
      font-family: verdana;
      font-weight: bold;
      font-style: italic;
      text-align: center;
      margin-top: 20px;
    }

  </style>
</head>
<body style="padding: 50px">
  <table id="cabecera_reporte">
    <tr>
      <td>
        <div>
          <img :src="require('../assets/logo_2.png')" class="logo_empresa" />
        </div>
      </td>
      <td class="info_empresa">
        <div>
          <span class="h2">SISTEMA DE VENTA DE BOLETOS BOLET MASTER</span>
          <br />
          <br />
          <p>REPORTE DE ADMINISTRACION</p>
          <p>Teléfono: +(503) 2222-3333</p>
          <p>Email: boletmaster@gmail.com</p>
        </div>
      </td>
      <td class="info_reporte">
        <div class="round">
          <span class="h3">REPORTE</span>
          <p>Fecha: {{ $fecha }}</p>
          <p>Hora: {{ $hora }}</p>
        </div>
      </td>
    </tr>
  </table>
  <table id="informacion_de_usuario">
    <tr>
      <td class="info_usuario">
        <div class="round">
          <span class="h3">USUARIO QUE REALIZO REPORTE</span>
          <table class="datos_usuario">
            <tr>
              <td>
                <label>Nombre:</label>
                <p>{{$nombre}}</p>
              </td>
              <td>
                <label>Cargo:</label>
                <p>Administrador</p>
              </td>
            </tr>
            <tr>
              <td>
                <label>Usuario:</label>
                <p>{{$usuario}}</p>
              </td>
              <td>
                <label>Correo:</label>
                <p>{{$correo}}</p>
              </td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
  </table>
  <br />
  <br />
  <p class="h2">
    Este resumen contiene informacion acerca de contabilidad de la
    empresa Boletmaster en el ano {{$anio}}. <br /><br />
    Presentado en forma de las siguientes tablas:
  </p>
  <br />
  <br />
  <div class="round1">
    <title class="h3">Total vendido por meses.</title>
    <table id="tabla_meses">
      <thead>
        <tr>
          <th class="textleft">Mes.</th>
          <th class="textright">Total Vendido</th>
        </tr>
      </thead>
      <tbody class="detalle_meses">
        @foreach ($ventas as $mes => $total)
        <tr>
          <td class="textleft">{{$mes}}</td>
          <td class="textright">${{$total}}</td>
        </tr>
        @endforeach
      </tbody>
      <br />
      <br />
      <br />
      <tfoot class="detalle_totales">
        <tr>
          <td colspan="2" class="textright">
            <span>TOTAL VENDIDO.</span>
          </td>
          <td class="textright"><span>$ {{array_sum($ventas->toArray())}}</span></td>
        </tr>
      </tfoot>
    </table>
  </div>
  <br />
  <br>
  <div class="round2">
    <title class="h3">Tipo de entradas y total de entradas vendidas por evento.</title>
    <table id="tabla_entradas">
      <thead>
        <tr>
          <th class="textleft">Evento.</th>
          <th class="textleft">Tipo de Entrada</th>
          <th class="textleft">Precio unitario por entrada</th>
          <th class="textleft">Cantidad de Entradas Vendidas</th>
          <th class="textright">Total</th>
          <th class="textright">Subtotal de todas las entradas.</th>
        </tr>
      </thead>
      <tbody class="detalle_entradas">
        @foreach ($eventos as $evento => $contenido)
        <tr>
          <td class="textleft"> {{$evento}} </td>
          <td class="texleft">
            @foreach ($contenido['entradas'] as $tipo => $contenido_entrada)
            <li>{{$tipo}}</li>
            @endforeach
          </td>
          <td class="textleft">
            @foreach ($contenido['entradas'] as $tipo => $contenido_entrada)
            <li>$ {{ $contenido_entrada['precio'] }}</li>
            @endforeach
          </td>
          <td class="textleft">
            @foreach ($contenido['entradas'] as $tipo => $contenido_entrada)
            <li>$ {{ $contenido_entrada['cantidad'] }}</li>
            @endforeach
          </td>
          <td class="textright">
            @foreach ($contenido['entradas'] as $tipo => $contenido_entrada)
              <li>$ {{ $contenido_entrada['precio'] * $contenido_entrada['cantidad'] }}</li>
            @endforeach
          </td>
          <td class="textright">$ {{ $contenido['total'] }}</td>
        </tr>
        <br>
        <br>
        <br>
        <br>
        @endforeach


      </tbody>
      <br>
      <br>
      <br>
      <tfoot class="detalle_totales1">
        <tr>
          <td colspan="5" class="textright"><span>TOTAL VENDIDO.</span></td>
          <td class="textright"><span>$ {{$total}}</span></td>
        </tr>
      </tfoot>
    </table>
  </div>
  <br />
  <div>
    <p class="nota">
      El contenido de este reporte contiene informacion clasificada,es
      responsabilidad de el usuario que lo genero <br />que la
      informacion se utilice de acuerdo a las politicas de nuestra
      empresa
    </p>
    <br />
    <br />
    <br />
    <h4 class="label_nombreempresa">BOLETMASTER {{$anio}}</h4>
  </div>
</body>
</html>
