<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <table>
      <thead>
        <th>#</th>
        <th>Marca</th>
        <th>Placa</th>
        <th>Serial</th>
        <th>Encargado</th>
        <th>Proveedor</th>
        <th>Fecha Registro</th>
      </thead>
      <tbody>
        @foreach($chasis as $cha)
        <tr>
          <!-- <td>{{$cha}}</td> -->
        </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>
