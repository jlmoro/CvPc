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
        <!-- <th>Fecha Registro</th> -->
      </thead>
      <tbody>
        @foreach($chasis as $key => $cha)
        <tr>
          <th scope="row">{{ ++$key }}</th>
          <td>{{ $cha->marca }}</td>
          <td>{{ $cha->placa }}</td>
          <td>{{ $cha->serial }}</td>
          <td>{{ $cha->nombre_ecnargado }}</td>
          <td>{{ $cha->nombre_proveedor }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>
